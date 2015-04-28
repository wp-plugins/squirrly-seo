<?php

/**
 * Account settings
 */
class SQ_BlockSettingsSeo extends SQ_BlockController {

    function hookGetContent() {
        parent::preloadSettings();
        /* Force call of error display */
        SQ_ObjController::getController('SQ_Error', false)->hookNotices();
        echo '<script type="text/javascript">
                   var __snippetshort = "' . __('Too short', _SQ_PLUGIN_NAME_) . '";
                   var __snippetlong = "' . __('Too long', _SQ_PLUGIN_NAME_) . '";
             </script>';
    }

    function hookHead() {
        wp_enqueue_media();
        parent::hookHead();
    }

    /**
     * Called when Post action is triggered
     *
     * @return void
     */
    public function action() {
        parent::action();

        switch (SQ_Tools::getValue('action')) {

            case 'sq_settingsseo_update':
                if (!SQ_Tools::getIsset('sq_use')) {
                    return;
                }

                SQ_Tools::saveOptions('sq_use', (int) SQ_Tools::getValue('sq_use'));
                SQ_Tools::saveOptions('sq_auto_title', (int) SQ_Tools::getValue('sq_auto_title'));
                SQ_Tools::saveOptions('sq_auto_description', (int) SQ_Tools::getValue('sq_auto_description'));
                SQ_Tools::saveOptions('sq_auto_canonical', (int) SQ_Tools::getValue('sq_auto_canonical'));

                SQ_Tools::saveOptions('sq_auto_meta', (int) SQ_Tools::getValue('sq_auto_meta'));
                SQ_Tools::saveOptions('sq_auto_favicon', (int) SQ_Tools::getValue('sq_auto_favicon'));

///////////////////////////////////////////
/////////////////////////////SOCIAL OPTION
                SQ_Tools::saveOptions('sq_auto_facebook', (int) SQ_Tools::getValue('sq_auto_facebook'));
                SQ_Tools::saveOptions('sq_auto_twitter', (int) SQ_Tools::getValue('sq_auto_twitter'));

                SQ_Tools::saveOptions('sq_twitter_account', $this->model->checkTwitterAccount(SQ_Tools::getValue('sq_twitter_account')));
                SQ_Tools::saveOptions('sq_facebook_account', $this->model->checkFacebookAccount(SQ_Tools::getValue('sq_facebook_account')));
                SQ_Tools::saveOptions('sq_google_plus', $this->model->checkGoogleAccount(SQ_Tools::getValue('sq_google_plus')));
                SQ_Tools::saveOptions('sq_linkedin_account', $this->model->checkLinkeinAccount(SQ_Tools::getValue('sq_linkedin_account')));

///////////////////////////////////////////
/////////////////////////////FIRST PAGE OPTIMIZATION
                SQ_Tools::saveOptions('sq_auto_seo', 0);
                if ($pageId = get_option('page_on_front')) {
                    $meta = array();
                    if (SQ_Tools::getIsset('sq_fp_title'))
                        $meta[] = array('key' => '_sq_fp_title', 'value' => urldecode(SQ_Tools::getValue('sq_fp_title')));

                    if (SQ_Tools::getIsset('sq_fp_description'))
                        $meta[] = array('key' => '_sq_fp_description', 'value' => urldecode(SQ_Tools::getValue('sq_fp_description')));

                    if (SQ_Tools::getIsset('sq_fp_keywords'))
                        $meta[] = array('key' => '_sq_fp_keywords', 'value' => SQ_Tools::getValue('sq_fp_keywords'));

                    if (SQ_Tools::getIsset('sq_fp_ogimage'))
                        $meta[] = array('key' => '_sq_fp_ogimage', 'value' => SQ_ObjController::getModel('SQ_Frontend')->getAdvancedMeta($pageId, 'ogimage'));

                    if (!empty($meta))
                        SQ_ObjController::getModel('SQ_Post')->saveAdvMeta($pageId, $meta);
                }else {
                    SQ_Tools::saveOptions('sq_fp_title', SQ_Tools::getValue('sq_fp_title'));
                    SQ_Tools::saveOptions('sq_fp_description', SQ_Tools::getValue('sq_fp_description'));
                    SQ_Tools::saveOptions('sq_fp_keywords', SQ_Tools::getValue('sq_fp_keywords'));
                }

///////////////////////////////////////////
/////////////////////////////SITEMAP OPTION
                SQ_Tools::saveOptions('sq_auto_sitemap', (int) SQ_Tools::getValue('sq_auto_sitemap'));
                SQ_Tools::saveOptions('sq_sitemap_frequency', SQ_Tools::getValue('sq_sitemap_frequency'));
                SQ_Tools::saveOptions('sq_sitemap_ping', (int) SQ_Tools::getValue('sq_sitemap_ping'));

                foreach (SQ_Tools::$options['sq_sitemap'] as $key => $value) {
                    if ($key == 'sitemap') {
                        continue;
                    }
                    SQ_Tools::$options['sq_sitemap'][$key][1] = 0;
                    if ($key == 'sitemap-product' && !$this->model->isEcommerce()) {
                        SQ_Tools::$options['sq_sitemap'][$key][1] = 2;
                    }
                }
                if (SQ_Tools::getIsset('sq_sitemap')) {
                    foreach (SQ_Tools::getValue('sq_sitemap') as $key) {
                        if (isset(SQ_Tools::$options['sq_sitemap'][$key][1])) {
                            SQ_Tools::$options['sq_sitemap'][$key][1] = 1;
                        }
                    }
                }

                foreach (SQ_Tools::$options['sq_sitemap_show'] as $key => $value) {
                    SQ_Tools::$options['sq_sitemap_show'][$key] = 0;
                }
                if (SQ_Tools::getIsset('sq_sitemap_show')) {
                    foreach (SQ_Tools::getValue('sq_sitemap_show') as $key) {
                        if (isset(SQ_Tools::$options['sq_sitemap_show'][$key])) {
                            SQ_Tools::$options['sq_sitemap_show'][$key] = 1;
                        }
                    }
                }

///////////////////////////////////////////


                SQ_Tools::saveOptions('sq_google_analytics', $this->model->checkGoogleAnalyticsCode(SQ_Tools::getValue('sq_google_analytics')));
                SQ_Tools::saveOptions('sq_facebook_insights', $this->model->checkFavebookInsightsCode(SQ_Tools::getValue('sq_facebook_insights')));
                SQ_Tools::saveOptions('sq_pinterest', $this->model->checkPinterestCode(SQ_Tools::getValue('sq_pinterest','',true)));

///////////////////////////////////////////JSONLD

                SQ_Tools::saveOptions('sq_auto_jsonld', (int) SQ_Tools::getValue('sq_auto_jsonld'));
                if (SQ_Tools::getIsset('sq_jsonld_type') && isset(SQ_Tools::$options['sq_jsonld'][SQ_Tools::getValue('sq_jsonld_type')])) {

                    foreach (SQ_Tools::$options['sq_jsonld'][SQ_Tools::getValue('sq_jsonld_type')] as $key => $value) {
                        if (isset(SQ_Tools::$options['sq_jsonld'][SQ_Tools::getValue('sq_jsonld_type')][$key])) {
                            SQ_Tools::$options['sq_jsonld'][SQ_Tools::getValue('sq_jsonld_type')][$key] = SQ_Tools::getValue('sq_jsonld_' . $key);
                        }
                    }
                }
                SQ_Tools::saveOptions('sq_jsonld_type', SQ_Tools::getValue('sq_jsonld_type'));

///////////////////////////////////////////
/////////////////////////////FAVICON OPTION

                /* if there is an icon to upload */
                if (!empty($_FILES['favicon'])) {

                    $return = $this->model->addFavicon($_FILES['favicon']);
                    if ($return['favicon'] <> '') {
                        SQ_Tools::saveOptions('favicon', strtolower(basename($return['favicon'])));
                    }
                    if ($return['message'] <> '') {
                        define('SQ_MESSAGE_FAVICON', $return['message']);
                    }
                }

                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);
                //Update the rewrite rules with the new options
                add_filter('rewrite_rules_array', array($this, 'rewrite_rules'), 999, 1);
                //Flush the rewrite with the new favicon and sitemap
                global $wp_rewrite;
                $wp_rewrite->flush_rules();

                //empty the cache on settings changed
                SQ_Tools::emptyCache();
                break;
            case 'sq_checkissues':
                SQ_Tools::saveOptions('sq_checkedissues', 1);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                /* Load the error class */
                SQ_Tools::checkErrorSettings();

                break;
            case 'sq_fixautoseo':
                SQ_Tools::saveOptions('sq_use', 1);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_fixprivate':
                update_option('blog_public', 1);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_fixcomments':
                update_option('comments_notify', 1);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_fixpermalink':
                $GLOBALS['wp_rewrite'] = new WP_Rewrite();
                global $wp_rewrite;
                $permalink_structure = ((get_option('permalink_structure') <> '') ? get_option('permalink_structure') : '/') . "%postname%/";
                $wp_rewrite->set_permalink_structure($permalink_structure);
                $permalink_structure = get_option('permalink_structure');

                flush_rewrite_rules();
                break;
            case 'sq_fix_ogduplicate':
                SQ_Tools::saveOptions('sq_auto_facebook', 0);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_fix_tcduplicate':
                SQ_Tools::saveOptions('sq_auto_twitter', 0);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_fix_titleduplicate':
                SQ_Tools::saveOptions('sq_auto_title', 0);
                SQ_Tools::saveOptions('sq_auto_seo', 1);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_fix_descduplicate':
                SQ_Tools::saveOptions('sq_auto_description', 0);
                SQ_Tools::saveOptions('sq_auto_seo', 1);
                SQ_Action::apiCall('sq/user/settings', array('settings' => json_encode(SQ_Tools::getBriefOptions())), 10);

                break;
            case 'sq_active_help' :
                SQ_Tools::saveOptions('active_help', SQ_Tools::getValue('active_help'));
                break;
            case 'sq_warnings_off':
                SQ_Tools::saveOptions('ignore_warn', 1);
                break;
            case 'sq_get_snippet':
                if (SQ_Tools::getValue('url') <> '') {
                    $url = SQ_Tools::getValue('url');
                } else {
                    $url = get_bloginfo('url');
                }
                $snippet = SQ_Tools::getSnippet($url);
//SQ_Tools::dump($snippet);

                /* if((int)SQ_Tools::getValue('post_id') > 0)
                  $snippet['url'] = get_permalink((int)SQ_Tools::getValue('post_id'));
                 */
                echo json_encode($snippet);
                exit();
        }
    }

    /**
     * Add the favicon in the rewrite rule
     * @param type $wp_rewrite
     */
    public function rewrite_rules($wp_rewrite) {
        $rules = array();
        if (SQ_Tools::$options['sq_use'] == 1) {

            //For Favicon
            if (SQ_Tools::$options['sq_auto_favicon'] == 1) {
                $rules['favicon\.ico$'] = 'index.php?sq_get=favicon';
                $rules['favicon\.icon$'] = 'index.php?sq_get=favicon';
                $rules['touch-icon\.png$'] = 'index.php?sq_get=touchicon';
                foreach ($this->model->appleSizes as $size) {
                    $rules['touch-icon' . $size . '\.png$'] = 'index.php?sq_get=touchicon&sq_size=' . $size;
                }
            }

            //For Sitemap
            if (SQ_Tools::$options['sq_auto_sitemap'] == 1) {
                foreach (SQ_Tools::$options['sq_sitemap'] as $name => $sitemap) {
                    if ($sitemap[1] == 1 || $sitemap[1] == 2) { // is show sitemap
                        $rules[preg_quote($sitemap[0])] = 'index.php?feed=' . $name;
                    }
                }
            }
        }
        return array_merge($rules, $wp_rewrite);
    }

}
