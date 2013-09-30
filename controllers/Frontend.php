<?php

class ABH_Controllers_Frontend extends ABH_Classes_FrontController {

    public static $options;
    private $show = false;

    function __construct() {
        parent::__construct();

        //Load the tools for options in frontend
        ABH_Classes_ObjController::getController('ABH_Classes_Tools');
    }

    /**
     * Hook the Init in Frontend
     */
    function hookFrontinit() {
        if ($this->model->details['abh_google'] <> '') {
            remove_action('wp_head', 'author_rel_link');
        }
    }

    /**
     * Hook the Frontend Header load
     */
    public function hookFronthead() {
        global $wp_query;
        $post = null;

        if ((is_single() && ABH_Classes_Tools::getOption('abh_inposts') == 1) ||
                (is_page() && ABH_Classes_Tools::getOption('abh_inpages') == 1) ||
                (ABH_Classes_Tools::getOption('abh_ineachpost') == 1) && !is_author() && (is_category() || is_tag() || is_page() || is_archive() || is_search())) {

            $theme = ABH_Classes_Tools::getOption('abh_theme');

            foreach ($wp_query->posts as $post) {
                if ($post->ID && get_post_status($post->ID) == 'publish') {
                    // Get the author data
                    $post = get_post($post->ID);
                    break;
                }
            }
            // cancel on errors
            if (!isset($post) || !isset($post->post_author))
                return;

            // get the author data
            $this->model->author = get_userdata($post->post_author);

            //get the author details settings
            $this->model->details = ABH_Classes_Tools::getOption('abh_author' . $this->model->author->ID);

            //Se the author box position
            if (isset($this->model->details['abh_position']))
                $this->model->position = $this->model->details['abh_position'];
            else
                $this->model->position = ABH_Classes_Tools::getOption('abh_position');

            // For some themes the position is important to be on top
            if ($this->model->details['abh_theme'] == 'topstar' || $this->model->details['abh_theme'] == 'topstar-round')
                $this->model->position = 'up'; //force position for this theme

            if (isset($this->model->details) && !empty($this->model->details) && $this->model->details['abh_theme'] <> '')
                $theme = $this->model->details['abh_theme'];

            // set theme for author box shown for each article
            if ((ABH_Classes_Tools::getOption('abh_ineachpost') == 1 && count($wp_query->posts) > 1)) {
                $theme = ABH_Classes_Tools::getOption('abh_achposttheme');
                $this->show = true;
                //echo '<pre>' . print_R($wp_query, true) . '</pre>';
            } elseif (!isset($this->model->details['abh_use']) || $this->model->details['abh_use']) {
                $this->show = true;
            }

            if ($this->show) {
                // load the theme css and js in header
                ABH_Classes_ObjController::getController('ABH_Classes_DisplayController')
                        ->loadMedia(_ABH_ALL_THEMES_URL_ . $theme . '/css/frontend.css'); //load the css and js for frontend
                ABH_Classes_ObjController::getController('ABH_Classes_DisplayController')
                        ->loadMedia(_ABH_ALL_THEMES_URL_ . $theme . '/js/frontend.js'); //load the css and js for frontend

                if (!is_author())
                    echo '<style type="text/css">.author-box, .article-author, #entry-author-info{display:none;}</style>';
            }

            //Add the header meta authors
            //for google
            if (!isset($this->model->details['abh_google']) || $this->model->details['abh_google']) {
                add_action('wp_head', array($this->model, 'showGoogleAuthorMeta'));
            }
            //for facebook
            if (!isset($this->model->details['abh_facebook']) || $this->model->details['abh_facebook']) {
                add_action('wp_head', array($this->model, 'showFacebookAuthorMeta'));
            }
        }
    }

    /**
     * Hook the Frontend Content
     */
    function hookFrontcontent($content) {
        if (!$this->show)
            return $content;

        global $wp_query, $post;
        $box = '';

        if (!isset($this->model->details['abh_google']) || $this->model->details['abh_google']) {
            $content = preg_replace('/rel=[\"|\']([^\"\']*author[^\"\']*)[\"|\']/i', '', $content);
        }

        if (!isset($this->model->details['abh_use']) || $this->model->details['abh_use']) {
            if ((is_single() && ABH_Classes_Tools::getOption('abh_inposts') == 1) ||
                    (is_page() && ABH_Classes_Tools::getOption('abh_inpages') == 1)) {

                $box = $this->model->showAuthorBox();
            }

            switch ($this->model->position) {
                case 'up':
                    $content = $box . $content;
                    break;
                case 'down':
                    $content .= $box;
                    break;
            }
        }

        if (ABH_Classes_Tools::getOption('abh_ineachpost') == 1 && $box == '') {
            $post = get_post($post->ID);
            if (!isset($post->post_author))
                return;

            // get the author data
            $this->model->author = get_userdata($post->post_author);
            //get the author details settings
            $this->model->details = ABH_Classes_Tools::getOption('abh_author' . $this->model->author->ID);

            if ($this->model->details['abh_use'])
                echo $this->model->showAuthorBox();
        }

        return $content;
    }

    /**
     * Hook the Frontend Widgets Content
     */
    function hookFrontwidget($content) {
        if (!$this->show)
            return $content;

        if (!isset($this->model->details['abh_google']) || $this->model->details['abh_google']) {
            $content = preg_replace('/rel=[\"|\']([^\"\']*author[^\"\']*)[\"|\']/i', '', $content);
        }
        return $content;
    }

    /**
     * Hook the Frontend Footer
     */
    function hookFrontfooter() {

    }

}

?>