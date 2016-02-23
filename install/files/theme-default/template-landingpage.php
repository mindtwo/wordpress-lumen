<?php

/**
 * Template Name: Landingpage
 */
$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['meta'] = (new \WpTheme\PostTypes\Repository\Page())->get_metas(get_the_ID());
Timber::render('custom-templates/landingpage.php.twig', $context);