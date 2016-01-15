<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'name' => 'FAQ',
        'singular-name' => 'FAQ',
        'all-items' => 'Alle FAQs',
        'add-new' => 'FAQ hinzufügen',
        'add-new-item' => 'Neue FAQ hinzufügen',
        'edit' => 'Bearbeiten',
        'edit-item' => 'FAQ bearbeiten',
        'new-item' => 'Neue FAQ',
        'view-item' => 'FAQ ansehen',
        'search-items' => 'FAQ durchsuchen',
        'not-found' =>  'Keine FAQ in der Datenbank gefunden.',
        'not-found-in-trash' => 'Keine Datensätze im Papierkorb enthalten.',
        'parent-item-colon' => ''
    ),
    'description' => 'Das sind die FAQ',


    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */

    'faq-category' => array(
        'label' => 'FAQ-Kategorie',
    )

];

