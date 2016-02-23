<?php

namespace WpTheme\Modules\Addon;


use Illuminate\Cache\CacheManager;

/**
 * @property \Laravel\Lumen\Application|mixed cache
 */
class AddonACF {

    protected $options;
    protected $cache;

    /**
     * Initialize
     */
    public function __construct(CacheManager $cache) {
        $this->cache = $cache;

        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page();
        }

        /**
         * Adds multiple sub sections
         */
        if ( function_exists( 'acf_add_options_sub_page' ) ) {
            acf_add_options_sub_page( 'Default' );
        }

        if( function_exists( 'add_filter' ) ) {
            add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point']);
        }
    }

    /**
     * @param $path
     *
     * @return string
     */
    public function my_acf_json_save_point( $path ) {
        return get_stylesheet_directory() . '/acf-json';
    }

    /**
     * Get all option fields
     *
     * @return array
     */
    public function get_option_fields() {
        if(!is_array($this->options)) {
            $this->set_option_fields();
        }
        return $this->options;
    }

    /**
     * Get a specific option field
     *
     * @return array
     */
    public function get_option_field($key) {
        if(!is_array($this->options)) {
            $this->set_option_fields();
        }

        return array_key_exists($key, $this->options) ? $this->options[$key] : false;
    }

    /**
     * Set option fields
     */
    protected function set_option_fields() {
        if( function_exists( 'get_fields' ) ) {
            $this->options = $this->cache->rememberForever('options_' . get_current_blog_id(), function() {
                return get_fields('options');
            });
        }
    }
}
