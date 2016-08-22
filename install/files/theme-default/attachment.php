<?php

/**
 * Redirect attachment pages to parent post or to homepage
 */
if ($post->post_parent) {
    $page_data = get_page($post->post_parent);
    if ($page_data->post_status == 'publish') {
        wp_redirect(get_permalink($post->post_parent), 301);
        exit;
    } else {
        wp_redirect(get_home_url(), 301);
        exit;
    }
} else {
    wp_redirect(get_home_url(), 301);
    exit;
}