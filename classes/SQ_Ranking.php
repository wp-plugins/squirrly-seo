<?php

/**
 * Class for Google Ranking Record
 */
class SQ_Ranking extends SQ_FrontController {

    private $keyword;
    private $post_id;
    //--
    private $country;
    private $language;

    public function __construct() {
        $this->country = SQ_Tools::$options['sq_google_country'];
        $this->language = SQ_Tools::$options['sq_google_language'];
    }

    public function getCountry() {
        return $this->country;
    }

    /**
     * Get the google language from settings
     * @return type
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Set the Post id
     * @return type
     */
    public function setPost($post_id) {
        $this->post_id = $post_id;
    }

    /**
     * Get the current keyword
     * @param type $keyword
     */
    public function setKeyword($keyword) {
        $this->keyword = str_replace(" ", "+", urlencode(strtolower($keyword)));
    }

    /**
     * Process Ranking on brief request
     * @param type $return
     */
    public function processRanking($post_id, $keyword) {
        $this->setPost($post_id);
        $this->setKeyword($keyword);

        if (isset($this->keyword)) {
            return $this->getGoogleRank();
        }
        return false;
    }

    /**
     * Call google to get the keyword position
     *
     * @param integer $post_id
     * @param string $keyword
     * @param string $country: com | country extension
     * @param string $language: en | local language
     * @return boolean|int
     */
    public function getGoogleRank() {
        global $wpdb;
        $country = $this->country;

        if (!function_exists('preg_match_all'))
            return;

        $arg = array('timeout' => 10);
        $arg['q'] = $this->keyword;
        $arg['hl'] = $this->language;
        $arg['num'] = '100';
        $arg['as_qdr'] = 'all';
        $arg['safe'] = 'off';
        $arg['pws'] = '0';

        //Grab the remote informations from google
        $response = utf8_decode(SQ_Tools::sq_remote_get("https://www.google.$country/search", $arg));

        //Check the values for block IP
        if (strpos($response, "computer virus or spyware application") !== false ||
                strpos($response, "entire network is affected") !== false ||
                strpos($response, "http://www.download.com/Antivirus") !== false ||
                strpos($response, "/images/yellow_warning.gif") !== false ||
                strpos($response, "Our systems have detected unusual traffic") !== false) {
            return -2; //return error
        }


        //Get the permalink of the current post
        $permalink = get_permalink($this->post_id);
        preg_match_all('/<h3 class="r"><a href="\/url\?q=(.*?)&amp;sa=U&amp;ei=/', $response, $matches);

        $pos = -1;
        if (!empty($matches[1])) {
            foreach ($matches[1] as $index => $url) {

                if (strpos($url, $permalink) !== false) {
                    $pos = $index + 1;
                    break;
                }
            }
        }
        return $pos;
    }

    /**
     * Do google rank with cron
     * @global type $wpdb
     */
    public function processCron() {
        global $wpdb;
        set_time_limit(400);
        /* Load the Submit Actions Handler */
        SQ_ObjController::getController('SQ_Action', false);

        //check 20 keyword at one time
        $sql = "SELECT `post_id`, `meta_value`
                       FROM `" . $wpdb->postmeta . "`
                       WHERE (`meta_key` = 'sq_post_keyword')
                       ORDER BY `post_id` DESC";

        if ($rows = $wpdb->get_results($sql)) {
            $count = 0;
            foreach ($rows as $row) {
                if ($count > 10) {
                    break; //check only 10 keywords at the time
                }
                if ($row->meta_value <> '') {
                    $json = json_decode($row->meta_value);
                    //If keyword is set and no rank or last check is 2 days ago
                    if (isset($json->keyword) &&
                            (!isset($json->rank) ||
                            (isset($json->update) && (time() - $json->update > (60 * 60 * 24 * 2))))) {

                        $json->rank = $this->processRanking($row->post_id, $json->keyword);
                        if ($json->rank == -1) {
                            sleep(mt_rand(10, 20));
                            //if not indexed with the keyword then find the url
                            if ($this->processRanking($row->post_id, get_permalink($row->post_id)) > 0) {
                                $json->rank = 0; //for permalink index set 0
                            }
                        }


                        if (isset($json->rank)) {
                            SQ_ObjController::getModel('SQ_Post')->saveKeyword($row->post_id, $json);
                            set_transient('sq_rank' . $row->post_id, $json->rank, (60 * 60 * 24 * 2));

                            //if rank proccess has no error
                            if ($json->rank >= -1) {
                                $args = array();
                                $args['post_id'] = $row->post_id;
                                $args['rank'] = (string) $json->rank;
                                $args['country'] = $this->getCountry();
                                $args['language'] = $this->getLanguage();

                                SQ_Action::apiCall('sq/user-analytics/saveserp', $args);
                            }
                            $count++;
                            sleep(mt_rand(10, 20));
                        }
                    }
                }
            }
        }
    }

    /**
     * Get keyword from earlier version
     *
     */
    public function getKeywordHistory() {
        global $wpdb;
        //Check if ranks is saved in database
        $sql = "SELECT a.`global_rank`, a.`keyword`, a.`post_id`
                FROM `sq_analytics` as a
                INNER JOIN (SELECT MAX(`id`) as id FROM `sq_analytics` WHERE `keyword` <> '' GROUP BY `post_id`) as a1 ON a1.id = a.id ";

        if ($rows = $wpdb->get_results($sql)) {
            foreach ($rows as $values) {
                if ($json = SQ_ObjController::getModel('SQ_Post')->getKeyword($values->post_id)) {
                    $json->keyword = urldecode($values->keyword);
                    if ($values->global_rank > 0) {
                        $json->rank = $values->global_rank;
                    }
                    SQ_ObjController::getModel('SQ_Post')->saveKeyword($values->post_id, $json);
                } else {
                    $args = array();
                    $args['keyword'] = urldecode($values->keyword);
                    if ($values->global_rank > 0) {
                        $json->rank = $values->global_rank;
                    }
                    SQ_ObjController::getModel('SQ_Post')->saveKeyword($values->post_id, json_decode(json_encode($args)));
                }
            }
        }
    }

}

?>
