<?php

class SQ_Frontend extends SQ_FrontController {

    public static $options;

    public function __construct() {
        if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || strpos($_SERVER['PHP_SELF'], '/admin-ajax.php') !== false)
            return;

        parent::__construct();

        SQ_ObjController::getController('SQ_Tools', false);
        self::$options = SQ_Tools::getOptions();

        if (SQ_Tools::getValue('sq_use') == 'on')
            self::$options['sq_use'] = 1;
        elseif (SQ_Tools::getValue('sq_use') == 'off')
            self::$options['sq_use'] = 0;
    }

    /**
     * Called after plugins are loaded
     */
    public function hookLoaded() {
        if (self::$options['sq_use'] == 1) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
                return;
            if (strpos($_SERVER['PHP_SELF'], '/admin-ajax.php') !== false)
                return;
            //Use buffer only for meta Title
            //if(self::$options['sq_auto_title'] == 1)
            $this->model->startBuffer();
        }
    }

    public function action() {

    }

    /**
     * Hook the Header load
     */
    public function hookFronthead() {
        if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || strpos($_SERVER['PHP_SELF'], '/admin-ajax.php') !== false)
            return;

        echo $this->model->setStart();

        if (isset(self::$options['sq_use']) && (int) self::$options['sq_use'] == 1) {
            echo $this->model->setHeader();

            //Use buffer only for meta Title
            //if(self::$options['sq_auto_title'] == 1)
            $this->model->flushHeader();
        }

        SQ_ObjController::getController('SQ_DisplayController', false)
                ->loadMedia(_SQ_THEME_URL_ . 'css/sq_frontend.css');
    }

    /**
     * Change the image path to absolute when in feed
     */
    public function hookFrontcontent($content) {
        if (!is_feed())
            return $content;


        $find = $replace = $urls = array();

        @preg_match_all('/<img[^>]*src="([^"]+)"[^>]*>/i', $content, $out);
        if (is_array($out)) {
            if (!is_array($out[1]) || empty($out[1]))
                return $content;

            foreach ($out[1] as $row) {
                if (strpos($row, '//') === false) {
                    if (!in_array($row, $urls)) {
                        $urls[] = $row;
                    }
                }
            }
        }
        if (!is_array($urls) || (is_array($urls) && empty($urls)))
            return $content;

        foreach ($urls as $url) {
            $find[] = $url;
            $replace[] = get_bloginfo('url') . $url;
        }
        if (!empty($find) && !empty($replace)) {
            $content = str_replace($find, $replace, $content);
        }

        return $content;
    }

    /**
     * Hook Footer load to save the visit and to close the buffer
     */
    public function hookFrontfooter() {
        if (isset(self::$options['sq_use']) && (int) self::$options['sq_use'] == 1) {
            //Be sure the heder is flushed
            //if(self::$options['sq_auto_title'] == 1)
            $this->model->flushHeader();
        }

        if (isset(self::$options['sq_analytics_code']) && !( current_user_can('edit_posts') )) {
            $this->model->setFooter(self::$options['sq_analytics_code']);
        }
    }

}
