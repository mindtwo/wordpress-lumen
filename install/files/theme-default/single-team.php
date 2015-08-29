<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
Timber::render('post-types/team-single.php.twig', $context);