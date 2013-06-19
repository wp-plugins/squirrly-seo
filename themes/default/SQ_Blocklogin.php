<div id="sq_blocklogin" class="sq_box">
      <div class="sq_header"><?php _e('Squirrly.co Login', _PLUGIN_NAME_); ?></div>
      <div class="sq_body">
          <ul style="display: none;">
            <li>
                <div class="sq_error"></div>
                <div class="sq_message" style="display: none;"></div>
            </li>
            <li><label for="sq_user"><?php _e('Email:', _PLUGIN_NAME_); ?></label><input type="text" id="sq_user" name="sq_user" /></li>
            <li><label for="sq_password"><?php _e('Password:', _PLUGIN_NAME_); ?></label><input type="password" id="sq_password" name="sq_password"  /></li>
            <li><input type="button" id="sq_login" value="<?php _e('Login', _PLUGIN_NAME_); ?>"  /></li>
            <li><a id="sq_signup" href="javascript:void(0);" target="_blank" title="<?php _e('Register', _PLUGIN_NAME_); ?>"><?php _e('Register to Squirrly.co', _PLUGIN_NAME_); ?></a> |
                <a href="<?php echo _SQ_DASH_URL_ .'login/?action=lostpassword'?>" target="_blank" title="<?php _e('Lost password?', _PLUGIN_NAME_); ?>"><?php _e('Lost password', _PLUGIN_NAME_); ?></a></li>
          </ul>
          <div id="sq_autologin" align="center">
              <div class="sq_error"></div>
              <span id="sq_register"><?php _e('Enter your email', _PLUGIN_NAME_); ?></span><span id="sq_register_wait"></span>
              <div id="sq_register_email" ><label for="sq_email"><?php _e('Your E-mail:', _PLUGIN_NAME_); ?></label><input type="text" id="sq_email" name="sq_email" /></div>
              <div id="sq_loginimage"><?php _e('Sign Up', _PLUGIN_NAME_); ?></div>
              <div id="sq_signin"><?php _e('I already have an account', _PLUGIN_NAME_); ?></div>
              <span><?php _e('This email connects you to Squirrly.co' , _PLUGIN_NAME_); ?></span>

          </div>

      </div>
      <script type="text/javascript">
         // autoLogin();
         //
          //Call the autologin
          var __invalid_email = '<?php _e('The email address is invalid!',_PLUGIN_NAME_); ?>';
          var __try_again = '<?php _e('Click on Sign Up button and try again ...',_PLUGIN_NAME_); ?>';
          var __error_login = '<?php _e('An error occured while logging in!',_PLUGIN_NAME_); ?>';
          var __connecting = '<?php _e('Connecting ...',_PLUGIN_NAME_); ?>';
          jQuery('#sq_loginimage').bind('click', function(){
              sq_autoLogin();
          });
      </script>
</div>
<div id="sq_login_success" style="display: none;">
    <div class="sq_header"><?php _e('Congratulation! Write a new post with:', _PLUGIN_NAME_); ?></div>
    <img src="<?php echo _SQ_STATIC_API_URL_?>default/img/squirrly_wordpress.png" />
    <ul>
        <li><?php _e('<strong>Keyword Research</strong>: find the perfect keywords for your articles.', _PLUGIN_NAME_); ?></li>
        <li><?php _e('<strong>Inspiration box</strong>: pulls images, tweets, wikis and blogs, so that you can inspire yourself very fast on what to write in your article.', _PLUGIN_NAME_); ?></li>
        <li><?php _e('<strong>SEO Live Assistant</strong>: Checks your SEO in real time. Before you click the Post button, you know if your article is perfectly optimized or not.', _PLUGIN_NAME_); ?></li>
        <li><?php _e('<strong>Article Rank</strong>: A great tool to track your progress on each article. You get Traffic, Social, Inbound-Links and Search engines Rank information instantly.', _PLUGIN_NAME_); ?></li>
    </ul>

</div>