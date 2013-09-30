<?php

$currentDir = dirname(__FILE__);

define('_ABH_NAMESPACE_', 'ABH'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS
define('_ABH_PLUGIN_NAME_', 'starbox'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS
define('_ABH_THEME_NAME_', 'admin'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS

/* Directories */
define('_ABH_ROOT_DIR_', realpath($currentDir . '/..'));
define('_ABH_GRAVATAR_DIR_', _ABH_ROOT_DIR_ . '/gravatar/');
define('_ABH_CLASSES_DIR_', _ABH_ROOT_DIR_ . '/classes/');
define('_ABH_CONTROLLER_DIR_', _ABH_ROOT_DIR_ . '/controllers/');
define('_ABH_MODEL_DIR_', _ABH_ROOT_DIR_ . '/models/');
define('_ABH_TRANSLATIONS_DIR_', _ABH_ROOT_DIR_ . '/translations/');
define('_ABH_CORE_DIR_', _ABH_ROOT_DIR_ . '/core/');
define('_ABH_ALL_THEMES_DIR_', _ABH_ROOT_DIR_ . '/themes/');
define('_ABH_THEME_DIR_', _ABH_ROOT_DIR_ . '/themes/' . _ABH_THEME_NAME_ . '/');

/* URLS */
define('_ABH_URL_', WP_PLUGIN_URL . '/' . _ABH_PLUGIN_NAME_);
define('_ABH_GRAVATAR_URL_', _ABH_URL_ . '/gravatar/');
define('_ABH_ALL_THEMES_URL_', _ABH_URL_ . '/themes/');
define('_ABH_THEME_URL_', _ABH_URL_ . '/themes/' . _ABH_THEME_NAME_ . '/');
?>