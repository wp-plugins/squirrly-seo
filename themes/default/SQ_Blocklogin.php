<div id="sq_blocklogin" class="sq_box">
      <div class="sq_header"><?php _e('Squirrly.co Login', _PLUGIN_NAME_); ?></div>
      <div class="sq_body">
          <ul style="display: none;">
            <li><div class="sq_info" style="font-weight: bold; color: #333;"><?php echo sprintf(__('You are not connected with %sSquirrly.co%s.', _PLUGIN_NAME_), '<a href="'._SQ_DASH_URL_ .'login/?action=register'.'" target="_blank">','</a>'); ?></div>
                <div class="sq_error"></div>
                <div class="sq_message" style="display: none;"></div>
            </li>
            <li><label for="sq_user"><?php _e('Squirrly ID:', _PLUGIN_NAME_); ?></label><input type="text" id="sq_user" name="sq_user" autocomplete="off" /></li>
            <li><label for="sq_password"><?php _e('Password:', _PLUGIN_NAME_); ?></label><input type="password" id="sq_password" name="sq_password" autocomplete="off" /></li>
            <li><input type="button" id="sq_login" value="<?php _e('Login', _PLUGIN_NAME_); ?>"  /></li>
            <li><a href="<?php echo _SQ_DASH_URL_ .'login/?action=register'?>" target="_blank" title="<?php _e('Register', _PLUGIN_NAME_); ?>"><?php _e('Register to Squirrly.co', _PLUGIN_NAME_); ?></a> |
                <a href="<?php echo _SQ_DASH_URL_ .'login/?action=lostpassword'?>" target="_blank" title="<?php _e('Lost password?', _PLUGIN_NAME_); ?>"><?php _e('Lost password', _PLUGIN_NAME_); ?></a></li>
          </ul>
          <div id="sq_autologin" align="center">
              <div class="sq_error"></div>
              <span id="sq_register"><?php _e('Connecting ...', _PLUGIN_NAME_); ?></span><span id="sq_register_wait"></span>
              <div id="sq_register_email" style="display: none"><label for="sq_email"><?php _e('Your E-mail:', _PLUGIN_NAME_); ?></label><input type="text" id="sq_email" name="sq_email" autocomplete="off" /></div>
              <div id="sq_loginimage"></div>
              <span><?php _e('Having trouble logging in? Please click the Support button above.', _PLUGIN_NAME_); ?></span>
          </div>
          
      </div>
      <script type="text/javascript">
          autoLogin();
          //Call the autologin 
          var __invalid_email = '<?php _e('The email address is invalid!',_PLUGIN_NAME_); ?>';
          var __try_again = '<?php _e('Click on image and try again ...',_PLUGIN_NAME_); ?>';
          var __error_login = '<?php _e('An error occured while login!',_PLUGIN_NAME_); ?>';
          var __connecting = '<?php _e('Connecting ...',_PLUGIN_NAME_); ?>';
          jQuery('#sq_loginimage').live('click', function(){
              autoLogin();
          });
      </script>
</div>