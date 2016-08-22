<?php

/**
 * Template Name: Blog
 */
$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['has_h1'] = str_contains($context['post']->post_content, '<h1');
$context['thumbnail'] = get_the_post_thumbnail('news-teaser-single');
$latest = (new \WpTheme\PostTypes\Repository\Post())->latest();
Timber::render('post-types/post-list.php.twig', array_merge($context, $latest));