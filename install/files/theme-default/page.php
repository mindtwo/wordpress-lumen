<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('post-types/page-single.php.twig', $context);