<div id="sq_dashboard" >
    <span class="sq_icon"></span>
    <div id="sq_dashboard_title" ><?php _e('Squirrly dashboard', _SQ_PLUGIN_NAME_); ?> </div>
    <div id="sq_dashboard_subtitle" ><?php _e('from this menu, you can start using all the great features of Squirrly (that you won’t find in any other seo plugins for wordpress)', _SQ_PLUGIN_NAME_); ?> </div>
    <div id="sq_dashboard_body" style="min-height: 400px;">

        <div class="sq_dashboard_box">
            <div class="sq_dashboard_assistant"></div>
        </div>
        <div class="sq_dashboard_box">
            <div class="sq_dashboard_analytics"></div>
        </div>

        <?php SQ_ObjController::getBlock('SQ_BlockAudit')->init(); ?>

        <div class="sq_dashboard_box">
            <div class="sq_dashboard_research"></div>
        </div>

    </div>
</div>
<script type="text/javascript">
    //Dashboard
    jQuery("#sq_dashboard").find('.sq_dashboard_assistant').bind('click', function() {
<?php
$recent_posts = wp_get_recent_posts();
if (!empty($recent_posts)) {
    foreach ($recent_posts as $recent) {
        echo 'location.href = "post.php?post=' . $recent["ID"] . '&action=edit";';
        break;
    }
} else {
    echo 'location.href = "post-new.php";';
}
?>
    });
    jQuery("#sq_dashboard").find('.sq_dashboard_analytics').bind('click', function() {
<?php
if (SQ_ObjController::getModel('SQ_Post')->countKeywords() > 0) {
    echo 'location.href = "admin.php?page=sq_posts";';
} else {
    echo 'alert("' . __('To see the analytics for your posts, you have to start optimizing your articles using Squirrly. That will enable tracking, and we\'ll be able to send you valuable data about your post.', _SQ_PLUGIN_NAME_) . '");';
}
?>
    });

    jQuery("#sq_dashboard").find('.sq_dashboard_research').bind('click', function() {
        location.href = "post-new.php#sq_research=1";
    });
</script>