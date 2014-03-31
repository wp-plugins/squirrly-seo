<div id="sq_settings" >
    <form id="sq_settings_form" name="settings" action="" method="post" enctype="multipart/form-data">
        <span class="sq_icon"></span>
        <div id="sq_settings_title" ><?php _e('Squirrly settings', _SQ_PLUGIN_NAME_); ?> </div>
        <div id="sq_settings_title" >
            <input type="submit" name="sq_update" value="<?php _e('Save settings', _SQ_PLUGIN_NAME_) ?> &raquo;" />
            <input id="sq_goto_dashboard" type="button" value="<?php _e('Go to dashboard', _SQ_PLUGIN_NAME_) ?> &raquo;" />
        </div>
        <div id="sq_settings_body">
            <fieldset>
                <legend>
                    <span class="sq_legend_title"><?php _e('Let Squirrly automatically optimize my blog', _SQ_PLUGIN_NAME_); ?></span>
                    <span class="sq_option_disclamer"><?php _e('<strong>For SEO Setting you can use "All In One SEO", "Wordpress SEO by Yoast", or other such plugins.</strong>', _SQ_PLUGIN_NAME_); ?></span>

                    <span><?php _e('If you want, you can also use the built-in settings from Squirrly (useful for beginners), by switching Yes below.', _SQ_PLUGIN_NAME_); ?></span>
                    <div class="sq_option_content">
                        <div class="sq_switch">
                            <input id="sq_use_on" type="radio" class="sq_switch-input" name="sq_use"  value="1" <?php echo (($view->options['sq_use'] == 1) ? "checked" : '') ?> />
                            <label for="sq_use_on" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_use_off" type="radio" class="sq_switch-input" name="sq_use" value="0" <?php echo ((!$view->options['sq_use']) ? "checked" : '') ?> />
                            <label for="sq_use_off" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                    </div>
                </legend>
                <div>
                    <ul id="sq_settings_sq_use" class="sq_settings_info">
                        <span><?php _e('What does Squirrly automatically do for SEO?', _SQ_PLUGIN_NAME_); ?></span>
                        <li>
                            <?php
                            $auto_option = false;
                            if ($view->options['sq_auto_canonical'] == 1)
                                $auto_option = true;
                            ?>
                            <div class="sq_option_content sq_option_content_small">
                                <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                                    <input id="sq_auto_canonical1" type="radio" class="sq_switch-input" name="sq_auto_canonical"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_canonical1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                                    <input id="sq_auto_canonical0" type="radio" class="sq_switch-input" name="sq_auto_canonical" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_canonical0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                                    <span class="sq_switch-selection"></span>
                                </div>
                                <span><?php echo sprintf(__('Add <strong>%scanonical link%s</strong> in pages', _SQ_PLUGIN_NAME_), '<a href="https://support.google.com/webmasters/answer/139066?hl=en" target="_blank">', '</a>'); ?></span>
                            </div>
                        </li>
                        <li>
                            <?php
                            $auto_option = false;
                            if ($view->options['sq_auto_sitemap'] == 1)
                                $auto_option = true;
                            ?>
                            <div class="sq_option_content sq_option_content_small">
                                <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                                    <input id="sq_auto_sitemap1" type="radio" class="sq_switch-input" name="sq_auto_sitemap"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_sitemap1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                                    <input id="sq_auto_sitemap0" type="radio" class="sq_switch-input" name="sq_auto_sitemap" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_sitemap0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                                    <span class="sq_switch-selection"></span>
                                </div>
                                <span><?php echo sprintf(__('Add the <strong>%sXML Sitemap%s</strong> for search engines', _SQ_PLUGIN_NAME_), '<a href="https://support.google.com/webmasters/answer/156184?rd=1" target="_blank">', '</a>'); ?>: <strong><?php echo '/sitemap.xml' ?></strong></span>
                            </div>
                        </li>
                        <li>
                            <?php
                            $auto_option = false;
                            if ($view->options['sq_auto_meta'] == 1)
                                $auto_option = true;
                            ?>
                            <div class="sq_option_content sq_option_content_small">
                                <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                                    <input id="sq_auto_meta1" type="radio" class="sq_switch-input" name="sq_auto_meta"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_meta1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                                    <input id="sq_auto_meta0" type="radio" class="sq_switch-input" name="sq_auto_meta" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_meta0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                                    <span class="sq_switch-selection"></span>
                                </div>
                                <span><?php _e('Add the required METAs for home page (<strong>icon, author, language, dc publisher</strong>, etc.)', _SQ_PLUGIN_NAME_); ?></span>
                            </div>
                        </li>
                        <li>
                            <?php
                            $auto_option = false;
                            if ($view->options['sq_auto_favicon'] == 1)
                                $auto_option = true;
                            ?>
                            <div class="sq_option_content sq_option_content_small">
                                <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                                    <input id="sq_auto_favicon1" type="radio" class="sq_switch-input" name="sq_auto_favicon"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_favicon1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                                    <input id="sq_auto_favicon0" type="radio" class="sq_switch-input" name="sq_auto_favicon" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_favicon0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                                    <span class="sq_switch-selection"></span>
                                </div>
                                <span><?php _e('Add the <strong>favicon</strong> and the <strong>icon for Apple devices</strong>.', _SQ_PLUGIN_NAME_); ?></span>
                            </div>
                        </li>


                    </ul>
                </div>
            </fieldset>
            <fieldset id="sq_social_media" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                <legend>
                    <span class="sq_legend_title"><?php _e('Social Media Options', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php echo sprintf(__('%sHow to pop out in Social Media with your links%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/how-to-pop-out-in-social-media-with-your-links." target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sGet busy with Facebook’s new Search Engine functions%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/get-busy-with-facebooks-new-search-engine-functions" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sHow I Added Twitter Cards in My WordPress for Better Inbound Marketing%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/inbound_marketing_twitter_cards-pagblog-article_id62232.html" target="_blank">', '</a>'); ?></span>
                </legend>

                <div>
                    <ul id="sq_settings_sq_use" class="sq_settings_info">
                        <span><?php _e('What does Squirrly automatically do for Social Media?', _SQ_PLUGIN_NAME_); ?></span>
                        <li>
                            <?php
                            $auto_option = false;
                            if ($view->options['sq_auto_facebook'] == 1)
                                $auto_option = true;
                            ?>
                            <div class="sq_option_content sq_option_content_small">
                                <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                                    <input id="sq_auto_facebook1" type="radio" class="sq_switch-input" name="sq_auto_facebook"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_facebook1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                                    <input id="sq_auto_facebook0" type="radio" class="sq_switch-input" name="sq_auto_facebook" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_facebook0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                                    <span class="sq_switch-selection"></span>
                                </div>
                                <span><?php echo __('Add the <strong>Social Open Graph objects</strong> for a good looking share. ', _SQ_PLUGIN_NAME_) . ' <a href="https://developers.facebook.com/tools/debug/og/object?q=' . urlencode(get_bloginfo('wpurl')) . '" target="_blank" title="Facebook Object Validator">Check here</a>'; ?></span>
                            </div>
                        </li>
                        <li>
                            <?php
                            $auto_option = false;
                            if ($view->options['sq_auto_twitter'] == 1)
                                $auto_option = true;
                            ?>
                            <div class="sq_option_content sq_option_content_small">
                                <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                                    <input id="sq_auto_twitter1" type="radio" class="sq_switch-input" name="sq_auto_twitter"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_twitter1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                                    <input id="sq_auto_twitter0" type="radio" class="sq_switch-input" name="sq_auto_twitter" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                                    <label for="sq_auto_twitter0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                                    <span class="sq_switch-selection"></span>
                                </div>
                                <span><?php echo __('Add the <strong>Twitter card</strong> in your tweets. ', _SQ_PLUGIN_NAME_) . ' <a href="https://dev.twitter.com/docs/cards/validation/validator" target="_blank" title="Twitter Card Validator">Check here</a> <em>(Select Summary > Validate URLs)</em>'; ?></span>
                            </div>
                            <div>
                                <span id="sq_twitter_account" style=" <?php echo (!$auto_option ? 'display:none;' : ''); ?>" ><?php _e('Your twitter account: ', _SQ_PLUGIN_NAME_); ?><input type="text" name="sq_twitter_account" value="<?php echo (($view->options['sq_twitter_account'] <> '') ? $view->options['sq_twitter_account'] : '') ?>" size="30" style="width:150px;" placeholder="@" /> </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </fieldset>
            <fieldset id="sq_title_description_keywords" <?php echo (($view->options['sq_use'] == 0) ? 'style="display:none;"' : ''); ?> <?php echo (($view->options['sq_fp_title'] == '' || $view->options['sq_auto_seo'] == 1) ? '' : 'class="sq_custom_title"'); ?>>
                <legend>
                    <span class="sq_legend_title"><?php _e('First page optimization', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php echo sprintf(__('%sThe best SEO approach to Meta information%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/the-best-seo-approach-to-meta-information" target="_blank">', '</a>'); ?></span>

                    <span><?php _e('Add the correct <strong>title</strong> in the home page', _SQ_PLUGIN_NAME_); ?></span>
                    <?php
                    $auto_option = false;
                    if ($view->options['sq_auto_title'] == 1)
                        $auto_option = true;
                    ?>
                    <div class="sq_option_content sq_option_content">
                        <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                            <input id="sq_auto_title1" type="radio" class="sq_switch-input" name="sq_auto_title"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                            <label for="sq_auto_title1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_auto_title0" type="radio" class="sq_switch-input" name="sq_auto_title" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                            <label for="sq_auto_title0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                    </div>

                    <span><?php _e('Add the correct <strong>description</strong> and <strong>keywords</strong> in home page', _SQ_PLUGIN_NAME_); ?></span>
                    <?php
                    $auto_option = false;
                    if ($view->options['sq_auto_description'] == 1)
                        $auto_option = true;
                    ?>
                    <div class="sq_option_content sq_option_content">
                        <div class="sq_switch sq_seo_switch_condition" style="<?php echo (($view->options['sq_use'] == 0) ? 'display:none;' : ''); ?>">
                            <input id="sq_auto_description1" type="radio" class="sq_switch-input" name="sq_auto_description"  value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                            <label for="sq_auto_description1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_auto_description0" type="radio" class="sq_switch-input" name="sq_auto_description" value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                            <label for="sq_auto_description0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>

                    </div>

                </legend>

                <div>
                    <?php
                    $auto_option = false;
                    if ($view->options['sq_fp_title'] == '' || $view->options['sq_auto_seo'] == 1)
                        $auto_option = true;
                    ?>
                    <div class="sq_option_content">
                        <div class="sq_switch">
                            <input id="sq_automatically" type="radio" class="sq_switch-input" name="sq_auto_seo" value="1" <?php echo ($auto_option ? "checked" : '') ?> />
                            <label for="sq_automatically" class="sq_switch-label sq_switch-label-off"><?php _e('Auto', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_customize" type="radio" class="sq_switch-input" name="sq_auto_seo"  value="0" <?php echo (!$auto_option ? "checked" : '') ?> />
                            <label for="sq_customize" class="sq_switch-label sq_switch-label-on"><?php _e('Custom', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                        <span class="sq_option_info_small"><?php _e('Home page SEO optimization', _SQ_PLUGIN_NAME_); ?></span>
                    </div>

                    <div id="sq_customize_settings" <?php echo (!$auto_option ? '' : 'style="display: none;"') ?>>
                        <p class="withborder">
                            <?php _e('Title:', _SQ_PLUGIN_NAME_); ?><input type="text" name="sq_fp_title" value="<?php echo (($view->options['sq_fp_title'] <> '') ? $view->options['sq_fp_title'] : '') ?>" size="75" /><span id="sq_title_info" />
                            <span id="sq_fp_title_length"></span><span class="sq_settings_info"><?php _e('Tips: Length 10-75 chars', _SQ_PLUGIN_NAME_); ?></span>
                        </p>
                        <p class="withborder">
                            <?php _e('Description:', _SQ_PLUGIN_NAME_); ?><textarea name="sq_fp_description" cols="70" rows="3" ><?php echo (($view->options['sq_fp_description'] <> '') ? $view->options['sq_fp_description'] : '') ?></textarea><span id="sq_description_info" />
                            <span id="sq_fp_description_length"></span><span class="sq_settings_info"><?php _e('Tips: Length 70-165 chars', _SQ_PLUGIN_NAME_); ?></span>
                        </p>
                        <p class="withborder">
                            <?php _e('Keywords:', _SQ_PLUGIN_NAME_); ?><input type="text" name="sq_fp_keywords" value="<?php echo (($view->options['sq_fp_keywords'] <> '') ? $view->options['sq_fp_keywords'] : '') ?>" size="70" />
                            <span id="sq_fp_keywords_length"></span><span class="sq_settings_info"><?php _e('Tips: 2-4 keywords', _SQ_PLUGIN_NAME_); ?></span>
                        </p>
                    </div>

                    <span class="sq_option_info"><?php _e('You First Page Preview (Title, Description, Keywords)', _SQ_PLUGIN_NAME_); ?></span>
                    <div id="sq_snippet">
                        <div id="sq_snippet_name"><?php _e('Squirrly Snippet', _SQ_PLUGIN_NAME_) ?></div>

                        <ul id="sq_snippet_ul">
                            <li id="sq_snippet_title"></li>
                            <li id="sq_snippet_url"></li>
                            <li id="sq_snippet_description"></li>
                            <li id="sq_snippet_source"><a href="http://www.google.com/webmasters/tools/richsnippets?url=<?php echo urlencode(get_bloginfo('wpurl')) ?>" target="_blank"><?php _e('Check with google ...', _SQ_PLUGIN_NAME_) ?></a></li>
                        </ul>

                        <div id="sq_snippet_disclaimer" <?php echo (!$auto_option ? '' : 'style="display: none;"') ?>><?php _e('If you don\'t see any changes in custom optimization, check if another SEO plugin affects Squirrly SEO', _SQ_PLUGIN_NAME_) ?></div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <span class="sq_legend_title"><?php _e('Squirrly Options', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php echo sprintf(__('%sThe right premises in working with Squirrly, WordPress SEO plugin%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/the-right-premises-in-working-with-squirrly-wordpress-seo-plugin" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sGetting inspired with Squirrly WordPress SEO plugin%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/getting-inspired-with-squirrly-wordpress-seo-plugin" target="_blank">', '</a>'); ?></span>

                    <span><?php echo sprintf(__('%sThere is a New SEO Live Assistant from Squirrly%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/there-is-a-new-seo-live-assistant-from-squirrly" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sHow to create Human friendly content with the WordPress SEO plugin?%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/how-to-create-human-friendly-content-with-the-a-wordpress-seo-plugin" target="_blank">', '</a>'); ?></span>

                </legend>

                <div>
                    <div class="sq_option_content" >
                        <div class="sq_switch">
                            <input id="ignore_warn_yes" class="sq_switch-input" type="radio" name="ignore_warn" value="0" <?php echo (($view->options['ignore_warn'] == 0) ? "checked" : '') ?> />
                            <label for="ignore_warn_yes" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_ignore_warn" class="sq_switch-input" type="radio" name="ignore_warn" value="1" <?php echo (($view->options['ignore_warn'] == 1) ? "checked" : '') ?> />
                            <label for="sq_ignore_warn" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                        <span><?php _e('Let Squirrly warn me if there are errors related to SEO settings', _SQ_PLUGIN_NAME_); ?></span>
                    </div>

                    <div class="sq_option_content">
                        <div class="sq_switch">
                            <input id="sq_keyword_help1" type="radio" class="sq_switch-input" name="sq_keyword_help" value="1" <?php echo (($view->options['sq_keyword_help'] == 1) ? "checked" : '') ?> />
                            <label for="sq_keyword_help1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_keyword_help0" type="radio" class="sq_switch-input" name="sq_keyword_help"  value="0" <?php echo (($view->options['sq_keyword_help'] == 0) ? "checked" : '') ?> />
                            <label for="sq_keyword_help0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                        <span><?php _e('Show <strong>"Enter a keyword"</strong> bubble when posting a new article.', _SQ_PLUGIN_NAME_); ?></span>
                    </div>

                    <div class="sq_option_content">
                        <div class="sq_switch">
                            <input id="sq_keyword_information1" type="radio" class="sq_switch-input" name="sq_keyword_information" value="1" <?php echo (($view->options['sq_keyword_information'] == 1) ? "checked" : '') ?> />
                            <label for="sq_keyword_information1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_keyword_information0" type="radio" class="sq_switch-input" name="sq_keyword_information"  value="0" <?php echo (($view->options['sq_keyword_information'] == 0) ? "checked" : '') ?> />
                            <label for="sq_keyword_information0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                        <span><?php _e('Always show <strong>Keyword Informations</strong> about the selected keyword.', _SQ_PLUGIN_NAME_); ?></span>
                    </div>


                    <div class="sq_option_content">
                        <div class="sq_switch">
                            <input id="sq_sla1" type="radio" class="sq_switch-input" name="sq_sla" value="1" <?php echo (($view->options['sq_sla'] == 1) ? "checked" : '') ?> />
                            <label for="sq_sla1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_sla0" type="radio" class="sq_switch-input" name="sq_sla"  value="0" <?php echo (($view->options['sq_sla'] == 0) ? "checked" : '') ?> />
                            <label for="sq_sla0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                        <span><?php _e('Use <strong> the NEW version of the SEO Live Assistant</strong>.', _SQ_PLUGIN_NAME_); ?></span>
                    </div>
                </div>
            </fieldset>
            <a name="sq_favicon_anchor"></a>
            <fieldset id="sq_favicon" style="<?php echo (($view->options['sq_auto_favicon'] == 0) ? 'display:none;' : ''); ?>">
                <legend>
                    <span class="sq_legend_title"><?php _e('Change the Website Icon', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php _e('Now even the tablets and smartphone browsers also make use of your icons. This has led to an increasesd importance to having a good favicon.', _SQ_PLUGIN_NAME_); ?> </span>
                    <span><?php echo sprintf(__('You can use %shttp://convertico.com/%s to convert your photo to icon and upload it here after that.', _SQ_PLUGIN_NAME_), '<a href="http://convertico.com/" target="_blank">', '</a>'); ?></span>

                </legend>
                <div>
                    <p>
                        <?php _e('File types: JPG, JPEG, GIF and PNG.', _SQ_PLUGIN_NAME_); ?>
                    </p>
                    <?php echo ((defined('SQ_MESSAGE_FAVICON')) ? '<span class="sq_message sq_error" style="display: block; padding: 11px 0;">' . SQ_MESSAGE_FAVICON . '</span>' : '') ?>
                    <p>
                        <?php _e('Upload file:', _SQ_PLUGIN_NAME_); ?><br />
                        <?php if (file_exists(ABSPATH . '/favicon.ico')) { ?>
                            <img src="<?php echo get_bloginfo('url') . '/favicon.ico' . '?' . time() ?>"  style="float: left; margin-top: 5px; width: 20px; height: 20px;" />
                        <?php } ?>
                        <input type="file" name="favicon" id="favicon" style="float: left;" />
                        <input type="submit" name="sq_update" value="<?php _e('Upload', _SQ_PLUGIN_NAME_) ?>" style="float: left; margin-top: 0;" />

                    </p>

                    <span class="sq_settings_info"><?php _e('If you don\'t see the new icon in your browser, empty the browser cache and refresh the page.', _SQ_PLUGIN_NAME_); ?></span>
                </div>
            </fieldset>
            <fieldset >
                <legend>
                    <span class="sq_legend_title"><?php _e('Tracking Tools', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php echo sprintf(__('%sLink your Google+ profile to the content you create%s', _SQ_PLUGIN_NAME_), '<a href="https://plus.google.com/authorship" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sStarBox, the author box that’s pushing content marketing to the stars%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/starbox-the-author-box-thats-pushing-content-marketing-to-the-stars" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sHow to Get the Most Out of Google Analytics%s', _SQ_PLUGIN_NAME_), '<a href="http://mashable.com/2012/01/04/google-analytics-guide/" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sA Beginner’s Guide to Facebook Insights%s', _SQ_PLUGIN_NAME_), '<a href="http://mashable.com/2010/09/03/facebook-insights-guide/" target="_blank">', '</a>'); ?></span>

                </legend>
                <div>
                    <p class="withborder withcode">
                        <span class="sq_icon sq_icon_googleplus"></span>
                        <?php _e('Google Plus URL:', _SQ_PLUGIN_NAME_); ?><br /><strong><input type="text" name="sq_google_plus" value="<?php echo (($view->options['sq_google_plus'] <> '') ? $view->options['sq_google_plus'] : '') ?>" size="60" /> (e.g. https://plus.google.com/00000000000000/posts)</strong>
                    </p>
                    <p class="withborder withcode">
                        <span class="sq_icon sq_icon_googleanalytics"></span>
                        <?php echo sprintf(__('Google  %sAnalytics ID%s:', _SQ_PLUGIN_NAME_), '<a href="http://maps.google.com/analytics/" target="_blank">', '</a>'); ?><br><strong><input type="text" name="sq_google_analytics" value="<?php echo (($view->options['sq_google_analytics'] <> '') ? $view->options['sq_google_analytics'] : '') ?>" size="15" /> (e.g. UA-XXXXXXX-XX)</strong>
                    </p>
                    <p class="withborder withcode" >
                        <span class="sq_icon sq_icon_facebookinsights"></span>
                        <?php echo sprintf(__('Facebook META code (for %sInsights%s ):', _SQ_PLUGIN_NAME_), '<a href="http://www.facebook.com/insights/" target="_blank">', '</a>'); ?><br><strong>&lt;meta property="fb:admins" content=" <input type="text" name="sq_facebook_insights" value="<?php echo (($view->options['sq_facebook_insights'] <> '') ? $view->options['sq_facebook_insights'] : '') ?>" size="15" /> " /&gt;</strong>
                    </p>
                </div>
            </fieldset>
            <fieldset >
                <legend>
                    <span class="sq_legend_title"><?php _e('Search Engines Tools', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php echo sprintf(__('%sBest practices to help Google find, crawl, and index your site%s', _SQ_PLUGIN_NAME_), '<a href="https://support.google.com/webmasters/answer/35769?hl=en" target="_blank">', '</a>'); ?></span>
                    <span><?php echo sprintf(__('%sBing Webmaster Tools Help & How-To Center%s', _SQ_PLUGIN_NAME_), '<a href="http://www.bing.com/webmaster/help/help-center-661b2d18" target="_blank">', '</a>'); ?></span>

                </legend>
                <div>
                    <p class="withborder withcode">
                        <span class="sq_icon sq_icon_googlewt"></span>
                        <?php echo sprintf(__('Google META verification code for %sWebmaster Tool%s:', _SQ_PLUGIN_NAME_), '<a href="http://maps.google.com/webmasters/" target="_blank">', '</a>'); ?><br><strong>&lt;meta name="google-site-verification" content=" <input type="text" name="sq_google_wt" value="<?php echo (($view->options['sq_google_wt'] <> '') ? $view->options['sq_google_wt'] : '') ?>" size="15" /> " /&gt;</strong>
                    </p>
                    <p class="withborder withcode" >
                        <span class="sq_icon sq_icon_bingwt" ></span>
                        <?php echo sprintf(__('Bing META code (for %sWebmaster Tool%s ):', _SQ_PLUGIN_NAME_), '<a href="http://www.bing.com/toolbox/webmaster/" target="_blank">', '</a>'); ?><br><strong>&lt;meta name="msvalidate.01" content=" <input type="text" name="sq_bing_wt" value="<?php echo (($view->options['sq_bing_wt'] <> '') ? $view->options['sq_bing_wt'] : '') ?>" size="15" /> " /&gt;</strong>
                    </p>
                    <p class="withborder withcode" >
                        <span class="sq_icon sq_icon_alexat" ></span>
                        <?php echo sprintf(__('Alexa META code (for %sAlexa Tool%s ):', _SQ_PLUGIN_NAME_), '<a href="http://www.alexa.com/pro/subscription/signup?tsver=0&puid=200" target="_blank">', '</a>'); ?><br><strong>&lt;meta name="alexaVerifyID" content=" <input type="text" name="sq_alexa" value="<?php echo (($view->options['sq_alexa'] <> '') ? $view->options['sq_alexa'] : '') ?>" size="15" /> /&gt;</strong>
                    </p>
                </div>
            </fieldset>

            <div id="sq_settings_submit">
                <input type="hidden" name="action" value="sq_settings_update" />
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(_SQ_NONCE_ID_); ?>" />
                <input type="submit" name="sq_update" value="<?php _e('Save settings', _SQ_PLUGIN_NAME_) ?> &raquo;" />
            </div>
        </div>
    </form>
    <script type="text/javascript">
        var sq_blogurl = "<?php echo get_bloginfo('url') ?>";
        var __snippetshort = "<?php echo __('Too short', _SQ_PLUGIN_NAME_) ?>";
        var __snippetlong = "<?php echo __('Too long', _SQ_PLUGIN_NAME_) ?>";
    </script>
</div>