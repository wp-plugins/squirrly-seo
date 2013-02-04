<div id="sq_settings" >
    <form name="settings" action="" method="post" enctype="multipart/form-data">
    <?php if(!isset($view->options['sq_api']) || !isset($view->options['sq_howto'])) {?>
    <div id="sq_settings_howto">
        <div id="sq_settings_howto_title" ><?php _e('With Squirrly SEO, your Wordpress will get Perfect SEO on each article you write.', _PLUGIN_NAME_); ?></div>
        <div id="sq_settings_howto_body">
            <p><span><?php _e('SEO Software', _PLUGIN_NAME_); ?></span><?php _e('delivered as a plugin for Wordpress. <br /><br />We connect your wordpress with Squirrly, so that we can find the best SEO opportunities, give you reports and analyse your competitors.', _PLUGIN_NAME_); ?></p>
            <p><object width="420" height="315"><param name="movie" value="http://www.youtube.com/v/ymh8DBKrfhw?version=3&amp;hl=ro_RO"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/ymh8DBKrfhw?version=3&amp;hl=ro_RO" type="application/x-shockwave-flash" width="420" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object></p> 
            <a id="sq_settings_button" href="post-new.php"><?php echo  __( 'Write a new post with Squirrly', _PLUGIN_NAME_); ?></a> 
            <div id="sq_settings_howto_close" class="sq_close" >x</div>
        </div>
    </div>
    <?php }?>
    <?php if(isset($view->options['sq_api'])) {?>
        <div id="sq_userinfo"></div>
        <script type="text/javascript">
           jQuery(document).ready(function() {  
                sq_getUserInfo('<?php echo _SQ_API_URL_ ?>', '<?php echo SQ_Tools::$options['sq_api']?>');
           });
        </script>
    <?php }?>
        
    <div id="sq_settings_title" ><?php _e('Squirrly settings', _PLUGIN_NAME_); ?> <input type="submit" name="sq_update" value="<?php _e('Save settings', _PLUGIN_NAME_)?> &raquo;" /> </div>
    <div id="sq_settings_body">
      
      
         <div id="sq_settings_left" >  
         <fieldset style="display: none">
            <legend><?php _e(ucfirst(_PLUGIN_NAME_) . ' API', _PLUGIN_NAME_); ?></legend>
            <div>
             <p>
              <?php _e('API Key:', _PLUGIN_NAME_); ?><input type="text" name="sq_api" value="<?php echo ((isset($view->options['sq_api']) && $view->options['sq_api']) ? $view->options['sq_api'] : '')?>" size="60" /> 
             </p>
            </div>
        </fieldset>
          
        <fieldset>
            <legend><?php _e('Let Squirrly automatically optimize my blog', _PLUGIN_NAME_); ?></legend>
            <div>
             <p>
              <input type="radio" name="sq_use" id="sq_use_on"  value="1" <?php echo ((isset($view->options['sq_use']) && $view->options['sq_use'] == 1) ? "checked" : '')?> /> <?php _e('Yes', _PLUGIN_NAME_); ?>
              <input type="radio" name="sq_use" value="0" <?php echo ((!isset($view->options['sq_use']) ||  !$view->options['sq_use']) ? "checked" : '')?> /> <?php _e('No', _PLUGIN_NAME_); ?>
             </p>
             <p>     
                  <ul class="sq_settings_info">
                      <span ><?php _e('What does Squirrly automatically do for SEO?', _PLUGIN_NAME_); ?></span>
                      <li><?php _e('adds the correct <strong>title</strong> in the home page', _PLUGIN_NAME_); ?></li>
                      <li><?php _e('adds the correct <strong>description</strong> and <strong>keywords</strong> in all pages', _PLUGIN_NAME_); ?></li>
                      <li><?php _e('adds <strong>canonical</strong> link in home page', _PLUGIN_NAME_); ?></li>
                      <li><?php _e('adds the <strong>XML Sitemap</strong> for search engines', _PLUGIN_NAME_); ?>: <strong><?php echo get_bloginfo('siteurl') . '/sitemap.xml' ?></strong></li>
                      <li><?php _e('adds the required METAs for home page (<strong>icon, author, language, dc publisher</strong>, etc.)', _PLUGIN_NAME_); ?></li>
                      <li><?php _e('adds the <strong>favicon</strong> and the <strong>icon for Apple devices</strong>.', _PLUGIN_NAME_); ?></li>
                  </ul>
              
             </p>
            </div>
        </fieldset>  
             
        <fieldset>
            <legend><?php _e('Let Squirrly warn me if there are errors related to SEO settings', _PLUGIN_NAME_); ?></legend>
            <div>
             <p>
              <input type="radio" name="ignore_warn" value="0" <?php echo ((!isset($view->options['ignore_warn']) ||  !$view->options['ignore_warn']) ? "checked" : '')?> /> <?php _e('Yes', _PLUGIN_NAME_); ?>
              <input type="radio" name="ignore_warn" id="sq_ignore_warn"  value="1" <?php echo ((isset($view->options['ignore_warn']) && $view->options['ignore_warn'] == 1) ? "checked" : '')?> /> <?php _e('No', _PLUGIN_NAME_); ?>
             </p>
            </div>
       </fieldset> 
             
       <fieldset>
            <legend><?php _e('Squirrly Options', _PLUGIN_NAME_); ?></legend>
            <div>
             <p>
               <?php _e('Show <strong>"Enter a keyword"</strong> bubble when posting a new article.', _PLUGIN_NAME_); ?>
             </p>
             <p>
              <input type="radio" name="sq_keyword_help" value="1" <?php echo ((!isset($view->options['sq_keyword_help']) ||  $view->options['sq_keyword_help'] == 1) ? "checked" : '')?> /> <?php _e('Yes', _PLUGIN_NAME_); ?>
              <input type="radio" name="sq_keyword_help"  value="0" <?php echo ((isset($view->options['sq_keyword_help']) && $view->options['sq_keyword_help'] == 0) ? "checked" : '')?> /> <?php _e('No', _PLUGIN_NAME_); ?>
             </p>
            </div>
            <div>
             <p>
               <?php _e('Always show <strong>Keyword Informations</strong> about the selected keyword.', _PLUGIN_NAME_); ?>
             </p>
             <p>
              <input type="radio" name="sq_keyword_information" value="1" <?php echo ((isset($view->options['sq_keyword_information']) && $view->options['sq_keyword_information'] == 1) ? "checked" : '')?> /> <?php _e('Yes', _PLUGIN_NAME_); ?>
              <input type="radio" name="sq_keyword_information"  value="0" <?php echo ((!isset($view->options['sq_keyword_information']) || $view->options['sq_keyword_information'] == 0) ? "checked" : '')?> /> <?php _e('No', _PLUGIN_NAME_); ?>
             </p>
            </div>
       </fieldset> 
                  
        <fieldset>
            <legend><?php _e('First page optimization (Title, Description, Keywords)', _PLUGIN_NAME_); ?></legend>
            <p class="automaticaly" <?php echo ((isset($view->options['sq_fp_title']) && $view->options['sq_fp_title'] <> '') ? 'style="display: none;"' : '')?>><?php _e('Status:', _PLUGIN_NAME_); ?> <span style="color:green; font-weight: bold;"><?php _e('automatically', _PLUGIN_NAME_); ?></span> </p>
            <p class="customize" <?php echo ((isset($view->options['sq_fp_title']) && $view->options['sq_fp_title'] <> '') ? 'style="display: none;"' : '')?>><?php _e('Change it >>', _PLUGIN_NAME_); ?></p>
            <div <?php echo ((isset($view->options['sq_fp_title']) && $view->options['sq_fp_title'] <> '') ? '' : 'style="display: none;"')?>>
             <p class="withborder">
              <?php _e('Title:', _PLUGIN_NAME_); ?><input type="text" name="sq_fp_title" value="<?php echo ((isset($view->options['sq_fp_title']) && $view->options['sq_fp_title'] <> '') ? $view->options['sq_fp_title'] : '')?>" size="75" /> 
              <span class="sq_settings_info"><?php _e('Tips: Length 10-70 chars', _PLUGIN_NAME_); ?></span>
             </p>
             <p class="withborder">
              <?php _e('Description:', _PLUGIN_NAME_); ?><textarea name="sq_fp_description" cols="70" rows="3" ><?php echo ((isset($view->options['sq_fp_description']) && $view->options['sq_fp_description'] <> '') ? $view->options['sq_fp_description'] : '')?></textarea>
              <span class="sq_settings_info"><?php _e('Tips: Length 70-255 chars', _PLUGIN_NAME_); ?></span>
             </p>
             <p class="withborder">
              <?php _e('Keywords:', _PLUGIN_NAME_); ?><input type="text" name="sq_fp_keywords" value="<?php echo ((isset($view->options['sq_fp_keywords']) && $view->options['sq_fp_keywords'] <> '') ? $view->options['sq_fp_keywords'] : '')?>" size="70" /> 
              <span class="sq_settings_info"><?php _e('Tips: 2-4 keywords', _PLUGIN_NAME_); ?></span>
             </p>
            </div>
            <?php if(!isset($view->options['sq_fp_title']) || $view->options['sq_fp_title'] == '') {?>
            <p class="_customize" style="display: none;"><?php _e('<< Leave it automatically', _PLUGIN_NAME_); ?></p>
            <?php }?>
        </fieldset>
        
        

        </div>
          
        <div id="sq_settings_right">
           
            
           <fieldset>
            <legend><?php _e('Change the Website Icon', _PLUGIN_NAME_); ?></legend>
            <div>
		<p>
                    <?php _e('File types: JPG, JPEG, GIF and PNG.', _PLUGIN_NAME_); ?>
                </p>
		<p>
                    <?php _e('Upload file:', _PLUGIN_NAME_); ?><br />
                    <?php if(file_exists(ABSPATH.'/favicon.ico')){ ?>
                    <img src="<?php echo get_bloginfo('siteurl') . '/favicon.ico' . '?' . time() ?>"  style="float: left; margin-top: 5px; width: 20px; height: 20px;" />
                    <?php }?>
                    <input type="file" name="favicon" id="favicon" style="float: left;" />
                    <input type="submit" name="sq_update" value="<?php _e('Upload', _PLUGIN_NAME_)?>" style="float: left; margin-top: 0;" /> 
                    <span class="sq_settings_info"><?php echo ((defined('SQ_MESSAGE_FAVICON')) ? SQ_MESSAGE_FAVICON : '')?></span>
               </p>	
            </div>
            <span class="sq_settings_info"><?php _e('If you don\'t see the new icon in your browser, empty the browser cache and refresh the page.', _PLUGIN_NAME_); ?></span>
          </fieldset>
            
          <fieldset>
            <legend><?php _e('Tool for Search Engines', _PLUGIN_NAME_); ?></legend>
            <div>
             <p class="withborder withcode">
              <span class="sq_icon sq_icon_googleplus"></span>
              <?php _e('Google Plus URL:', _PLUGIN_NAME_); ?><br /><strong><input type="text" name="sq_google_plus" value="<?php echo ((isset($view->options['sq_google_plus']) && $view->options['sq_google_plus'] <> '') ? $view->options['sq_google_plus'] : '')?>" size="60" /> (e.g. https://plus.google.com/00000000000000/posts)</strong>
             </p>
             <p class="withborder withcode">
              <span class="sq_icon sq_icon_googlewt"></span>
              <?php echo sprintf(__('Google META verification code for %sWebmaster Tool%s`:', _PLUGIN_NAME_), '`<a href="http://maps.google.com/webmasters/" target="_blank">','</a>'); ?><br><strong>&lt;meta name="google-site-verification" content=" <input type="text" name="sq_google_wt" value="<?php echo ((isset($view->options['sq_google_wt']) && $view->options['sq_google_wt'] <> '') ? $view->options['sq_google_wt'] : '')?>" size="15" /> " /&gt;</strong>
             </p>
             <p class="withborder withcode">
              <span class="sq_icon sq_icon_googleanalytics"></span>
              <?php echo sprintf(__('Google  %sAnalytics ID%s`:', _PLUGIN_NAME_), '`<a href="http://maps.google.com/analytics/" target="_blank">','</a>'); ?><br><strong><input type="text" name="sq_google_analytics" value="<?php echo ((isset($view->options['sq_google_analytics']) && $view->options['sq_google_analytics'] <> '') ? $view->options['sq_google_analytics'] : '')?>" size="15" /> (e.g. UA-XXXXXXX-XX)</strong>
             </p>
             <p class="withborder withcode">
              <span class="sq_icon sq_icon_facebookinsights"></span>
              <?php echo sprintf(__('Facebook META code (for %sInsights%s )`:', _PLUGIN_NAME_), '`<a href="http://www.facebook.com/insights/" target="_blank">','</a>'); ?><br><strong>&lt;meta property="fb:admins" content=" <input type="text" name="sq_facebook_insights" value="<?php echo ((isset($view->options['sq_facebook_insights']) && $view->options['sq_facebook_insights'] <> '') ? $view->options['sq_facebook_insights'] : '')?>" size="15" /> " /&gt;</strong>
             </p>
             <p class="withcode">
              <span class="sq_icon sq_icon_bingwt"></span>
              <?php echo sprintf(__('Bing META code (for %sWebmaster Tool%s )`:', _PLUGIN_NAME_), '`<a href="http://www.bing.com/toolbox/webmaster/" target="_blank">','</a>'); ?><br><strong>&lt;meta name="msvalidate.01" content=" <input type="text" name="sq_bing_wt" value="<?php echo ((isset($view->options['sq_bing_wt']) && $view->options['sq_bing_wt'] <> '') ? $view->options['sq_bing_wt'] : '')?>" size="15" /> " /&gt;</strong>
             </p>
            </div>
        </fieldset>            
       </div>
          
       <div id="sq_settings_submit">   
        <input type="hidden" name="action" value="sq_update" /> 
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(_SQ_NONCE_ID_); ?>" />
        <input type="submit" name="sq_update" value="<?php _e('Save settings', _PLUGIN_NAME_)?> &raquo;" /> 
      </div>
     

    </div>
    </form>
    
</div>