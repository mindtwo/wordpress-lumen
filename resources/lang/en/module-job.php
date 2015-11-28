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
		'all-items' => 'All Job',
		'add-new' => 'Add New',
		'add-new-item' => 'Add New Job',
		'edit' => 'Edit',
		'edit-item' => 'Edit Job',
		'new-item' => 'New Job',
		'view-item' => 'View Job',
		'search-items' => 'Search Job',
		'not-found' =>  'Nothing found in the Database.',
		'not-found-in-trash' => 'Nothing found in Trash',
		'parent-item-colon' => ''
	),
	'description' => 'This is the Job',

	
	/*
	|--------------------------------------------------------------------------
	| Register Custom Post Type Taxonomies
	|--------------------------------------------------------------------------
	*/

	'job-category' => array(
		'label' => 'Job Category',
	)

];

