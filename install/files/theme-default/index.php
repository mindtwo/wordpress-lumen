<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$args = array(
    'posts_per_page' => 6,
    'post_type' => 'post',
    'paged' => (get_query_var('paged') ? get_query_var('paged') : 1)
);
$context['posts'] = Timber::get_posts($args);
$context['pagination'] = Timber::get_pagination();
Timber::render('post-types/post-list.php.twig', $context);