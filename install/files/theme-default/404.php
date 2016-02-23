<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('custom-templates/404.php.twig', $context);