<div class="sq_dashboard_box">
    <div class="sq_dashboard_audit" onclick="window.open('<?php echo _SQ_DASH_URL_ ?>user/audit/<?php echo SQ_Tools::$options['sq_api'] . md5(get_bloginfo('url')) ?>', '_blank');"><span id="sq_audit_error" style="display: none;"><?php _e('Your site audit is not yet ready. It may take up to 7 days to audit your blog.', _SQ_PLUGIN_NAME_); ?></span></div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        sq_checkAudit("<?php echo _SQ_DASH_URL_ ?>", "<?php echo SQ_Tools::$options['sq_api'] . md5(get_bloginfo('url')) ?>"); //Check the seo audit for this page
    });

</script>
