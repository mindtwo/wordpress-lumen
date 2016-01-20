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
 * Set backend localisation
 * TODO: set language by domain
 * TODO: extract to own class
 */
// if(is_admin()) {
//     $translator = app('translator');
//     $translator->setLocale('en');
// }


/**
 * Require WordPress theme helpers
 */
require_once(THEME_FUNCTIONS . 'multisite.php');
require_once(THEME_FUNCTIONS . 'theme.php');


/**
 * Register theme classes
 */
$app = (new \WpTheme\Modules\Addon\AddonLumen())->register();
$app->singleton('ACF', function () {
    return new \WpTheme\Modules\Addon\AddonACF();
});
$shortcodes = new \WpTheme\Shortcodes\ShortcodesRegister($app);
$detect = new \Jenssegers\Agent\Agent();
$cpt = new \WpTheme\PostTypes\CustomPostTypeRegister();
$widgets = new \WpTheme\Widgets\WidgetsRegister();
$modules = new \WpTheme\Modules\ModulesRegister($app);