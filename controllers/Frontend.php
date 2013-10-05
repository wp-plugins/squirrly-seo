<?php

class ABH_Controllers_Frontend extends ABH_Classes_FrontController {

    public static $options;
    private $box = '';
    private $show = false;
    public $custom = false;

    function __construct() {
        parent::__construct();

        //Load the tools for options in frontend
        ABH_Classes_ObjController::getController('ABH_Classes_Tools');
    }

    /**
     * Get the author box
     * Dependency: hookFronthead();
     * @return string|false if the author  is not found
     */
    public function getBox() {
        $this->model->single = true;
        return $this->model->getAuthorBox();
    }

    /**
     * Show the author box to the correct position
     * @param string $content
     * @return string
     */
    public function showAuthorBox($content = '') {
        if (!isset($this->model->details['abh_google']) || $this->model->details['abh_google']) {
            $content = preg_replace('/rel=[\"|\']([^\"\']*author[^\"\']*)[\"|\']/i', '', $content);
        }

        if (!isset($this->model->details['abh_use']) || $this->model->details['abh_use']) {
            if ((is_single() && ABH_Classes_Tools::getOption('abh_inposts') == 1) ||
                    (is_page() && ABH_Classes_Tools::getOption('abh_inpages') == 1)) {
                $this->model->single = true;
                $this->box = $this->getBox();
            }

            switch ($this->model->position) {
                case 'up':
                    $content = $this->box . $content;
                    break;
                case 'down':
                default:
                    $content .= $this->box;
                    break;
            }
        }
        return $content;
    }

    /**
     * If called it will return the box and will not show the author box in article
     *  @param int $author_id
     * @return string
     */
    public function showBox($author_id = 0) {

        $this->custom = true;

        if ($author_id == 0) {
            global $wp_query;
            if (!empty($wp_query->posts))
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
            if (is_author())
                $this->model->author = get_queried_object();
            else
                $this->model->author = get_userdata($post->post_author);
        }else {
            $this->model->author = get_userdata($author_id);
        }



        //get the author details settings
        $this->model->details = ABH_Classes_Tools::getOption('abh_author' . $this->model->author->ID);

        $this->model->position = 'custom';
        return $this->getBox();
    }

    /**
     * Hook the Init in Frontend
     */
    public function hookFrontinit() {
        if ($this->model->details['abh_google'] <> '') {
            remove_action('wp_head', 'author_rel_link');
        }
    }

    /**
     * Hook the Frontend Header load
     */
    public function hookFronthead() {
        global $wp_query;
        //echo '<pre>' . print_r($wp_query, true) . '</pre>';
        $post = null;

        if ((is_single() && (ABH_Classes_Tools::getOption('abh_strictposts') == 0 || (ABH_Classes_Tools::getOption('abh_strictposts') == 1 && get_post_type() == 'post')) && ABH_Classes_Tools::getOption('abh_inposts') == 1) ||
                (is_single() && get_post_type() == 'page' && ABH_Classes_Tools::getOption('abh_inpages') == 1) ||
                (ABH_Classes_Tools::getOption('abh_ineachpost') == 1) && (is_category() || is_tag() || (is_single() && get_post_type() == 'page') || is_archive() || is_search())) {

            $theme = ABH_Classes_Tools::getOption('abh_theme');

            if (!empty($wp_query->posts))
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
            if (is_author())
                $this->model->author = get_queried_object();
            else
                $this->model->author = get_userdata($post->post_author);

            //get the author details settings
            $this->model->details = ABH_Classes_Tools::getOption('abh_author' . $this->model->author->ID);

            //Se the author box position
            if (isset($this->model->details['abh_position']) && $this->model->details['abh_position'] <> 'default')
                $this->model->position = $this->model->details['abh_position'];
            else
                $this->model->position = ABH_Classes_Tools::getOption('abh_position');

            // For some themes the position is important to be on top
            if (strpos($this->model->details['abh_theme'], 'topstar') !== false || ($this->model->details['abh_theme'] == 'default' && strpos(ABH_Classes_Tools::getOption('abh_theme'), 'topstar') !== false))
                $this->model->position = 'up'; //force position for this theme

            if (isset($this->model->details) && !empty($this->model->details) && $this->model->details['abh_theme'] <> '' && $this->model->details['abh_theme'] <> 'default')
                $theme = $this->model->details['abh_theme'];

            // set theme for author box shown for each article
            if (is_author()) {
                //Add the header meta authors for single post
                echo $this->model->showMeta();
            } else {
                if ((ABH_Classes_Tools::getOption('abh_ineachpost') == 1 && count($wp_query->posts) > 1)) {
                    $theme = ABH_Classes_Tools::getOption('abh_achposttheme');
                    $this->show = true;
                    //echo '<pre>' . print_R($wp_query, true) . '</pre>';
                } elseif (!isset($this->model->details['abh_use']) || $this->model->details['abh_use']) {
                    $this->show = true;

                    //Add the header meta authors for single post
                    echo $this->model->showMeta();
                }
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
        }
    }

    /**
     * Hook the Article/Page Content
     * @global object $post
     * @param string $content
     * @return string
     */
    public function hookFrontcontent($content) {
        global $post;

        if (!$this->show || $this->custom)
            return $content;

        $content = $this->showAuthorBox($content);

        if (ABH_Classes_Tools::getOption('abh_ineachpost') == 1 && $this->box == '') {
            $post = get_post($post->ID);
            if (!isset($post->post_author))
                return;

            // get the author data
            $this->model->author = get_userdata($post->post_author);
            //get the author details settings
            $this->model->details = ABH_Classes_Tools::getOption('abh_author' . $this->model->author->ID);

            if ($this->model->details['abh_use']) {
                $this->model->single = false;
                echo $this->model->getAuthorBox();
            }
        }

        return $content;
    }

    /**
     * Hook the Frontend Widgets Content
     */
    public function hookFrontwidget($content) {

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
    public function hookFrontfooter() {

    }

}

?>