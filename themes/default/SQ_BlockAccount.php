<div id="sq_settings" class="sq_userinfo" >
    <?php SQ_ObjController::getBlock('SQ_BlockSupport')->init(); ?>
    <?php if (SQ_Tools::$options['sq_api'] <> '') { ?>
        <form id="sq_settings_dashboard_form" name="settings" action="" method="post" enctype="multipart/form-data">
            <span class="sq_icon"></span>
            <div id="sq_settings_title" ><?php _e('Squirrly account information', _SQ_PLUGIN_NAME_); ?> </div>
            <div id="sq_settings_body" style="min-height: 400px;">

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