<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Type
    |--------------------------------------------------------------------------
    */

    'labels' => array(
        'name' => 'Testimonials',
        'singular-name' => 'Testimonial',
        'all-items' => 'Alle Testimonials',
        'add-new' => 'Testimonial hinzufügen',
        'add-new-item' => 'Neues Testimonial hinzufügen',
        'edit' => 'Bearbeiten',
        'edit-item' => 'Testimonial bearbeiten',
        'new-item' => 'Neues Testimonial',
        'view-item' => 'Testimonial ansehen',
        'search-items' => 'Testimonials durchsuchen',
        'not-found' =>  'Keine Team-Mitglieder in der Datenbank gefunden.',
        'not-found-in-trash' => 'Keine Datensätze im Papierkorb enthalten',
        'parent-item-colon' => ''
    ),
    'description' => 'Kunden und Partner Testimonials und Feedback',


    /*
    |--------------------------------------------------------------------------
    | Register Custom Post Type Taxonomies
    |--------------------------------------------------------------------------
    */

    'testimonial-type' => array(
        'label' => 'Testimonial-Kategorie',
    )

];

