<?php

/**
 * Template Name: Contact
 */
$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('custom-templates/contact.php.twig', $context);