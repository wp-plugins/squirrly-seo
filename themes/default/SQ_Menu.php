<div id="sq_settings">
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
                                <span><?php echo sprintf(__('Add <strong>%scanonical link%s</strong>, <strong>%srel="prev" and rel="next"%s</strong> metas', _SQ_PLUGIN_NAME_), '<a href="https://support.google.com/webmasters/answer/139066" target="_blank">', '</a>', '<a href="https://support.google.com/webmasters/answer/1663744" target="_blank">', '</a>'); ?></span>
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
                                <span><?php echo sprintf(__('Add the <strong>%sXML Sitemap%s</strong> for search engines', _SQ_PLUGIN_NAME_), '<a href="https://support.google.com/webmasters/answer/156184?rd=1" target="_blank">', '</a>'); ?>: <strong>Or use <a href="https://wordpress.org/plugins/google-sitemap-generator/" target="_blank">Google XML Sitemaps Plugin</a></strong></span>
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
                <legend class="sq_legend_medium">
                    <span class="sq_legend_title"><?php _e('First page optimization', _SQ_PLUGIN_NAME_); ?></span>
                    <span><?php echo sprintf(__('%sThe best SEO approach to Meta information%s', _SQ_PLUGIN_NAME_), '<a href="http://www.squirrly.co/the-best-seo-approach-to-meta-information" target="_blank">', '</a>'); ?></span>

                    <span><?php _e('Add meta <strong>title</strong> in Home Page', _SQ_PLUGIN_NAME_); ?></span>
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

                    <span><?php _e('Add meta <strong>description</strong> and <strong>keywords</strong> in Home Page', _SQ_PLUGIN_NAME_); ?></span>
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
                    if ($view->options['sq_fp_title'] == '')
                        $auto_option = true;

                    if ($pageId = get_option('page_on_front')) {
                        if (SQ_ObjController::getModel('SQ_Frontend')->getAdvancedMeta($pageId, 'title') <> '') {
                            $view->options['sq_fp_title'] = SQ_ObjController::getModel('SQ_Frontend')->getAdvancedMeta($pageId, 'title');
                            $view->options['sq_fp_description'] = SQ_ObjController::getModel('SQ_Frontend')->getAdvancedMeta($pageId, 'description');
                            if (!$view->options['sq_fp_keywords'] = SQ_ObjController::getModel('SQ_Frontend')->getAdvancedMeta($pageId, 'keyword')) {
                                $json = SQ_ObjController::getModel('SQ_Post')->getKeyword($pageId);
                                if (isset($json) && isset($json->keyword) && $json->keyword <> '') {
                                    $view->options['sq_fp_keywords'] = $json->keyword;
                                }
                            }
                        }
                    }
                    ?>
                    <input id="sq_customize" type="hidden" name="sq_auto_seo"  value="0">

                    <div id="sq_customize_settings">
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

                        <div id="sq_snippet_disclaimer" ><?php _e('If you don\'t see any changes in custom optimization, check if another SEO plugin affects Squirrly SEO', _SQ_PLUGIN_NAME_) ?></div>
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

                    <div class="sq_option_content">
                        <div class="sq_switch">
                            <input id="sq_keywordtag1" type="radio" class="sq_switch-input" name="sq_keywordtag" value="1" <?php echo (($view->options['sq_keywordtag'] == 1) ? "checked" : '') ?> />
                            <label for="sq_keywordtag1" class="sq_switch-label sq_switch-label-off"><?php _e('Yes', _SQ_PLUGIN_NAME_); ?></label>
                            <input id="sq_keywordtag0" type="radio" class="sq_switch-input" name="sq_keywordtag"  value="0" <?php echo (($view->options['sq_keywordtag'] == 0) ? "checked" : '') ?> />
                            <label for="sq_keywordtag0" class="sq_switch-label sq_switch-label-on"><?php _e('No', _SQ_PLUGIN_NAME_); ?></label>
                            <span class="sq_switch-selection"></span>
                        </div>
                        <span><?php _e('Add the Post tags in meta keyword.', _SQ_PLUGIN_NAME_); ?></span>
                    </div>


                    <div class="sq_option_content">
                        <p class=" withbordertop">
                            <span><?php _e('Select the country for which Squirrly will check the google rank', _SQ_PLUGIN_NAME_); ?></span>
                        </p>
                        <div class="abh_select">
                            <select id="sq_google_country" name="sq_google_country">
                                <option value="com"><?php _e('Default', _SQ_PLUGIN_NAME_); ?> - Google.com (http://www.google.com/)</option>
                                <option value="as"><?php _e('American Samoa', _SQ_PLUGIN_NAME_); ?> (http://www.google.as/)</option>
                                <option value=".off.ai"><?php _e('Anguilla', _SQ_PLUGIN_NAME_); ?> (http://www.google.off.ai/)</option>
                                <option value="com.ag"><?php _e('Antigua and Barbuda', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.ag/)</option>
                                <option value="com.ar"><?php _e('Argentina', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.ar/)</option>
                                <option value="com.au"><?php _e('Australia', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.au/)</option>
                                <option value="at"><?php _e('Austria', _SQ_PLUGIN_NAME_); ?> (http://www.google.at/)</option>
                                <option value="az"><?php _e('Azerbaijan', 'seo-rank-reporter'); ?> (http://www.google.az/)</option>
                                <option value="be"><?php _e('Belgium', _SQ_PLUGIN_NAME_); ?> (http://www.google.be/)</option>
                                <option value="com.br"><?php _e('Brazil', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.br/)</option>
                                <option value="vg"><?php _e('British Virgin Islands', _SQ_PLUGIN_NAME_); ?> (http://www.google.vg/)</option>
                                <option value="bi"><?php _e('Burundi', _SQ_PLUGIN_NAME_); ?> (http://www.google.bi/)</option>
                                <option value="ca"><?php _e('Canada', _SQ_PLUGIN_NAME_); ?> (http://www.google.ca/)</option>
                                <option value="td"><?php _e('Chad', _SQ_PLUGIN_NAME_); ?> (http://www.google.td/)</option>
                                <option value="cl"><?php _e('Chile', _SQ_PLUGIN_NAME_); ?> (http://www.google.cl/)</option>
                                <option value="com.co"><?php _e('Colombia', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.co/)</option>
                                <option value="co.cr"><?php _e('Costa Rica', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.cr/)</option>
                                <option value="ci"><?php _e('Côte d\'Ivoire', _SQ_PLUGIN_NAME_); ?> (http://www.google.ci/)</option>
                                <option value="com.cu"><?php _e('Cuba', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.cu/)</option>
                                <option value="cz"><?php _e('Czech Republic', _SQ_PLUGIN_NAME_); ?> (http://www.google.cz/)</option>
                                <option value="cd"><?php _e('Dem. Rep. of the Congo', _SQ_PLUGIN_NAME_); ?> (http://www.google.cd/)</option>
                                <option value="dk"><?php _e('Denmark', _SQ_PLUGIN_NAME_); ?> (http://www.google.dk/)</option>
                                <option value="dj"><?php _e('Djibouti', _SQ_PLUGIN_NAME_); ?> (http://www.google.dj/)</option>
                                <option value="com.do"><?php _e('Dominican Republic', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.do/)</option>
                                <option value="com.ec"><?php _e('Ecuador', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.ec/)</option>
                                <option value="com.sv"><?php _e('El Salvador', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.sv/)</option>
                                <option value="fm"><?php _e('Federated States of Micronesia', _SQ_PLUGIN_NAME_); ?> (http://www.google.fm/)</option>
                                <option value="com.fj"><?php _e('Fiji', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.fj/)</option>
                                <option value="fi"><?php _e('Finland', _SQ_PLUGIN_NAME_); ?> (http://www.google.fi/)</option>
                                <option value="fr"><?php _e('France', _SQ_PLUGIN_NAME_); ?> (http://www.google.fr/)</option>
                                <option value="gm"><?php _e('The Gambia', _SQ_PLUGIN_NAME_); ?> (http://www.google.gm/)</option>
                                <option value="ge"><?php _e('Georgia', _SQ_PLUGIN_NAME_); ?> (http://www.google.ge/)</option>
                                <option value="de"><?php _e('Germany', _SQ_PLUGIN_NAME_); ?> (http://www.google.de/)</option>
                                <option value="com.gi"><?php _e('Gibraltar', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.gi/)</option>
                                <option value="com.gr"><?php _e('Greece', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.gr/)</option>
                                <option value="gl"><?php _e('Greenland', _SQ_PLUGIN_NAME_); ?> (http://www.google.gl/)</option>
                                <option value="gg"><?php _e('Guernsey', _SQ_PLUGIN_NAME_); ?> (http://www.google.gg/)</option>
                                <option value="hn"><?php _e('Honduras', _SQ_PLUGIN_NAME_); ?> (http://www.google.hn/)</option>
                                <option value="com.hk"><?php _e('Hong Kong', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.hk/)</option>
                                <option value="co.hu"><?php _e('Hungary', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.hu/)</option>
                                <option value="co.in"><?php _e('India', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.in/)</option>
                                <option value="ie"><?php _e('Ireland', _SQ_PLUGIN_NAME_); ?> (http://www.google.ie/)</option>
                                <option value="co.im"><?php _e('Isle of Man', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.im/)</option>
                                <option value="co.il"><?php _e('Israel', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.il/)</option>
                                <option value="it"><?php _e('Italy', _SQ_PLUGIN_NAME_); ?> (http://www.google.it/)</option>
                                <option value="com.jm"><?php _e('Jamaica', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.jm/)</option>
                                <option value="co.jp"><?php _e('Japan', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.jp/)</option>
                                <option value="co.je"><?php _e('Jersey', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.je/)</option>
                                <option value="kz"><?php _e('Kazakhstan', _SQ_PLUGIN_NAME_); ?> (http://www.google.kz/)</option>
                                <option value="co.kr"><?php _e('Korea', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.kr/)</option>
                                <option value="lv"><?php _e('Latvia', _SQ_PLUGIN_NAME_); ?> (http://www.google.lv/)</option>
                                <option value="co.ls"><?php _e('Lesotho', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.ls/)</option>
                                <option value="li"><?php _e('Liechtenstein', _SQ_PLUGIN_NAME_); ?> (http://www.google.li/)</option>
                                <option value="lt"><?php _e('Lithuania', _SQ_PLUGIN_NAME_); ?> (http://www.google.lt/)</option>
                                <option value="lu"><?php _e('Luxembourg', _SQ_PLUGIN_NAME_); ?> (http://www.google.lu/)</option>
                                <option value="mw"><?php _e('Malawi', _SQ_PLUGIN_NAME_); ?> (http://www.google.mw/)</option>
                                <option value="com.my"><?php _e('Malaysia', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.my/)</option>
                                <option value="com.mt"><?php _e('Malta', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.mt/)</option>
                                <option value="mu"><?php _e('Mauritius', _SQ_PLUGIN_NAME_); ?> (http://www.google.mu/)</option>
                                <option value="com.mx"><?php _e('México', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.mx/)</option>
                                <option value="ms"><?php _e('Montserrat', _SQ_PLUGIN_NAME_); ?> (http://www.google.ms/)</option>
                                <option value="com.na"><?php _e('Namibia', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.na/)</option>
                                <option value="com.np"><?php _e('Nepal', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.np/)</option>
                                <option value="nl"><?php _e('Netherlands', _SQ_PLUGIN_NAME_); ?> (http://www.google.nl/)</option>
                                <option value="co.nz"><?php _e('New Zealand', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.nz/)</option>
                                <option value="com.ni"><?php _e('Nicaragua', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.ni/)</option>
                                <option value="com.nf"><?php _e('Norfolk Island', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.nf/)</option>
                                <option value="com.pk"><?php _e('Pakistan', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.pk/)</option>
                                <option value="com.pa"><?php _e('Panamá', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.pa/)</option>
                                <option value="com.py"><?php _e('Paraguay', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.py/)</option>
                                <option value="com.pe"><?php _e('Perú', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.pe/)</option>
                                <option value="com.ph"><?php _e('Philippines', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.ph/)</option>
                                <option value="pn"><?php _e('Pitcairn Islands', _SQ_PLUGIN_NAME_); ?> (http://www.google.pn/)</option>
                                <option value="pl"><?php _e('Poland', _SQ_PLUGIN_NAME_); ?> (http://www.google.pl/)</option>
                                <option value="pt"><?php _e('Portugal', _SQ_PLUGIN_NAME_); ?> (http://www.google.pt/)</option>
                                <option value="com.pr"><?php _e('Puerto Rico', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.pr/)</option>
                                <option value="cg"><?php _e('Rep. of the Congo', _SQ_PLUGIN_NAME_); ?> (http://www.google.cg/)</option>
                                <option value="ro"><?php _e('Romania', _SQ_PLUGIN_NAME_); ?> (http://www.google.ro/)</option>
                                <option value="ru"><?php _e('Russia', _SQ_PLUGIN_NAME_); ?> (http://www.google.ru/)</option>
                                <option value="rw"><?php _e('Rwanda', _SQ_PLUGIN_NAME_); ?> (http://www.google.rw/)</option>
                                <option value="sh"><?php _e('Saint Helena', _SQ_PLUGIN_NAME_); ?> (http://www.google.sh/)</option>
                                <option value="sm"><?php _e('San Marino', _SQ_PLUGIN_NAME_); ?> (http://www.google.sm/)</option>
                                <option value="com.sg"><?php _e('Singapore', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.sg/)</option>
                                <option value="sk"><?php _e('Slovakia', _SQ_PLUGIN_NAME_); ?> (http://www.google.sk/)</option>
                                <option value="co.za"><?php _e('South Africa', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.za/)</option>
                                <option value="es"><?php _e('Spain', _SQ_PLUGIN_NAME_); ?> (http://www.google.es/)</option>
                                <option value="se"><?php _e('Sweden', _SQ_PLUGIN_NAME_); ?> (http://www.google.se/)</option>
                                <option value="ch"><?php _e('Switzerland', _SQ_PLUGIN_NAME_); ?> (http://www.google.ch/)</option>
                                <option value="com.tw"><?php _e('Taiwan', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.tw/)</option>
                                <option value="co.th"><?php _e('Thailand', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.th/)</option>
                                <option value="tt"><?php _e('Trinidad and Tobago', _SQ_PLUGIN_NAME_); ?> (http://www.google.tt/)</option>
                                <option value="com.tr"><?php _e('Turkey', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.tr/)</option>
                                <option value="com.ua"><?php _e('Ukraine', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.ua/)</option>
                                <option value="ae"><?php _e('United Arab Emirates', _SQ_PLUGIN_NAME_); ?> (http://www.google.ae/)</option>
                                <option value="co.uk"><?php _e('United Kingdom', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.uk/)</option>
                                <option value="com.uy"><?php _e('Uruguay', _SQ_PLUGIN_NAME_); ?> (http://www.google.com.uy/)</option>
                                <option value="uz"><?php _e('Uzbekistan', _SQ_PLUGIN_NAME_); ?> (http://www.google.uz/)</option>
                                <option value="vu"><?php _e('Vanuatu', _SQ_PLUGIN_NAME_); ?> (http://www.google.vu/)</option>
                                <option value="co.ve"><?php _e('Venezuela', _SQ_PLUGIN_NAME_); ?> (http://www.google.co.ve/)</option>
                            </select>
                        </div>


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
                <legend class="sq_legend_medium">
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
                    <p class="withborder withcode" >
                        <span class="sq_icon sq_icon_pinterest"></span>
                        <?php echo sprintf(__('Pinterest META code:', _SQ_PLUGIN_NAME_), '<a href="#" target="_blank">', '</a>'); ?><br><strong>&lt;meta name="p:domain_verify" content=" <input type="text" name="sq_pinterest" value="<?php echo (($view->options['sq_pinterest'] <> '') ? $view->options['sq_pinterest'] : '') ?>" size="15" /> " /&gt;</strong>
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
        jQuery('#sq_settings').find('select[name=sq_google_country]').val('<?php echo $view->options['sq_google_country']; ?>');
    </script>
</div>