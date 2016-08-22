<?php

namespace WpTheme\Modules\Addon;


use Illuminate\Cache\CacheManager;

/**
 * @property \Laravel\Lumen\Application|mixed cache
 */
class AddonACF
{

    protected $options;
    protected $sites;
    protected $cache;

    /**
     * Initialize
     */
    public function __construct(CacheManager $cache)
    {

        $this->cache = $cache;

        if (function_exists('acf_add_options_page')) {
            acf_add_options_page();
        }

        /**
         * Adds multiple sub sections
         */
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page('Default');
        }

        if (function_exists('add_filter')) {
            add_filter('acf/settings/save_json', [$this, 'acf_json_save_point']);
        }

        /**
         * Add Redirects
         */
        if (function_exists('add_action')) {
            add_action('template_redirect', [$this, 'custom_redirects_handler']);
            add_action('w3tc_flush_all', [$this, 'clear_cache']);
        }
    }

    /**
     * @param $path
     *
     * @return string
     */
    public function acf_json_save_point($path)
    {
        return get_stylesheet_directory() . '/acf-json';
    }

    /**
     * Get all option fields
     *
     * @return array
     */
    public function get_option_fields()
    {
        if (!is_array($this->options)) {
            $this->set_option_fields();
        }
        return $this->options;
    }

    /**
     * Get all site fields
     *
     * @return array
     */
    public function get_site_fields()
    {
        if (!is_array($this->sites)) {
            $this->set_site_fields();
        }
        return $this->sites;
    }

    /**
     * Get a specific option field
     *
     * @return array
     */
    public function get_option_field($key)
    {
        if (!is_array($this->options)) {
            $this->set_option_fields();
        }

        return is_array($this->options) && array_key_exists($key, $this->options) ? $this->options[$key] : false;
    }

    /**
     * Set option fields
     */
    protected function set_option_fields()
    {
        if (function_exists('get_fields')) {
            $this->options = $this->cache->remember('options_' . get_current_blog_id(), 1440, function () {
                return get_fields('options');
            });
        }
    }

    /**
     * Set site fields
     */
    protected function set_site_fields()
    {
        $this->sites = $this->cache->rememberForever('sites', function () {
            if (!is_multisite()) return false;

            // Because the get_blog_list() function is currently flagged as deprecated
            // due to the potential for high consumption of resources, we'll use
            // $wpdb to roll out our own SQL query instead. Because the query can be
            // memory-intensive, we'll store the results using the Transients API
            global $wpdb;
            $site_list = $wpdb->get_results('SELECT * FROM wp_blogs ORDER BY blog_id');

            $current_site_url = get_site_url(get_current_blog_id());

            $sites = array();

            foreach ($site_list as $site) {
                switch_to_blog($site->blog_id);
                $sites[$site->blog_id] = get_site_url($site->blog_id);
                restore_current_blog();
            }

            return $sites;
        });
    }

    public function custom_redirects_handler()
    {

        $id = is_home() && !get_query_var('name') ? get_option('page_for_posts') : get_the_ID();
        $type = get_field('redirect_type', $id);

        if ($type && $type != 'NULL') {
            $redirect_link_type = get_field('redirect_link_type', $id);

            if ($redirect_link_type == 'external') {
                $link = get_field('redirect_external_link', $id);
            } else {
                $link = get_field('redirect_internal_link', $id);
            }

            header("HTTP/1.0 $type");
            header("Location: $link");
            exit();
        }
    }

    public function clear_cache()
    {
        $this->cache->flush();
    }
}