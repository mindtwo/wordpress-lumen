<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'name' => 'Team',
        'singular-name' => 'Team-Mitglied',
        'all-items' => 'Alle Team-Mitglieder',
        'add-new' => 'Neues Team-Mitglied',
        'add-new-item' => 'Neues Team-Mitglied hinzufügen',
        'edit' => 'Team-Mitglied bearbeiten',
        'edit-item' => 'Team-Mitglied bearbeiten',
        'new-item' => 'Neues Team-Mitglied',
        'view-item' => 'Team-Mitglied ansehen',
        'search-items' => 'Team-Mitglieder durchsuchen',
        'not-found' =>  'Keine Team-Mitglieder in der Datenbank gefunden.',
        'not-found-in-trash' => 'Keine Datensätze im Papierkorb enthalten.',
        'parent-item-colon' => ''
    ),
    'description' => 'Das sind die Team-Mitglieder',


    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */

    'team-category' => array(
        'label' => 'Position',
    )

];

