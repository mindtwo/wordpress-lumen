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





$_GET['debug'] = 'sql';

define('SAVEQUERIES', true);


if ( !defined('SAVEQUERIES') && isset($_GET['debug']) && $_GET['debug'] == 'sql' )
    define('SAVEQUERIES', true);
if ( !function_exists('dump') ) :
    /**
     * dump()
     *
     * @param mixed $in
     * @return mixed $in
     **/

    function dump($in = null) {
        echo '<pre style="margin-left: 0px; margin-right: 0px; padding: 10px; border: solid 1px black; background-color: ghostwhite; color: black; text-align: left;">';
        foreach ( func_get_args() as $var ) {
            echo "\n";
            if ( is_string($var) ) {
                echo "$var\n";
            } else {
                var_dump($var);
            }
        }
        echo '</pre>' . "\n";
        return $in;
    } # dump()
endif;

/**
 * add_stop()
 *
 * @param mixed $in
 * @param string $where
 * @return mixed $in
 **/

function add_stop($in = null, $where = null) {
    global $sem_stops;
    global $wp_object_cache;
    $queries = get_num_queries();
    $milliseconds = timer_stop() * 1000;
    $out =  "$queries queries - {$milliseconds}ms";
    if ( function_exists('memory_get_usage') ) {
        $memory = number_format(memory_get_usage() / ( 1024 * 1024 ), 1);
        $out .= " - {$memory}MB";
    }
    $out .= " - $wp_object_cache->cache_hits cache hits / " . ( $wp_object_cache->cache_hits + $wp_object_cache->cache_misses );
    if ( $where ) {
        $sem_stops[$where] = $out;
    } else {
        dump($out);
    }
    return $in;
} # add_stop()


/**
 * dump_stops()
 *
 * @param mixed $in
 * @return mixed $in
 **/

function dump_stops($in = null) {
    if ( $_POST )
        return $in;
    global $sem_stops;
    global $wp_object_cache;
    $stops = '';
    foreach ( $sem_stops as $where => $stop )
        $stops .= "$where: $stop\n";
    dump("\n" . trim($stops) . "\n");
    if ( defined('SAVEQUERIES') && $_GET['debug'] == 'sql' ) {
        global $wpdb;
        foreach ( $wpdb->queries as $key => $data ) {
            $query = rtrim($data[0]);
            $duration = number_format($data[1] * 1000, 1) . 'ms';
            $loc = trim($data[2]);
            $loc = preg_replace("/(require|include)(_once)?,\s*/ix", '', $loc);
            $loc = "\n" . preg_replace("/,\s*/", ",\n", $loc) . "\n";
            dump($query, $duration, $loc);
        }
    }
    if ( $_GET['debug'] == 'cache' )
        dump($wp_object_cache->cache);
    if ( $_GET['debug'] == 'cron' ) {
        $crons = get_option('cron');
        foreach ( $crons as $time => $_crons ) {
            if ( !is_array($_crons) )
                continue;
            foreach ( $_crons as $event => $_cron ) {
                foreach ( $_cron as $details ) {
                    $date = date('Y-m-d H:m:i', $time);
                    $schedule = isset($details['schedule']) ? "({$details['schedule']})" : '';
                    if ( $details['args'] )
                        dump("$date: $event $schedule", $details['args']);
                    else
                        dump("$date: $event $schedule");
                }
            }
        }
    }
    return $in;
} # dump_stops()
add_action('init', create_function('$in', '
    return add_stop($in, "Load");
    '), 10000000);
add_action('template_redirect', create_function('$in', '
    return add_stop($in, "Query");
    '), -10000000);
add_action('wp_footer', create_function('$in', '
    return add_stop($in, "Display");
    '), 10000000);
add_action('admin_footer', create_function('$in', '
    return add_stop($in, "Display");
    '), 10000000);

/**
 * init_dump()
 *
 * @return void
 **/

function init_dump() {
    global $hook_suffix;
    if ( !is_admin() || empty($hook_suffix) ) {
        add_action('wp_footer', 'dump_stops', 10000000);
        add_action('admin_footer', 'dump_stops', 10000000);
    } else {
        add_action('wp_footer', 'dump_stops', 10000000);
        add_action("admin_footer-$hook_suffix", 'dump_stops', 10000000);
    }
} # init_dump()
add_action('wp_print_scripts', 'init_dump');


/**
 * dump_phpinfo()
 *
 * @return void
 **/

function dump_phpinfo() {
    if ( isset($_GET['debug']) && $_GET['debug'] == 'phpinfo' ) {
        phpinfo();
        die;
    }
} # dump_phpinfo()
add_action('init', 'dump_phpinfo');


/**
 * dump_http()
 *
 * @param array $args
 * @param string $url
 * @return array $args
 **/

function dump_http($args, $url) {
    dump(preg_replace("|/[0-9a-f]{32}/?$|", '', $url));
    return $args;
} # dump_http()


/**
 * dump_trace()
 *
 * @return void
 **/

function dump_trace() {
    $backtrace = debug_backtrace();
    foreach ( $backtrace as $trace )
        dump(
            'File/Line: ' . $trace['file'] . ', ' . $trace['line'],
            'Function / Class: ' . $trace['function'] . ', ' . $trace['class']
        );
} # dump_trace()

add_filter('http_request_args', 'dump_http', 0, 2);