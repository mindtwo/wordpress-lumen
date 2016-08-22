<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['has_h1'] = str_contains($context['post']->post_content, '<h1');
$context['meta'] = (new \WpTheme\PostTypes\Repository\Page())->get_metas(get_the_ID());
Timber::render('post-types/team-single.php.twig', $context);