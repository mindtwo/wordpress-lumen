<?php

/**
 * Custom Post Type
 */
function custom_post_team() {
    register_post_type( 'team', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        // let's now add all the options for this post type
        array('labels' => array(
            'name' => 'Team', /* This is the Title of the Group */
            'singular_name' => 'Team', /* This is the individual type */
            'all_items' => 'All team members', /* the all items menu item */
            'add_new' => 'Add New', /* The add new menu item */
            'add_new_item' => 'Add New team member', /* Add New Display Title */
            'edit' => 'Edit', /* Edit Dialog */
            'edit_item' => 'Edit team member', /* Edit Display Title */
            'new_item' => 'New team member', /* New Display Title */
            'view_item' => 'View team member', /* View Display Title */
            'search_items' => 'Search team member', /* Search Custom Type Title */
            'not_found' =>  'Nothing found in the Database.', /* This displays if there are no entries yet */
            'not_found_in_trash' => 'Nothing found in Trash', /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ), /* end of arrays */
              'description' => 'This is the team member', /* Custom Type Description */
              'public' => true,
              'publicly_queryable' => true,
              'exclude_from_search' => false,
              'show_ui' => true,
              'query_var' => true,
              'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
              'menu_icon' =>'dashicons-businessman', /* the icon for the custom post type menu */
              'rewrite' => array( 'slug' => 'team', 'with_front' => false ), /* you can specify its url slug */
              'has_archive' => 'custom_type', /* you can rename the slug here */
              'capability_type' => 'page',
              'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
              'supports' => array( 'title', 'editor', 'thumbnail', 'sticky')
        ) /* end of options */
    ); /* end of register post type */
}
add_action( 'init', 'custom_post_team');

