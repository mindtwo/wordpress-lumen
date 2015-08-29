<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('custom-templates/search.php.twig', $context);