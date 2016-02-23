<?php

/**
 * Define constants
 */
define('THEME_APPLICATION_DIR', realpath( ABSPATH . '/../../') . '/');
define('THEME_DIR', realpath(get_template_directory()) . '/');
define('THEME_FUNCTIONS', THEME_DIR . 'functions/');
define('THEME_CONFIG', THEME_DIR . 'config/');
define('THEME_TEMPLATES', THEME_DIR . 'templates/');
define('THEME_ASSETS', THEME_DIR . 'assets/');
define('THEME_ASSETS_LIVE', get_bloginfo('template_directory') . '/assets/');
define('THEME_STORAGE', realpath(THEME_APPLICATION_DIR) . 'lumen/storage/wordpress/');
define('TEMPLATE_DIR', realpath(THEME_APPLICATION_DIR . 'resources/views/'));


/**
 * Require WordPress theme helpers
 */
require_once(THEME_FUNCTIONS . 'multisite.php');
require_once(THEME_FUNCTIONS . 'theme.php');


/**
 * Load lumen
 */
try {
    $request = \Illuminate\Http\Request::capture();
    $app = require THEME_APPLICATION_DIR.'/lumen/bootstrap/app.php';
    $app->run($request);
} catch (Exception $e) {}


/**
 * Register service providers
 */
$app->register(\WpTheme\Shortcodes\ShortcodesRegister::class);
$app->register(\WpTheme\PostTypes\CustomPostTypeRegister::class);
$app->register(\WpTheme\Widgets\WidgetsRegister::class);
$app->register(\WpTheme\Modules\ModulesRegister::class);
$app->register(\WpTheme\Routes\RoutesRegister::class);


/**
 * Load global vars
 */
$detect = $app->make('Agent');