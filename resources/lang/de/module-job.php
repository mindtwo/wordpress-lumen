<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'name' => 'Jobs',
        'singular-name' => 'Job',
        'all-items' => 'Alle Jobs',
        'add-new' => 'Neuer Job',
        'add-new-item' => 'Neuen Job hinzufügen',
        'edit' => 'Bearbeiten',
        'edit-item' => 'Job bearbeiten',
        'new-item' => 'Neuer Job',
        'view-item' => 'Job ansehen',
        'search-items' => 'Jobs durchsuchen',
        'not-found' =>  'Keine Jobs in der Datenbank gefunden.',
        'not-found-in-trash' => 'Keine Datensätze im Papierkorb enthalten.',
        'parent-item-colon' => ''
    ),
    'description' => 'Das sind die Jobs',


    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */

    'job-category' => array(
        'label' => 'Job-Kategorie',
    )

];

