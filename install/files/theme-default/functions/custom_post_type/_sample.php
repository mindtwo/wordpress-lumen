<?php
    
/**
 * Custom Post Type
 */
function custom_post_example() {
    register_post_type( 'custom_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
         // let's now add all the options for this post type
        array('labels' => array(
                'name' => '', /* This is the Title of the Group */
                'singular_name' => '', /* This is the individual type */
                'all_items' => 'Alle ', /* the all items menu item */
                'add_new' => 'Neu hinzufügen', /* The add new menu item */
                'add_new_item' => ' hinzufügen', /* Add New Display Title */
                'edit' => 'Bearbeiten', /* Edit Dialog */
                'edit_item' => '', /* Edit Display Title */
                'new_item' => '', /* New Display Title */
                'view_item' => ' ansehen', /* View Display Title */
                'search_items' => ' durchsuchen', /* Search Custom Type Title */
                'not_found' =>  '', /* This displays if there are no entries yet */
                'not_found_in_trash' => '', /* This displays if there is nothing in the trash */
                'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => '', /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon' => '', /* https://developer.wordpress.org/resource/dashicons/#album */
            'rewrite' => array( 'slug' => '', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => '', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
         ) /* end of options */
    ); /* end of register post type */

    /* this adds your post categories to your custom post type */
    register_taxonomy_for_object_type('category', 'custom_type');
    /* this adds your post tags to your custom post type */
    register_taxonomy_for_object_type('post_tag', 'custom_type');

}
//add_action( 'init', 'custom_post_example');

/**
 * for more information on taxonomies, go here:
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

// now let's add custom categories (these act like categories)
register_taxonomy( 'custom_cat',
    array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    array('hierarchical' => true,     /* if this is true, it acts like categories */
        'labels' => array(
            'name' => '', /* name of the custom taxonomy */
            'singular_name' => '', /* single taxonomy name */
            'search_items' =>  ' durchsuchen', /* search title for taxomony */
            'all_items' => 'Alle ', /* all title for taxonomies */
            'parent_item' => '', /* parent title for taxonomy */
            'parent_item_colon' => '', /* parent taxonomy title */
            'edit_item' => '', /* edit custom taxonomy title */
            'update_item' => ' aktualisieren', /* update title for taxonomy */
            'add_new_item' => '', /* add new title for taxonomy */
            'new_item_name' => '' /* name title for taxonomy */
        ),
        'show_admin_column' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => '' ),
    )
);

// now let's add custom tags (these act like categories)
register_taxonomy( 'custom_tag',
    array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    array('hierarchical' => false,    /* if this is false, it acts like tags */
        'labels' => array(
            'name' => '', /* name of the custom taxonomy */
            'singular_name' => '', /* single taxonomy name */
            'search_items' =>  ' durchsuchen', /* search title for taxomony */
            'all_items' => 'Alle ', /* all title for taxonomies */
            'parent_item' => '', /* parent title for taxonomy */
            'parent_item_colon' => '', /* parent taxonomy title */
            'edit_item' => '', /* edit custom taxonomy title */
            'update_item' => ' aktualisieren', /* update title for taxonomy */
            'add_new_item' => '', /* add new title for taxonomy */
            'new_item_name' => '' /* name title for taxonomy */
        ),
        'show_admin_column' => true,
        'show_ui' => true,
        'query_var' => true,
    )
);