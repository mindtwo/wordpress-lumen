<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'name' => ':name',
        'singular-name' => ':name',
        'all-items' => 'All :name',
        'add-new' => 'Add :name',
        'add-new-item' => 'Add New :name',
        'edit' => 'Edit :name',
        'edit-item' => 'Edit :name',
        'new-item' => 'New :name',
        'view-item' => 'View :name',
        'search-items' => 'Search :name',
        'not-found' =>  'Nothing found in the Database.',
        'not-found-in-trash' => 'Nothing found in Trash',
        'parent-item-colon' => 'Parent :name'
    ),
    'description' => 'Website :name',

    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */
    'taxonomy' => array(
        'label' => ':name Category',
    )

];

