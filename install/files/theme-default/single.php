<?php

$context = Timber::get_context();
$context['post'] = $post;
$context['has_h1'] = str_contains($context['post']->post_content, '<h1');
$context['thumbnail'] = get_the_post_thumbnail($post_id, 'news-teaser-single');
$context['meta'] = (new \WpTheme\PostTypes\Repository\Post())->get_metas($post_id);

// Render default or AJAX view of a post
if (array_key_exists('HTTP_X_CONTENT_ONLY', $_SERVER) && $_SERVER['HTTP_X_CONTENT_ONLY']) {
    Timber::render('post-types/post-single-only-content.php.twig', $context);
} else {
    Timber::render('post-types/post-single.php.twig', $context);
}