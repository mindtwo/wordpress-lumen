<?php

/**
 * Set timezone for this application
 */
date_default_timezone_set('Europe/Berlin');


/**
 * Define constants
 */
define('THEME_MAILS_TO_DEVELOPER', true);
define('THEME_APPLICATION_DIR', realpath(ABSPATH . '/../') . '/');
define('THEME_DIR', realpath(get_template_directory()) . '/');
define('THEME_FUNCTIONS', THEME_DIR . 'functions/');
define('THEME_CONFIG', THEME_DIR . 'config/');
define('THEME_WIDGETS', THEME_DIR . 'widgets/');
define('THEME_INCLUDES', THEME_DIR . 'includes/');
define('THEME_TEMPLATES', THEME_DIR . 'templates/');
define('THEME_ASSETS', THEME_DIR . 'assets/');
define('THEME_ASSETS_LIVE', get_bloginfo('template_directory') . '/assets/');
define('THEME_STORAGE', realpath(THEME_APPLICATION_DIR) . 'lumen/storage/wordpress/');
define('TEMPLATE_DIR', realpath(THEME_APPLICATION_DIR . 'resources/views/'));


/**
 * Set files to be autoloaded
 */
$autoload_class_files = array(
    // THEME_FUNCTIONS . 'general/minify_html.php',
    // THEME_FUNCTIONS . 'general/theme_init_actions.php',
    THEME_FUNCTIONS . 'general/config.php',
    THEME_FUNCTIONS . 'general/theme_helper.php',
    THEME_FUNCTIONS . 'general/session.php',
    THEME_FUNCTIONS . 'general/custom_excerpt.php',
    THEME_FUNCTIONS . 'general/cleanup_backend.php',
    THEME_FUNCTIONS . 'general/cleanup_frontend.php',
    THEME_FUNCTIONS . 'general/shortcode_helper.php',
    THEME_FUNCTIONS . 'site/shortcode-acf.php', // must be initialized before acf.php
    THEME_FUNCTIONS . 'general/acf.php',
    // THEME_FUNCTIONS . 'general/dashboard_widgets.php',
    // THEME_FUNCTIONS . 'general/capabilities.php',
    THEME_FUNCTIONS . 'site/sidebar.php',
    THEME_FUNCTIONS . 'site/pagination.php',
    THEME_FUNCTIONS . 'site/shortcodes.php',
    THEME_FUNCTIONS . 'site/bootstrap_walker_nav.php',
    THEME_FUNCTIONS . 'site/footer_nav.php',
    THEME_FUNCTIONS . 'site/multisite.php',
    THEME_FUNCTIONS . 'site/navigation.php',
    THEME_FUNCTIONS . 'get_content/helper/get_thumbnail_image.php',
    THEME_FUNCTIONS . 'get_content/customers-list.php',
    THEME_FUNCTIONS . 'get_content/projects-list.php',
    THEME_FUNCTIONS . 'get_content/team-list.php',
    THEME_FUNCTIONS . 'get_content/pager_simple_next_prev.php',
    THEME_FUNCTIONS . 'custom_post_type/team.php',
	THEME_WIDGETS . 'search-box.php',
	THEME_WIDGETS . '_widget_init.php', // Must loaded after widget import
);


/**
 * Autoload class files
 */
foreach($autoload_class_files as $file){
	require_once($file);
}


/**
 * Add Timber template pathes
 */
Timber::$locations = TEMPLATE_DIR;
Timber::$dirname = TEMPLATE_DIR;


/**
 * Load theme config files
 */
$theme_sites_config = include(THEME_CONFIG . 'sites.php');
$smtps = include(THEME_CONFIG . 'smtp.php');
$theme_comment = include(THEME_CONFIG . 'comment.php');


/**
 * Load global theme classes
 */
$detect = new \Jenssegers\Agent\Agent();
$helper = new \cg\Helper\HelperBuilder();


/**
 * Enable meta logging
 */
$helper->meta()->writeClickStreamToSession();