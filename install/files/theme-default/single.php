<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('post-types/post-single.php.twig', $context);