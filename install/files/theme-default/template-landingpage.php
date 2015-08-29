<?php

/**
 * Template Name: Landingpage
 */
$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('custom-templates/landingpage.php.twig', $context);