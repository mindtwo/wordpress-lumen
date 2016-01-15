<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'name' => 'Lexikon',
        'singular-name' => 'Lexikon-Eintrag',
        'all-items' => 'Alle Lexikon-Einträge',
        'add-new' => 'Neuen Lexikon-Eintrag',
        'add-new-item' => 'Neuen Lexikon-Eintrag hinzufügen',
        'edit' => 'Bearbeiten',
        'edit-item' => 'Lexikon-Eintrag bearbeiten',
        'new-item' => 'Neuer Lexikon-Eintrag',
        'view-item' => 'Lexikon-Eintrag ansehen',
        'search-items' => 'Lexikon-Einträge durchsuchen',
        'not-found' =>  'Keine Lexikon-Einträge in der Datenbank gefunden.',
        'not-found-in-trash' => 'Keine Datensätze im Papierkorb enthalten.',
        'parent-item-colon' => ''
    ),
    'description' => 'Das is das Lexikon',


    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */

    'lexicon-category' => array(
        'label' => 'Lexicon-Kategorie',
    )

];

