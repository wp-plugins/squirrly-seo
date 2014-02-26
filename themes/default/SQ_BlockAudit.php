<div id="sq_option_audit">
    <span id="sq_option_audit_link" style="display: none">
        <?php echo '<a class="sq_button"  target="_blank">' . __('Check your site audit', _sq_PLUGIN_NAME_) . '</a>' ?>
    </span>
    <span id="sq_option_audit_notmade" style="display: none">
        <?php _e('The audit will be ready in 1-3 days ...', _sq_PLUGIN_NAME_) ?>
    </span>
    <span id="sq_option_audit_notready" style="display: none">
        <?php _e('The audit will be ready soon ...', _sq_PLUGIN_NAME_) ?>
    </span>
    <span id="sq_option_audit_error" style="display: none">
        <?php _e('Squirrly receives an error page while checking your site ...', _sq_PLUGIN_NAME_) ?>
    </span>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        sq_checkAudit("<?php echo _SQ_DASH_URL_ ?>", "<?php echo SQ_Tools::$options['sq_api'] . md5(get_bloginfo('url')) ?>"); //Check the seo audit for this page
    });
</script>
