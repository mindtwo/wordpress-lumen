<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'all-items' => 'Alle :name',
        'add-new' => 'Anlegen',
        'add-new-item' => 'Neue :name hinzufügen',
        'edit' => 'Bearbeiten',
        'edit-item' => ':name bearbeiten',
        'new-item' => 'Neue/r :name',
        'view-item' => ':name ansehen',
        'search-items' => ':name durchsuchen',
        'not-found' =>  'Es wurde kein Eintrag in der Datenbank gefunden.',
        'not-found-in-trash' => 'Es wurde nichts im Papierkorb gefunden.',
        'parent-item-colon' => 'Entern :name'
    ),
    'description' => 'Website :name',

    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */
    'taxonomy' => array(
        'label' => ':name Kategorie',
    )

];

