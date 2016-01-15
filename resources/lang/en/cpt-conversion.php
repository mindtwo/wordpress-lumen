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
		'all-items' => 'All Conversions',
		'add-new' => 'Add Conversion',
		'add-new-item' => 'Add New Conversion',
		'edit' => 'Edit',
		'edit-item' => 'Edit Conversion',
		'new-item' => 'New Conversion',
		'view-item' => 'View Conversion',
		'search-items' => 'Search Conversion',
		'not-found' =>  'Nothing found in the Database.',
		'not-found-in-trash' => 'Nothing found in Trash',
		'parent-item-colon' => ''
	),
	'description' => 'Website Conversions',


	/*
	|--------------------------------------------------------------------------
	| Register Custom Post Type Taxonomies
	|--------------------------------------------------------------------------
	*/

	'conversion-source' => array(
		'label' => 'Conversion Source',
	)

];

