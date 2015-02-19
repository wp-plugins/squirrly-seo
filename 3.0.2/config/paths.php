<?php

define('_ABH_NAMESPACE_', 'ABH'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS
define('_ABH_PLUGIN_NAME_', 'starbox'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS
define('_ABH_THEME_NAME_', 'admin'); //THIS LINE WILL BE CHANGED WITH THE USER SETTINGS

/* Directories */
define('_ABH_ROOT_DIR_', plugin_dir_path(dirname(__FILE__)));

$upload_dir = wp_upload_dir();
define('_ABH_GRAVATAR_DIR_', (is_dir($upload_dir['basedir']) ? $upload_dir['basedir'] . '/gravatar/' : _ABH_ROOT_DIR_ . '/gravatar/'));
if (!is_dir(_ABH_GRAVATAR_DIR_))
    if (!wp_mkdir_p(_ABH_GRAVATAR_DIR_)) {
        echo sprintf(__('Unable to create directory %s. Is its parent directory writable by the server?'), _ABH_GRAVATAR_DIR_);
    }
define('_ABH_CLASSES_DIR_', _ABH_ROOT_DIR_ . '/classes/');
define('_ABH_CONTROLLER_DIR_', _ABH_ROOT_DIR_ . '/controllers/');
define('_ABH_MODEL_DIR_', _ABH_ROOT_DIR_ . '/models/');
define('_ABH_TRANSLATIONS_DIR_', _ABH_ROOT_DIR_ . '/translations/');
define('_ABH_CORE_DIR_', _ABH_ROOT_DIR_ . '/core/');
define('_ABH_ALL_THEMES_DIR_', _ABH_ROOT_DIR_ . '/themes/');
define('_ABH_THEME_DIR_', _ABH_ROOT_DIR_ . '/themes/' . _ABH_THEME_NAME_ . '/');

/* URLS */
define('_ABH_URL_', plugins_url('/', dirname(__FILE__)));
define('_ABH_GRAVATAR_URL_', (is_dir($upload_dir['basedir'] . '/gravatar') ? $upload_dir['baseurl'] . '/gravatar/' : _ABH_URL_ . '/gravatar/'));
define('_ABH_ALL_THEMES_URL_', _ABH_URL_ . '/themes/');
define('_ABH_THEME_URL_', _ABH_URL_ . '/themes/' . _ABH_THEME_NAME_ . '/');
?>