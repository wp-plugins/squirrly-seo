<div id="sq_settings" class="sq_userinfo" >
    <?php SQ_ObjController::getBlock('SQ_BlockSupport')->init(); ?>

    <?php if (SQ_Tools::$options['sq_api'] <> '') { ?>
        <form id="sq_settings_dashboard_form" name="settings" action="" method="post" enctype="multipart/form-data">
            <span class="sq_icon"></span>
            <div id="sq_settings_title" ><?php _e('Squirrly account information', _SQ_PLUGIN_NAME_); ?> </div>
            <div id="sq_settings_body" style="min-height: 400px;">
                <?php if (SQ_Tools::$options['sq_hide_survey'] == 0) { ?>
                    <div id="sq_survey" style="display: none;">
                        <span class="sq_survey_title" ><?php _e('Hey,', _SQ_PLUGIN_NAME_) ?></span>
                        <ul>
                            <li><?php echo __('Thanks for joining Squirrly. We love our users and we like it when they reach out to us.', _SQ_PLUGIN_NAME_) ?></li>
                            <li><?php echo __('If you wouldn’t mind, I’d love it if you answered one quick question: why did you sign up for Squirrly?', _SQ_PLUGIN_NAME_) ?></li>
                            <li>
                                <p id="sq_survey_msg"><textarea class="sq_small_input" name="sq_survey_message" cols="60" rows="10"></textarea></p>
                                <div id="sq_survey_error"></div>
                                <p><div id="sq_survey_close" ><?php echo __('[stop showing this message]', _SQ_PLUGIN_NAME_) ?></div> <input id="sq_survey_submit" type="button" value="<?php _e('Send Reply', _SQ_PLUGIN_NAME_) ?>"> </p>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
                <?php
                if (SQ_Tools::$options['sq_api'] <> '') {
                    echo '<fieldset style="background: none; border: none; box-shadow: none;"><div id="sq_userinfo"></div></fieldset>
                <script type="text/javascript">
                   jQuery(document).ready(function() {
                        sq_getUserStatus("' . _SQ_API_URL_ . '", "' . SQ_Tools::$options['sq_api'] . '");
                   });
                </script>';
                }
                ?>
                <div id="sq_settings_title" style="text-align: right">
                    <input id="sq_goto_dashboard" type="button" value="<?php _e('Go to dashboard', _SQ_PLUGIN_NAME_) ?> &raquo;" />
                </div>

            </div>
        </form>

    <?php } ?>
</div>