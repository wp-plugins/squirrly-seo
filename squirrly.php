<?php

/*
  Copyright (c) 2012, Squirrly Limited.
  The copyrights to the software code in this file are licensed under the (revised) BSD open source license.

  Plugin Name: SEO Plugin by SQUIRRLY
  Plugin URI: http://www.squirrly.co
  Description: Squirrly SEO Plugin is for the NON-SEO expert. Get Excellent SEO with Better Content and SEO Stats. For Both Humans and Search Bots.<BR> <a href="http://my.squirrly.co/user" target="_blank"><strong>Check your profile</strong></a>
  Author: cifi, calinvingan, florinmuresan
  Version: 3.2.3
  Author URI: http://www.squirrly.co
 */

/* SET THE CURRENT VERSION ABOVE AND BELOW */
define('SQ_VERSION', '3.2.3');

/* Call config files */
require(dirname(__FILE__) . '/config/config.php');

/* important to check the PHP version */
if (PHP_VERSION_ID >= 5100) {
    /* inport main classes */
    require_once(_SQ_CLASSES_DIR_ . 'SQ_ObjController.php');
    require_once(_SQ_CLASSES_DIR_ . 'SQ_BlockController.php');

    /* Main class call */
    $fc = SQ_ObjController::getController('SQ_FrontController', false);
    $fc->run();

    if (!is_admin()) {
        SQ_ObjController::getController('SQ_Frontend');
    }

    add_action('sq_processCron', array(SQ_ObjController::getController('SQ_Ranking', false), 'processCron'));
} else {
    /* Main class call */
    add_action('admin_init', 'phpError');
}

/**
 * Show PHP Error message if PHP is lower the required
 */
function phpError() {
    add_action('admin_notices', 'showError');
}

/**
 * Called in Notice Hook
 */
function showError() {
    echo '<div class="update-nag"><span style="color:red; font-weight:bold;">' . __('For Squirrly to work, the PHP version has to be equal or greater then 5.1', _SQ_PLUGIN_NAME_) . '</span></div>';
}

// --
/**
 *  Upgrade Squirrly call.
 */
register_activation_hook(__FILE__, array(SQ_ObjController::getController('SQ_Tools', false), 'sq_activate'));
register_deactivation_hook(__FILE__, array(SQ_ObjController::getController('SQ_Tools', false), 'sq_deactivate'));


