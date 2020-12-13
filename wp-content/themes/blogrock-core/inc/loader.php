<?php

/**
 * Define Constants
 */

if (!defined('ROCKSITE_THEME_DIR')) {
    define('ROCKSITE_THEME_DIR', trailingslashit(get_template_directory()));
}

if (!defined('ROCKSITE_THEME_URI')) {
    define('ROCKSITE_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));
}

if (!defined('ROCKSITE_THEME_SETTINGS')) {
    define('ROCKSITE_THEME_SETTINGS', 'rocksite-settings');
}

if (!defined('ROCKSITE_THEME_LIB')) {
    define('ROCKSITE_THEME_LIB', ROCKSITE_THEME_DIR . 'inc/');
}

if (!defined('ROCKSITE_THEME_CONFIG')) {
    define('ROCKSITE_THEME_CONFIG', ROCKSITE_THEME_DIR . 'config/');
}

if (!defined('ROCKSITE_THEME_CLASSES')) {
    define('ROCKSITE_THEME_CLASSES', ROCKSITE_THEME_LIB . 'classes/');
}

if (!defined('ROCKSITE_THEME_ASSETS')) {
    define('ROCKSITE_THEME_ASSETS', ROCKSITE_THEME_URI . 'assets/');
}

if (!defined('ROCKSITE_THEME_ADMIN_ASSETS')) {
    define('ROCKSITE_THEME_ADMIN_ASSETS', ROCKSITE_THEME_URI . 'admin/assets/');
}


// library
require_once ROCKSITE_THEME_CLASSES . 'class-base.php';
require_once ROCKSITE_THEME_CLASSES . 'class-blogrock.php';
require_once ROCKSITE_THEME_CLASSES . 'class-config.php';
require_once ROCKSITE_THEME_CLASSES . 'class-customizer.php';

Blogrock_Rocksite::get_instance();


