<?php

namespace WpTheme\PostTypes\Type;

use WpTheme\PostTypes\CustomPostType;

class Faq extends CustomPostType
{

    public function register()
    {
        parent::register();
        $this->name = 'FAQs';
        $this->singular_name = 'FAQ';
    }

    /**
     * Custom Post Type
     * http://codex.wordpress.org/Function_Reference/register_post_type
     */
    public function register_post_type()
    {
        $custom_params = [
            'menu_icon' => 'dashicons-editor-help', // Select an icon: https://developer.wordpress.org/resource/dashicons/
            'rewrite' => array('slug' => 'faq', 'with_front' => false),
            'has_archive' => 'custom_type',
            'supports' => array('title', 'editor'),
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
                'label' => trans('cpt-faq.faq-category.label'),
                'public' => true,
                'rewrite' => array('slug' => $taxonomy_slug, 'with_front' => false),
                'hierarchical' => false,
            )
        );
    }
}