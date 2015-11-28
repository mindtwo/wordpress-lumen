<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Custom Post Type
	|--------------------------------------------------------------------------
	*/

	'labels' => array(
		'name' => 'Team',
		'singular-name' => 'Team',
		'all-items' => 'All team members',
		'add-new' => 'Add New',
		'add-new-item' => 'Add New team member',
		'edit' => 'Edit',
		'edit-item' => 'Edit team member',
		'new-item' => 'New team member',
		'view-item' => 'View team member',
		'search-items' => 'Search team member',
		'not-found' =>  'Nothing found in the Database.',
		'not-found-in-trash' => 'Nothing found in Trash',
		'parent-item-colon' => ''
	),
	'description' => 'This is the team member',


	/*
	|--------------------------------------------------------------------------
	| Register Custom Post Type Taxonomies
	|--------------------------------------------------------------------------
	*/

	'team-category' => array(
		'label' => 'Team Category',
	)

];

