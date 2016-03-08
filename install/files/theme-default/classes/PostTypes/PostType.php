<?php

namespace WpTheme\PostTypes;

use ReflectionClass;

/**
 * Class PostType
 */
abstract class PostType {

    /**
     * Declared in implementation
     *
     * @var string
     */
    protected $post_type = '';

    /**
     * Define post type cache keys to forget them on save
     *
     * @var string
     */
    protected $post_type_cache_keys = [];

    /**
     * Initialize
     */
    function __construct() {
        // Get classname as default post type name
        $reflect = new ReflectionClass($this);
        $class_name = $reflect->getShortName();
        $this->post_type = $this->camel_case_to_undercore_case($class_name);
        $this->name = ucwords($this->post_type);
        $this->singular_name = ucwords($this->post_type);

        // Register save method
        add_action( 'save_post', [$this, 'save_post_type'], 10, 3 );
    }

    /**
     * Save post metadata when a post is saved.
     *
     * @param int $post_id The post ID.
     * @param post $post The post object.
     * @param bool $update Whether this is an existing post being updated or not.
     */
    public function save_post_type($post_id, $post, $update) {
        $this->clear_cache( $post );
    }

    /**
     * Clear post type caches
     *
     * @param $post
     */
    protected function clear_cache( $post ) {
        if ( $this->post_type != $post->post_type ) {
            return;
        }

        $cache = app( 'cache' );

        if ( is_object( $cache ) && ! empty( $this->post_type_cache_keys ) && is_array($this->post_type_cache_keys) ) {
            foreach ( $this->post_type_cache_keys as $key ) {
                $cache->forget( $key );
            }
        }
    }

    /**
     * Converts a camel case string to a lowercase underscore string
     *
     * @param $input
     *
     * @return string
     */
    protected function camel_case_to_undercore_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}