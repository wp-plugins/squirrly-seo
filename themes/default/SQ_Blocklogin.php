<div id="sq_blocklogin" class="sq_box">
      <div class="sq_header"><?php _e('Squirrly Login', _PLUGIN_NAME_); ?></div>
      <div class="sq_body">
          <ul>
            <li><div class="sq_info"><?php _e('You are not connected with Squirrly.', _PLUGIN_NAME_); ?></div>
                <div class="sq_error"></div>
            </li>
            <li><label for="sq_user"><?php _e('User:', _PLUGIN_NAME_); ?></label><input type="text" id="sq_user" name="sq_user" /></li>
            <li><label for="sq_password"><?php _e('Password:', _PLUGIN_NAME_); ?></label><input type="password" id="sq_password" name="sq_password" /></li>
            <li><input type="button" id="sq_login" value="<?php _e('Login', _PLUGIN_NAME_); ?>"  /></li>
            <li><a href="<?php echo _SQ_DASH_URL_ .'wp-login.php?action=register'?>" target="_blank" title="<?php _e('Register', _PLUGIN_NAME_); ?>"><?php _e('Register', _PLUGIN_NAME_); ?></a> |
                <a href="<?php echo _SQ_DASH_URL_ .'wp-login.php?action=lostpassword'?>" target="_blank" title="<?php _e('Lost password?', _PLUGIN_NAME_); ?>"><?php _e('Lost password', _PLUGIN_NAME_); ?></a></li>
          </ul>
      </div>

</div>