<div id="abh_settings" >
    <form id="abh_settings_form" name="settings" action="" method="post" enctype="multipart/form-data">
        <div id="abh_settings_title" ><?php _e('StartBox Settings', _ABH_PLUGIN_NAME_); ?><a href="http://wordpress.org/support/view/plugin-reviews/starbox" target="_blank"><span class="abh_settings_rate" ><span></span><?php _e('Please support us on Wordpress', _ABH_PLUGIN_NAME_); ?></span></a></div>
        <div id="abh_settings_body">
            <div id="abh_settings_left" >
                <fieldset>
                    <div class="abh_option_content">
                        <div class="abh_switch">
                            <input id="abh_inposts_on" type="radio" class="abh_switch-input" name="abh_inposts"  value="1" <?php echo ((ABH_Classes_Tools::getOption('abh_inposts') == 1) ? "checked" : '') ?> />
                            <label for="abh_inposts_on" class="abh_switch-label abh_switch-label-off"><?php _e('Yes', _ABH_PLUGIN_NAME_); ?></label>
                            <input id="abh_inposts_off" type="radio" class="abh_switch-input" name="abh_inposts" value="0" <?php echo ((!ABH_Classes_Tools::getOption('abh_inposts')) ? "checked" : '') ?> />
                            <label for="abh_inposts_off" class="abh_switch-label abh_switch-label-on"><?php _e('No', _ABH_PLUGIN_NAME_); ?></label>
                            <span class="abh_switch-selection"></span>
                        </div>
                        <span><?php _e('Visible in posts', _ABH_PLUGIN_NAME_); ?></span>
                    </div>

                    <div class="abh_option_content">
                        <div class="abh_switch">
                            <input id="abh_inpages_on" type="radio" class="abh_switch-input" name="abh_inpages"  value="1" <?php echo ((ABH_Classes_Tools::getOption('abh_inpages') == 1) ? "checked" : '') ?> />
                            <label for="abh_inpages_on" class="abh_switch-label abh_switch-label-off"><?php _e('Yes', _ABH_PLUGIN_NAME_); ?></label>
                            <input id="abh_inpages_off" type="radio" class="abh_switch-input" name="abh_inpages" value="0" <?php echo ((!ABH_Classes_Tools::getOption('abh_inpages')) ? "checked" : '') ?> />
                            <label for="abh_inpages_off" class="abh_switch-label abh_switch-label-on"><?php _e('No', _ABH_PLUGIN_NAME_); ?></label>
                            <span class="abh_switch-selection"></span>
                        </div>
                        <span><?php _e('Visible in pages', _ABH_PLUGIN_NAME_); ?></span>
                    </div>

                    <div class="abh_option_content">
                        <div class="abh_switch">
                            <input id="abh_ineachpost_on" type="radio" class="abh_switch-input" name="abh_ineachpost"  value="1" <?php echo ((ABH_Classes_Tools::getOption('abh_ineachpost') == 1) ? "checked" : '') ?> />
                            <label for="abh_ineachpost_on" class="abh_switch-label abh_switch-label-off"><?php _e('Yes', _ABH_PLUGIN_NAME_); ?></label>
                            <input id="abh_ineachpost_off" type="radio" class="abh_switch-input" name="abh_ineachpost" value="0" <?php echo ((!ABH_Classes_Tools::getOption('abh_ineachpost')) ? "checked" : '') ?> />
                            <label for="abh_ineachpost_off" class="abh_switch-label abh_switch-label-on"><?php _e('No', _ABH_PLUGIN_NAME_); ?></label>
                            <span class="abh_switch-selection"></span>
                        </div>
                        <span><?php _e('Show the Starbox with Top Star theme in the global feed of your blog (eg. "/blog" page) under each title of every post', _ABH_PLUGIN_NAME_); ?></span>
                    </div>
                </fieldset>
                <fieldset>
                    <legend><?php _e('Theme setting:', _ABH_PLUGIN_NAME_); ?></legend>
                    <div class="abh_option_content">

                        <div class="abh_select">
                            <select name="abh_theme">
                                <?php
                                foreach (ABH_Classes_Tools::getOption('abh_themes') as $name) {
                                    echo '<option value="' . $name . '" ' . ((ABH_Classes_Tools::getOption('abh_theme') == $name) ? 'selected="selected"' : '') . ' >' . ucfirst($name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <span><?php _e('Choose the default theme to be displayed inside each blog article', _ABH_PLUGIN_NAME_); ?></span>
                    </div>

                    <div class="abh_option_content">
                        <div class="abh_select">
                            <select name="abh_achposttheme">
                                <?php
                                foreach (ABH_Classes_Tools::getOption('abh_achpostthemes') as $name) {
                                    echo '<option value="' . $name . '" ' . ((ABH_Classes_Tools::getOption('abh_achposttheme') == $name) ? 'selected="selected"' : '') . ' >' . ucfirst($name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <span><?php _e('Choose the theme to be displayed in your global list of posts (eg. /blog)', _ABH_PLUGIN_NAME_); ?></span>
                    </div>

                    <div class="abh_option_content">

                        <div class="abh_select">
                            <select name="abh_position">
                                <option value="up" <?php echo ((ABH_Classes_Tools::getOption('abh_position') == 'up') ? 'selected="selected"' : '') ?>>Up</option>
                                <option value="down" <?php echo ((ABH_Classes_Tools::getOption('abh_position') == 'down') ? 'selected="selected"' : '') ?>>Down</option>
                            </select>
                        </div>
                        <span><?php _e('The Author Box position', _ABH_PLUGIN_NAME_); ?></span>
                    </div>
                    <div><br /><br /><?php echo sprintf(__('Use the Google Tool to check rich snippets %sclick here%s', _ABH_PLUGIN_NAME_), '<a href="http://www.google.com/webmasters/tools/richsnippets?url=' . get_bloginfo('url') . '" target="_blank">', '</a>'); ?></div>

                </fieldset>

            </div>

            <div id="abh_settings_submit">
                <p><?php _e('Click "go to user settings" to setup the author box for each author you have ( including per author Google Authorship)', _ABH_PLUGIN_NAME_); ?></p>
                <input type="hidden" name="action" value="abh_settings_update" />
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(_ABH_NONCE_ID_); ?>" />
                <input type="submit" name="abh_update" class="abh_button" value="<?php _e('Save settings', _ABH_PLUGIN_NAME_) ?> &raquo;" />
                <a href="profile.php#abh_settings" class="abh_button"><?php _e('Go to user settings', _ABH_PLUGIN_NAME_) ?></a>
            </div>
        </div>
    </form>
</div>