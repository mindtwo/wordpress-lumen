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
		'all-items' => 'All FAQs',
		'add-new' => 'Add FAQ',
		'add-new-item' => 'Add New FAQ',
		'edit' => 'Edit',
		'edit-item' => 'Edit FAQ',
		'new-item' => 'New FAQ',
		'view-item' => 'View FAQ',
		'search-items' => 'Search FAQ',
		'not-found' =>  'Nothing found in the Database.',
		'not-found-in-trash' => 'Nothing found in Trash',
		'parent-item-colon' => ''
	),
	'description' => 'This is the FAQ',


	/*
	|--------------------------------------------------------------------------
	| Register Custom Post Type Taxonomies
	|--------------------------------------------------------------------------
	*/

	'faq-category' => array(
		'label' => 'FAQ Category',
	)

];

