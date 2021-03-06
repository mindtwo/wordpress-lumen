<?php

namespace WpTheme\PostTypes\Type;

use WpTheme\PostTypes\CustomPostType;

class Job extends CustomPostType
{

    public function register()
    {
        parent::register();
        $this->name = 'Jobs';
        $this->singular_name = 'Job';
    }

    /**
     * Custom Post Type
     * http://codex.wordpress.org/Function_Reference/register_post_type
     */
    public function register_post_type()
    {
        $custom_params = [
            'menu_icon' => 'dashicons-id', // Select an icon: https://developer.wordpress.org/resource/dashicons/
            'rewrite' => array('slug' => 'team', 'with_front' => false),
            'supports' => array('title', 'editor', 'thumbnail', 'sticky'),
        ];

        register_post_type($this->post_type, array_merge($this->post_type_params, $custom_params));
    }


    /**
     * Register Custom Post Type Taxonomies
     */
    public function register_taxonomy()
    {
        $taxonomy_name = $this->post_type . '-category';
        $taxonomy_slug = $this->post_type . '-category';

        register_taxonomy(
            $taxonomy_name,
            $this->post_type,
            array(
                'label' => trans('cpt-job.job-category.label'),
                'public' => true,
                'rewrite' => array('slug' => $taxonomy_slug, 'with_front' => false),
                'hierarchical' => false,
            )
        );
    }
}