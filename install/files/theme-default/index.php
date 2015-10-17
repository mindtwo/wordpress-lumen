<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$args = 'post_type=post&numberposts=8&orderby=date';
$context['posts'] = Timber::get_posts($args);
Timber::render('post-types/post-list.php.twig', $context);