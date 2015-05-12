<?php

class SQ_Frontend extends SQ_FrontController {

    public static $options;

    public function __construct() {

        if ($this->_isAjax())
            return;

        parent::__construct();
        SQ_ObjController::getController('SQ_Tools', false);

        /* Check if sitemap is on  */
        if (SQ_Tools::$options['sq_use'] == 1 && SQ_Tools::$options['sq_auto_sitemap'] == 1) {
            /* Load the Sitemap  */
            SQ_ObjController::getController('SQ_Sitemaps');
        }

        //validate custom arguments for favicon and sitemap
        add_filter('query_vars', array($this, 'validateParams'), 1, 1);
        add_action('template_redirect', array($this, 'startBuffer'), 0);
    }

    private function _isAjax() {
        if (isset($_SERVER['PHP_SELF']) && strpos($_SERVER['PHP_SELF'], '/admin-ajax.php') !== false)
            return true;

        return false;
    }

    public function startBuffer() {
        if (SQ_Tools::$options['sq_use'] == 1) {
            if ($this->_isAjax()) {
                return;
            }
            add_filter('sq_title', array($this->model, 'clearTitle'));
            add_filter('sq_description', array($this->model, 'clearDescription'));
            //Use buffer only for meta Title
            $this->model->startBuffer();
        }
    }

    /**
     * Called after plugins are loaded
     */
    public function hookPreload() {
        if (SQ_Tools::getValue('sq_use') == 'on') {
            SQ_Tools::$options['sq_use'] = 1;
        } elseif (SQ_Tools::getValue('sq_use') == 'off') {
            SQ_Tools::$options['sq_use'] = 0;
        }


        //Check for sitemap and robots
        if (SQ_Tools::$options['sq_use'] == 1) {
            if (isset($_SERVER['REQUEST_URI']) && SQ_Tools::$options['sq_auto_robots'] == 1) {
                if (substr(strrchr($_SERVER['REQUEST_URI'], "/"), 1) == "robots.txt" || $_SERVER['REQUEST_URI'] == "/robots.txt") {
                    $this->model->robots();
                }
            }
        }
        //check the action call
        $this->action();
    }

    /**
     * Hook the Header load
     */
    public function hookFronthead() {
        if ($this->_isAjax())
            return;

        echo $this->model->setStart();

        if (isset(SQ_Tools::$options['sq_use']) && (int) SQ_Tools::$options['sq_use'] == 1) {
            //flush the header with the title and removing duplicates
            $this->model->flushHeader();

            //show the Squirrly header
            echo $this->model->setHeader();
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

        @preg_match_all('/<img[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', $content, $out);
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

        @preg_match_all('/<a[^>]*href=[\'"]([^\'"]+)[\'"][^>]*>/i', $content, $out);
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
     * Validate the params for getting the basic info from the server
     * eg favicon.ico
     *
     * @param array $vars
     * @return $vars
     */
    public function validateParams($vars) {
        $vars[] = 'sq_get';
        $vars[] = 'sq_size';
        return $vars;
    }

    public function action() {

        switch (get_query_var('sq_get')) {
            case 'favicon':
                if (SQ_Tools::$options['favicon'] <> '') {
                    //show the favico file
                    SQ_Tools::setHeader('ico');
                    echo readfile(_SQ_CACHE_DIR_ . SQ_Tools::$options['favicon']);
                    exit();
                }
                break;
            case 'touchicon':
                $size = get_query_var('sq_size');
                if (SQ_Tools::$options['favicon'] <> '') {
                    //show the favico file
                    SQ_Tools::setHeader('png');
                    if ($size <> '') {
                        echo readfile(_SQ_CACHE_DIR_ . SQ_Tools::$options['favicon'] . get_query_var('sq_size'));
                    } else {
                        echo readfile(_SQ_CACHE_DIR_ . SQ_Tools::$options['favicon']);
                    }
                    exit();
                }
        }
    }

}
