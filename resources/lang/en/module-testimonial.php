<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Custom Post Type
	|--------------------------------------------------------------------------
	*/

	'labels' => array(
		'name' => 'Testimonials',
		'singular_name' => 'Testimonial',
		'all_items' => 'All Testimonials',
		'add_new' => 'Add Testimonial',
		'add_new_item' => 'Add New Testimonial',
		'edit' => 'Edit',
		'edit_item' => 'Edit Testimonial',
		'new_item' => 'New Testimonial',
		'view_item' => 'View Testimonial',
		'search_items' => 'Search Testimonial',
		'not_found' =>  'Nothing found in the Database.',
		'not_found_in_trash' => 'Nothing found in Trash',
		'parent_item_colon' => ''
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

