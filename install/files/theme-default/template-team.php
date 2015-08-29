<?php

/**
 * Template Name: Team List
 */
$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('post-types/team-list.php.twig', $context);