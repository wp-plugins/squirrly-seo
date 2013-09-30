<?php

/**
 * Affiliate settings
 */
class ABH_Core_UserSettings extends ABH_Classes_BlockController {

    public $user;
    public $author = array();
    public $themes = array();

    public function init($user) {
        $this->user = $user;
        if (isset($this->user->ID))
            $this->author = ABH_Classes_Tools::getOption('abh_author' . $this->user->ID);

        $default = array(
            'abh_use' => 1,
            // --
            'abh_title' => "",
            'abh_company' => "",
            'abh_company_url' => "",
            // --
            'abh_twitter' => "",
            'abh_facebook' => "",
            'abh_google' => "",
            'abh_linkedin' => "",
            'abh_instagram' => "",
            'abh_flickr' => "",
            'abh_pinterest' => "",
            'abh_tumblr' => "",
            'abh_youtube' => "",
            'abh_vimeo' => "",
            'abh_klout' => "",
            'abh_gravatar' => "",
        );
        if (!isset($this->author['abh_use']))
            $this->author = $default;

        if (!isset($this->author['abh_gravatar']))
            $this->author['abh_gravatar'] = "";
        if (!isset($this->author['abh_klout']))
            $this->author['abh_klout'] = "";

        $this->themes = ABH_Classes_Tools::getOption('abh_themes');

        parent::init();
    }

    public function action() {
        switch (ABH_CLasses_Tools::getValue('action')) {
            //login action
            case 'update':
            case 'createuser':
                $user_id = ABH_CLasses_Tools::getValue('user_id');

                $settings['abh_use'] = (bool) ABH_CLasses_Tools::getValue('abh_use');

                $settings['abh_title'] = ABH_CLasses_Tools::getValue('abh_title');
                $settings['abh_company'] = ABH_CLasses_Tools::getValue('abh_company');
                $settings['abh_company_url'] = ABH_CLasses_Tools::getValue('abh_company_url');
                $settings['abh_twitter'] = ABH_CLasses_Tools::getValue('abh_twitter');
                $settings['abh_facebook'] = ABH_CLasses_Tools::getValue('abh_facebook');
                $settings['abh_google'] = ABH_CLasses_Tools::getValue('abh_google');
                $settings['abh_linkedin'] = ABH_CLasses_Tools::getValue('abh_linkedin');
                $settings['abh_klout'] = ABH_CLasses_Tools::getValue('abh_klout');
                $settings['abh_instagram'] = ABH_CLasses_Tools::getValue('abh_instagram');
                $settings['abh_flickr'] = ABH_CLasses_Tools::getValue('abh_flickr');
                $settings['abh_pinterest'] = ABH_CLasses_Tools::getValue('abh_pinterest');
                $settings['abh_tumblr'] = ABH_CLasses_Tools::getValue('abh_tumblr');
                $settings['abh_youtube'] = ABH_CLasses_Tools::getValue('abh_youtube');
                $settings['abh_vimeo'] = ABH_CLasses_Tools::getValue('abh_vimeo');

                // --
                $settings['abh_theme'] = ABH_CLasses_Tools::getValue('abh_theme');
                $settings['abh_position'] = ABH_CLasses_Tools::getValue('abh_position');
                /* if there is an icon to upload */
                if (!empty($_FILES['abh_gravatar'])) {

                    $return = $this->model->addImage($_FILES['abh_gravatar']);
                    if ($return['name'] <> '')
                        $settings['abh_gravatar'] = $return['name'];
                    if ($return['message'] <> '')
                        define('ABH_MESSAGE_FAVICON', $return['message']);
                }

                if (ABH_CLasses_Tools::getValue('abh_resetgravatar'))
                    $settings['abh_gravatar'] = '';

                ABH_Classes_Tools::saveOptions('abh_author' . $user_id, $settings);

                ABH_Classes_Tools::emptyCache();

                ABH_Classes_Tools::checkErrorSettings();
                /* Force call of error display */
                ABH_Classes_ObjController::getController('ABH_Classes_Error')->hookNotices();
                break;
        }
    }

}

?>