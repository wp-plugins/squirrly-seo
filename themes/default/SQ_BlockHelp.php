<div id="sq_settings" >
    <span class="sq_icon"></span>
    <div id="sq_settings_title" ><?php _e('Connect to Squirrly.co', _SQ_PLUGIN_NAME_); ?> </div>
    <?php
    if (SQ_Tools::$options['sq_api'] == '') {
        echo '<div id="sq_settings_login">';
        SQ_ObjController::getBlock('SQ_Blocklogin')->init();
        echo '</div>';
    }

    global $current_user;
    $recent_posts = wp_get_recent_posts(array('post_status' => 'publish', 'author' => $current_user->ID));
    if (!empty($recent_posts)) {
        foreach ($recent_posts as $recent) {
            $link = 'post.php?post=' . $recent["ID"] . '&action=edit";';
            break;
        }
    } else {
        $link = 'post-new.php';
    }
    ?>

    <div id="sq_settings_title" style="text-align: right">
        <a href="<?php echo $link ?>" id="sq_goto_newpost" <?php echo ((SQ_Tools::$options['sq_api'] <> '') ? '' : 'style="display:none"') ?> /><?php _e('<< START HERE >>', _SQ_PLUGIN_NAME_) ?></a>
    </div>
</div>