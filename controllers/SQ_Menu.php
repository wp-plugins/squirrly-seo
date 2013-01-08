<?php
class SQ_Menu extends SQ_FrontController {
	// 
        function init(){}
	
        /*
         * Creates the Setting menu in Wordpress
         */
        public function hookMenu(){
            SQ_Tools::checkErrorSettings(true);
            /* add the plugin menu in admin */
            $this->model->addMenu(array(    ucfirst(_SQ_NAME_),
                                            ucfirst(_SQ_NAME_) . SQ_Tools::showNotices(SQ_Tools::$errors_count, 'errors_count'),
                                            'edit_posts',
                                            preg_replace ('/\s/','_',_SQ_NAME_) ,
                                            array($this,'showMenu')
                                      ));



            $this->model->addMeta(array(    'post'._SQ_NAME_,
                                            ucfirst(_SQ_NAME_),
                                            array(SQ_ObjController::getController('SQ_Post'), 'init'),
                                            'post', 
                                            'side', 
                                            'high'
                                    ));
            $this->model->addMeta(array(    'post'._SQ_NAME_,
                                            ucfirst(_SQ_NAME_),
                                            array(SQ_ObjController::getController('SQ_Post'), 'init'),
                                            'page', 
                                            'side', 
                                            'high'
                                    ));
		
		
	}
        
        /**
         * Show the menu content after click event
         * 
         * @return void
         */
	function showMenu(){
            
            SQ_Tools::checkErrorSettings();
            /* Force call of error display */
            SQ_ObjController::getController('SQ_Error', false)->hookNotices();

            /* Get the options from Database*/
            $this->options = SQ_Tools::$options;
            parent::init();
            
 		
	} 
        
        /**
         * Called when Post action is triggered
         * 
         * @return void
         */
        public function action(){
          parent::action();
          
                
          switch (SQ_Tools::getValue('action')){
            case 'sq_update':
                
                SQ_Tools::saveOptions('sq_use', SQ_Tools::getValue('sq_use'));
                //SQ_Tools::saveOptions('sq_api', SQ_Tools::getValue('sq_api'));

                SQ_Tools::saveOptions('sq_fp_title', SQ_Tools::getValue('sq_fp_title'));
                SQ_Tools::saveOptions('sq_fp_description', SQ_Tools::getValue('sq_fp_description'));
                SQ_Tools::saveOptions('sq_fp_keywords', SQ_Tools::getValue('sq_fp_keywords'));
                

                SQ_Tools::saveOptions('sq_google_plus', SQ_Tools::getValue('sq_google_plus'));
                SQ_Tools::saveOptions('sq_google_wt', $this->model->checkGoogleWTCode(SQ_Tools::getValue('sq_google_wt')));
                SQ_Tools::saveOptions('sq_google_analytics', $this->model->checkGoogleAnalyticsCode(SQ_Tools::getValue('sq_google_analytics')));
                SQ_Tools::saveOptions('sq_facebook_insights', $this->model->checkFavebookInsightsCode(SQ_Tools::getValue('sq_facebook_insights')));
                SQ_Tools::saveOptions('sq_bing_wt', $this->model->checkBingWTCode(SQ_Tools::getValue('sq_bing_wt')));
                
                SQ_Tools::saveOptions('ignore_warn', SQ_Tools::getValue('ignore_warn'));
                
                /* if there is an icon to upload*/
                if (!empty($_FILES['favicon'])) {
                   
                    $return = $this->model->addFavicon($_FILES['favicon']);
                    if($return['favicon'] <> '')
                        SQ_Tools::saveOptions('favicon', $return['favicon']);
                    if($return['name'] <> '')
                        SQ_Tools::saveOptions('favicon_tmp', $return['name']);
                    if($return['message']<> '')
                        define('SQ_MESSAGE_FAVICON', $return['message']);
                }
                
                /* Generate the sitemap*/
                if(SQ_Tools::getValue('sq_use'))
                    add_action('admin_footer', array(SQ_ObjController::getController('SQ_Sitemap', false), 'generateSitemap'),9999,1);
                
                break;
            case 'sq_fixautoseo':
                SQ_Tools::saveOptions('sq_use', 1);
                break;
            case 'sq_fixprivate':
                update_option('blog_public', 1);
                break;
            case 'sq_fixcomments':
                update_option('comments_notify', 1);
                break;
            case 'sq_fixpermalink':
                $GLOBALS['wp_rewrite'] = new WP_Rewrite();
                global $wp_rewrite;
                $permalink_structure = ((get_option('permalink_structure') <> '') ? get_option('permalink_structure') : '/') . "%postname%/" ;
                $wp_rewrite->set_permalink_structure( $permalink_structure );
                $permalink_structure = get_option('permalink_structure');
                
                flush_rewrite_rules();
                break;
            case 'sq_warnings_off':
                SQ_Tools::saveOptions('ignore_warn', 1);
                break;
            
            
          }
            
            
        }
}


?>