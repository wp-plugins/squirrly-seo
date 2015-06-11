<?php

/**
 * Class for Google Ranking Record
 */
class SQ_Ranking extends SQ_FrontController {

    private $keyword;
    private $post_id;
    private $error;

    //--
    public function getCountry() {
        if (isset(SQ_Tools::$options['sq_google_country']) && SQ_Tools::$options['sq_google_country'] <> '') {
            return SQ_Tools::$options['sq_google_country'];
        }
        return 'com';
    }

    public function getRefererCountry() {
        $convert_refc = array('com' => 'us', '.off.ai' => 'ai', 'com.ag' => 'ag', 'com.ar' => 'ar', 'com.au' => 'au', 'com.br' => 'br', 'com.co' => 'co', 'co.cr' => 'cr', 'com.cu' => 'cu', 'com.do' => 'do', 'com.ec' => 'ec', 'com.sv' => 'sv', 'com.fj' => 'fj', 'com.gi' => 'gi', 'com.gr' => 'gr', 'com.hk' => 'hk', 'co.hu' => 'hu', 'co.in' => 'in', 'co.im' => 'im', 'co.il' => 'il', 'com.jm' => 'jm', 'co.jp' => 'jp', 'co.je' => 'je', 'co.kr' => 'kr', 'co.ls' => 'ls', 'com.my' => 'my', 'com.mt' => 'mt', 'com.mx' => 'mx', 'com.na' => 'na', 'com.np' => 'np', 'com.ni' => 'ni', 'com.nf' => 'nf', 'com.pk' => 'pk', 'com.pa' => 'pa', 'com.py' => 'py', 'com.pe' => 'pe', 'com.ph' => 'ph', 'com.pr' => 'pr', 'com.sg' => 'sg', 'co.za' => 'za', 'com.tw' => 'tw', 'com.th' => 'th', 'com.tr' => 'tr', 'com.ua' => 'ua', 'com.uk' => 'uk', 'com.uy' => 'uy',);
        $country = $this->getCountry();
        if (array_key_exists($country, $convert_refc)) {
            return $convert_refc[$country];
        }
        return $country;
    }

    /**
     * Get the google language from settings
     * @return type
     */
    public function getLanguage() {
        if (isset(SQ_Tools::$options['sq_google_language']) && SQ_Tools::$options['sq_google_language'] <> '') {
            return SQ_Tools::$options['sq_google_language'];
        }
        return 'en';
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
        $this->setKeyword(trim($keyword));

        if (isset($this->keyword) && $this->keyword <> '') {
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
        $this->error = '';

        if (trim($this->keyword) == '') {
            $this->error = 'no keyword for post_id:' . $this->post_id;
            return false;
        }

        if (!function_exists('preg_match_all')) {
            return false;
        }

        $arg = array('timeout' => 10);
        $arg['as_q'] = str_replace(" ", "+", strtolower(trim($this->keyword)));
        $arg['hl'] = $this->getLanguage();
        //$arg['gl'] = $this->getRefererCountry();

        if (SQ_Tools::$options['sq_google_country_strict'] == 1) {
            $arg['cr'] = 'country' . strtoupper($this->getRefererCountry());
        }
        $arg['start'] = '0';
        $arg['num'] = '100';

        $arg['safe'] = 'active';
        $arg['pws'] = '0';
        $arg['as_epq'] = '';
        $arg['as_oq'] = '';
        $arg['as_nlo'] = '';
        $arg['as_nhi'] = '';
        $arg['as_qdr'] = 'all';
        $arg['as_sitesearch'] = '';
        $arg['as_occt'] = 'any';
        $arg['tbs'] = '';
        $arg['as_filetype'] = '';
        $arg['as_rights'] = '';

        $country = $this->getCountry();

        if ($country == '' || $arg['hl'] == '') {
            $this->error = 'no country (' . $country . ')';
            return false;
        }

        //Grab the remote informations from google
        $response = utf8_decode(SQ_Tools::sq_remote_get("https://www.google.$country/search", $arg));

        //Check the values for block IP
        if (strpos($response, "</h3>") === false) {
            set_transient('google_blocked', 1, (60 * 60 * 1));
            return -2; //return error
        }

        //Get the permalink of the current post
        $permalink = get_permalink($this->post_id);
        if ($permalink == '') {
            $this->error = 'no permalink for post_id:' . $this->post_id;
            return false;
        }

        preg_match_all('/<h3.*?><a href="(.*?)".*?<\/h3>/is', $response, $matches);

        SQ_Tools::dump($matches[1]);
        if (!empty($matches[1])) {
            $pos = -1;
            foreach ($matches[1] as $index => $url) {
                if (strpos($url, rtrim($permalink, '/')) !== false) {
                    $pos = $index + 1;
                    break;
                }
            }
            return $pos;
        }
        $this->error = 'no results returned by google';
        return false;
    }

    /**
     * Do google rank with cron
     * @global type $wpdb
     */
    public function processCron() {
        global $wpdb;
        if (get_transient('google_blocked') !== false) {
            return;
        }
        set_time_limit(3000);
        /* Load the Submit Actions Handler */
        SQ_ObjController::getController('SQ_Tools', false);
        SQ_ObjController::getController('SQ_Action', false);

        //check 20 keyword at one time
        $sql = "SELECT `post_id`, `meta_value`
                       FROM `" . $wpdb->postmeta . "`
                       WHERE (`meta_key` = '_sq_post_keyword')
                       ORDER BY `post_id` DESC";

        if ($rows = $wpdb->get_results($sql)) {
            $count = 0;
            foreach ($rows as $row) {
                if ($count > SQ_Tools::$options['sq_google_ranksperhour']) {
                    break; //check only 10 keywords at the time
                }
                if ($row->meta_value <> '') {
                    $json = json_decode($row->meta_value);
                    //If keyword is set and no rank or last check is 2 days ago
                    if (isset($json->keyword) && $json->keyword <> '' &&
                            (!isset($json->rank) ||
                            (isset($json->update) && (time() - $json->update > (60 * 60 * 24 * 2))) || //if indexed then check every 2 days
                            (isset($json->update) && isset($json->rank) && $json->rank == -1 && (time() - $json->update > (60 * 60 * 24))) //if not indexed than check often
                            )) {

                        $rank = $this->processRanking($row->post_id, $json->keyword);
                        if ($rank == -1) {
                            $count++;
                            sleep(mt_rand(20, 50));
                            //if not indexed with the keyword then find the url
                            if ($this->processRanking($row->post_id, get_permalink($row->post_id)) > 0) {
                                $rank = 0; //for permalink index set 0
                            }
                        }

                        //if there is a success response than save it
                        if (isset($rank) && $rank >= -1) {
                            $json->rank = $rank;
                            $json->country = $this->getCountry();
                            $json->language = $this->getLanguage();
                            SQ_ObjController::getModel('SQ_Post')->saveKeyword($row->post_id, $json);
                        }
                        set_transient('sq_rank' . $row->post_id, $rank, (60 * 60 * 24));
                        //if rank proccess has no error

                        $args = array();
                        $args['post_id'] = $row->post_id;
                        $args['rank'] = (string) $rank;
                        $args['error'] = $this->error;
                        $args['country'] = $this->getCountry();
                        $args['language'] = $this->getLanguage();

                        SQ_Action::apiCall('sq/user-analytics/saveserp', $args);

                        $count++;
                        sleep(mt_rand(20, 50));
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
