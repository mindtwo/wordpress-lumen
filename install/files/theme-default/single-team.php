<?php

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['meta'] = (new \WpTheme\PostTypes\Repository\Page())->get_metas(get_the_ID());
Timber::render('post-types/team-single.php.twig', $context);