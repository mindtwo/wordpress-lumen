<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$args = 'post_type=post&numberposts=4&orderby=date';
$context['posts'] = Timber::get_posts($args);
$context['pagination'] = Timber::get_pagination();
Timber::render('post-types/post-list.php.twig', $context);