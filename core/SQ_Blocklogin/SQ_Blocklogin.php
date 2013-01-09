<?php
class SQ_Blocklogin extends SQ_BlockController {
    function init() {
        if (SQ_Tools::$options['sq_api'] <> '') return;
        parent::init();
    }
    
    //called for sq_login
    function action(){
        parent::action();
        switch (SQ_Tools::getValue('action')){
            case 'sq_login':
                $this->squirrlyLogin();
                break;
            case 'sq_register':
                $this->squirrlyRegister();
                break;
        }
    }
    
    function squirrlyRegister(){
        global $current_user;
       
        $args['name'] = $current_user->display_name;
        
        if (SQ_Tools::getValue('email') <> ''){
            $args['user'] = SQ_Tools::getValue('email');
            $args['email'] = SQ_Tools::getValue('email');
            
        }else{
            $args['user'] = $current_user->user_email;
            $args['email'] = $current_user->user_email;
        }
        if($args['email'] <> ''){   
            $return = SQ_Action::apiCall('sq/register',$args);
            $return = json_decode($return);
            
            if (isset($return->token)){
                SQ_Tools::saveOptions('sq_api', $return->token);
                
            }elseif(!empty($return->error)){
                switch ($return->error){
                    case 'alreadylogin':
                        $return->info = sprintf(__('We found your email, so it means you already have a Squirrly.co account. Please login with your Squirrly ID. If you forgot your password click %shere%s',_PLUGIN_NAME_),'<a href="'._SQ_DASH_URL_ .'login/?action=lostpassword" target="_blank">','</a>');
                        break;
                }
            }else
                $return->error = __('An error occured.',_PLUGIN_NAME_);
        }else
            $return->error = sprintf(__('Could not send your informations to squirrly. Please register %smanually%s.',_PLUGIN_NAME_),'<a href="'._SQ_DASH_URL_ .'login/?action=register" target="_blank">','</a>');
        
        header('Content-Type: application/json');
        echo json_encode($return);
        exit();
    }
    
    function squirrlyLogin(){

        $args['user'] = SQ_Tools::getValue('user');
        $args['password'] = SQ_Tools::getValue('password');
        if($args['user'] <> '' && $args['password'] <> ''){    
            if(function_exists('mcrypt_create_iv') && function_exists('mcrypt_encrypt') && function_exists('hash')){
                $args['password'] = $this->sq_crypt($args['user'], $args['password']);
            }else {
                $args['encrypted'] = '0';
            }
            $return = SQ_Action::apiCall('sq/login',$args);
            $return = json_decode($return);
            
            if (isset($return->token)){
                SQ_Tools::saveOptions('sq_api', $return->token);
                
            }elseif(!empty($return->error)){
                switch ($return->error){
                    case 'badlogin':
                        $return->error = __('Wrong username or password!',_PLUGIN_NAME_);
                        break;
                    case 'multisite':
                        $return->error = __('You can use this account only for the URL you registered first!',_PLUGIN_NAME_);
                        break;
                }
            }else
                $return->error = __('An error occured.',_PLUGIN_NAME_);
        }else
            $return->error = __('Both fields are required.',_PLUGIN_NAME_);
        
        header('Content-Type: application/json');
        echo json_encode($return);
        exit();
    }
    
    private function sq_crypt($user, $password){
        
        $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
            MCRYPT_DEV_URANDOM
        );

        $encrypted = base64_encode(
            $iv .
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256,
                hash('sha256', $user, true),
                $password,
                MCRYPT_MODE_CBC,
                $iv
            )
        );
        //echo $encrypted ."\n";
        return $encrypted;
    }
}

?>