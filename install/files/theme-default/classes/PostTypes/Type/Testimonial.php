<?php

namespace WpTheme\PostTypes\Type;

use WpTheme\PostTypes\CustomPostType;

class Testimonial extends CustomPostType
{

    public function register()
    {
        parent::register();
        $this->name = trans('cpt-testimonial.labels.name');
        $this->singular_name = 'cpt-testimonial.labels.singular-name';
    }

    /**
     * Custom Post Type
     * http://codex.wordpress.org/Function_Reference/register_post_type
     */
    public function register_post_type()
    {
        $custom_params = [
            'public' => false,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'query_var' => false,
            'menu_icon' => 'dashicons-format-quote', // Select an icon: https://developer.wordpress.org/resource/dashicons/
            'rewrite' => array('slug' => 'testimonial', 'with_front' => false),
            'supports' => array('title', 'editor', 'thumbnail'),
        ];

        register_post_type($this->post_type, array_merge($this->post_type_params, $custom_params));
    }

    /**
     * Register Custom Post Type Taxonomies
     */
    public function register_taxonomy()
    {
        // $taxonomy_name = $this->post_type . '-type';
        // $taxonomy_slug = $this->post_type . '-type';
        //
        // register_taxonomy(
        // 	$taxonomy_name,
        // 	$this->post_type,
        // 	array(
        // 		'label' => trans('cpt-testimonial.testimonial-type.label'),
        // 		'public' => true,
        // 		'rewrite' => array( 'slug' => $taxonomy_slug, 'with_front' => false ),
        // 		'hierarchical' => true,
        // 		'show_admin_column' => true,
        // 	)
        // );
    }
}