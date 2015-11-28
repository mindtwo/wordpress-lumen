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
		'all-items' => 'All Testimonials',
		'add-new' => 'Add Testimonial',
		'add-new-item' => 'Add New Testimonial',
		'edit' => 'Edit',
		'edit-item' => 'Edit Testimonial',
		'new-item' => 'New Testimonial',
		'view-item' => 'View Testimonial',
		'search-items' => 'Search Testimonial',
		'not-found' =>  'Nothing found in the Database.',
		'not-found-in-trash' => 'Nothing found in Trash',
		'parent-item-colon' => ''
	),
	'description' => 'Customers and Partners Testimonial',


	/*
	|--------------------------------------------------------------------------
	| Register Custom Post Type Taxonomies
	|--------------------------------------------------------------------------
	*/

	'testimonial-type' => array(
		'label' => 'Testimonial Type',
	)

];

