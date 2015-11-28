<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Custom Post Type
	|--------------------------------------------------------------------------
	*/

	'labels' => array(
		'name' => 'Conversions',
		'singular-name' => 'Conversion',
		'all-items' => 'Alle Conversions',
		'add-new' => 'Conversion anlegen',
		'add-new-item' => 'Neue Conversion hinzufügen',
		'edit' => 'Bearbeiten',
		'edit-item' => 'Conversion bearbeiten',
		'new-item' => 'Neue Conversion',
		'view-item' => 'Conversion ansehen',
		'search-items' => 'Conversions durchsuchen',
		'not-found' =>  'Es wurde kein Eintrag in der Datenbank gefunden.',
		'not-found-in-trash' => 'Es wurde nichts im Papierkorb gefunden.',
		'parent-item-colon' => ''
	),
	'description' => 'Website Conversions',

	/*
	|--------------------------------------------------------------------------
	| Register Custom Post Type Taxonomies
	|--------------------------------------------------------------------------
	*/
	'conversion-source' => array(
		'label' => 'Conversion Quelle',
	)

];

