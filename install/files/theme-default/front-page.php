<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('custom-templates/front-page.php.twig', $context);