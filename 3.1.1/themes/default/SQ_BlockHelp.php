<div id="sq_settings" >
    <span class="sq_icon"></span>
    <div id="sq_settings_title" ><?php _e('Connect to Squirrly.co', _SQ_PLUGIN_NAME_); ?> </div>
    <?php
    if (SQ_Tools::$options['sq_api'] == '') {
        echo '<div id="sq_settings_login">';
        SQ_ObjController::getBlock('SQ_Blocklogin')->init();
        echo '</div>';
    }
    ?>

    <div id="sq_settings_title" style="text-align: right">
        <a href="?page=sq_dashboard" id="sq_goto_newpost" <?php echo ((SQ_Tools::$options['sq_api'] <> '') ? '' : 'style="display:none"') ?> /><?php _e('<< START HERE >>', _SQ_PLUGIN_NAME_) ?></a>
    </div>
</div>