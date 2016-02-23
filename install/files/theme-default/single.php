<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['meta'] = (new \WpTheme\PostTypes\Repository\Post())->get_metas(get_the_ID());

// Render default or AJAX view of a post
if(array_key_exists('HTTP_X_CONTENT_ONLY',$_SERVER) && $_SERVER['HTTP_X_CONTENT_ONLY']) {
    Timber::render('post-types/post-single-only-content.php.twig', $context);
} else {
    Timber::render('post-types/post-single.php.twig', $context);
}