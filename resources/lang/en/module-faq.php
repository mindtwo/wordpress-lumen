<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Custom Post Type
	|--------------------------------------------------------------------------
	*/

	'labels' => array(
		'name' => 'Conversions',
		'singular_name' => 'Conversion',
		'all_items' => 'All Conversions',
		'add_new' => 'Add Conversion',
		'add_new_item' => 'Add New Conversion',
		'edit' => 'Edit',
		'edit_item' => 'Edit Conversion',
		'new_item' => 'New Conversion',
		'view_item' => 'View Conversion',
		'search_items' => 'Search Conversion',
		'not_found' =>  'Nothing found in the Database.',
		'not_found_in_trash' => 'Nothing found in Trash',
		'parent_item_colon' => ''
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

