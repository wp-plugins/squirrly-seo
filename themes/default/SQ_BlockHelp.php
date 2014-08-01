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

    <div id="sq_settings_howto">
        <div id="sq_settings_howto_title" ><?php _e('Get Excellent SEO with Better Content and SEO Stats. For Both Humans and Search Bots.', _PLUGIN_NAME_); ?></div>
        <div id="sq_settings_howto_body">
            <p><iframe width="640" height="480" src="//www.youtube.com/embed/mEjrE7TuDDc" frameborder="0" allowfullscreen></iframe></p>
            <div id="sq_settings_howto_title" ><?php _e('Squirrly SEO Plugin is for the NON-SEO expert. ', _PLUGIN_NAME_); ?></div>
            <p><span><?php _e('See all the Squirrly SEO features at: ', _PLUGIN_NAME_); ?><a href="http://bit.ly/1lV9dX6" target="_blank"><strong>Squirrly Features</strong></a></span></p>
        </div>
    </div>
    <div class="sq_login_link"><?php _e('Connect to Squirrly and start optimizing your site', _PLUGIN_NAME_); ?></div>
    <div id="sq_settings_title" style="text-align: right">
        <a href="<?php echo $link ?>" id="sq_goto_newpost" <?php echo ((SQ_Tools::$options['sq_api'] <> '') ? '' : 'style="display:none"') ?> /><?php _e('<< START HERE >>', _SQ_PLUGIN_NAME_) ?></a>
    </div>
</div>