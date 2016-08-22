<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['has_h1'] = str_contains($context['post']->post_content, '<h1');
$context['meta'] = (new \WpTheme\PostTypes\Repository\Page())->get_metas(get_the_ID());

if (array_key_exists('HTTP_X_CONTENT_ONLY', $_SERVER) && $_SERVER['HTTP_X_CONTENT_ONLY']) {
    Timber::render('custom-templates/only-content.php.twig', $context);
} else {
    $context['sidebar'] = Timber::get_widgets('subsites');
    Timber::render('post-types/page-single.php.twig', $context);
}