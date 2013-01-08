<?php
class SQ_Post extends SQ_FrontController {
    
    function hookInit(){
        if ( get_user_option('rich_editing') == 'true') {
            add_filter( 'tiny_mce_before_init', array(&$this->model,'setCallback') );
            
            add_filter('mce_external_plugins',  array(&$this->model,'addHeadingButton') );
            add_filter('mce_buttons', array(&$this->model,'registerButton'));
        }else{
            SQ_Error::setError(__('For Squirrly to work, you have to have tinymce installed!', _PLUGIN_NAME_));
        }
        add_action('save_post', array($this, 'hookSavePost'), 10);

    }
    
    
    
    function hookSavePost($post_id){       
        $file_name = false;
         // unhook this function so it doesn't loop infinitely
        remove_action('save_post', array($this, 'hookSavePost'), 10);
        
        if(wp_is_post_revision($post_id) == '' && wp_is_post_autosave($post_id) == '' && get_post_status($post_id) != 'auto-draft' && SQ_Tools::getValue('autosave') == ''){
            $this->checkSeo($post_id);
            $this->checkImage($post_id);
        }
        add_action('save_post', array($this, 'hookSavePost'), 10);
        
    }
    
    function checkImage($post_id){
       

        $img_dir = $this->model->getImgDir();
        $img_url = $this->model->getImgUrl();

        if(!$img_dir || !$img_url)
            return;
        
        $content = stripslashes(SQ_Tools::getValue('post_content'));
        $tmpcontent = trim($content, "\n");
        $urls = array();
        
       @preg_match_all('/<img[^>]+src="([^"]+)"[^>]+>/i', $tmpcontent, $out);
        if(count($out[1]) == 0)
            return;
        
        foreach ($out[1] as $row){
            if(!in_array($row, $urls)){
                $urls[] = $row;
            }
        }
            
        if(count($urls) == 0)
           return;

        
        foreach ($urls as $url){
            if (strpos($url, $this->model->getImgUrl()) !== false) continue;
            
            $file_name = $this->model->upload_image($url);
            if ($file_name !== false) {
                $localurl = $img_url . $file_name;
                $localfile = $img_dir . $file_name;
                $wp_filetype = wp_check_filetype($file_name, null);

                $content = str_replace($url, $localurl, $content);

                $attach_id = wp_insert_attachment(array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', $file_name),
                        'post_content' => '',
                        'post_status' => 'inherit',
                        'guid' => $localurl
                ), $localfile, $post_id);

                $attach_data = wp_generate_attachment_metadata($attach_id, $localfile);
                wp_update_attachment_metadata($attach_id, $attach_data);
            }
        }

        
        if ($file_name !== false){
            $_POST['post_content'] = addslashes($content);

            // update post in database
            wp_update_post(array(
                    'ID' => $post_id, 
                    'post_content' => $content)
            );
        }
    }
    function checkSeo($post_id){
        $seo = SQ_Tools::getValue('sq_seo');
        
        if(count($seo)>0)
           $args['seo'] = implode (',', $seo);
        
        $args['keyword'] = SQ_Tools::getValue('sq_keyword');
        $args['post_id'] = $post_id;
        
        SQ_Action::apiCall('sq/seo/post',$args);
    }
    
    /**
    * Called when Post action is triggered
    * 
    * @return void
    */
    public function action(){
      parent::action();
     
      switch (SQ_Tools::getValue('action')){
       case 'sq_feedback':
            global $current_user;
            $return = array();
            
            $line = "\n"."________________________________________"."\n";
            $from = $current_user->user_email;
            $subject = __('Plugin Feedback',_SQD_PLUGIN_NAME_);
            $face = SQ_Tools::getValue('feedback');
            $message = SQ_Tools::getValue('message');

            if ($message <> '' || (int)$face > 0){
                switch($face){
                    case 1: 
                        $face= 'Angry';
                        break;
                    case 2: 
                        $face= 'Sad';
                        break;
                    case 3: 
                        $face= 'Happy';
                        break;
                    case 4: 
                        $face= 'Excited';
                        break;
                    case 5: 
                        $face= 'Love it';
                        break;
                }
                if ($message <> '')
                    $message = $message . $line;
                
                if($face <> '') {
                    $message .= 'User url:' . get_bloginfo('wpurl') . "\n";
                    $message .= 'User face:' .$face ;
                }
                
                

                $headers[] = 'From: '.$current_user->display_name.' <'.$from.'>';    

                //$this->error='buuum';
                if (wp_mail( _SQ_SUPPORT_EMAIL_, $subject, $message, $headers))
                    $return['message'] = __('Thank you for your feedback',_PLUGIN_NAME_);
                else {
                    $return['message'] = __('Could not send the email...',_PLUGIN_NAME_);
                }
            }else{
                $return['message'] = __('No message.',_SQD_PLUGIN_NAME_);
            }

            header('Content-Type: application/json');
            echo json_encode($return);
            break;
       
       case 'sq_support':
           global $current_user;
            $return = array();
            
            $line = "\n"."________________________________________"."\n";
            $from = $current_user->user_email;
            $subject = __('Plugin Support',_SQD_PLUGIN_NAME_);
            $message = SQ_Tools::getValue('message');

            if ($message <> ''){
                $message = $message . $line;

                $headers[] = 'From: '.$current_user->display_name.' <'.$from.'>';    

                //$this->error='buuum';
                if (wp_mail( _SQ_SUPPORT_EMAIL_, $subject, $message, $headers))
                    $return['message'] = __('Message sent...',_PLUGIN_NAME_);
                else {
                    $return['message'] = __('Could not send the email...',_PLUGIN_NAME_);
                }
            }else{
                $return['message'] = __('No message.',_SQD_PLUGIN_NAME_);
            }

            header('Content-Type: application/json');
            echo json_encode($return);
            break;
      }
      exit();

    }


}

?>