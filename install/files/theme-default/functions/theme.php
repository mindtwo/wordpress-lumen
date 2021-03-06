<?php

function get_theme_assets_path()
{
    return THEME_ASSETS_LIVE;
}

function theme_css_path()
{
    echo get_theme_assets_path() . 'css/';
}

function theme_js_path()
{
    echo get_theme_assets_path() . 'js/';
}

function theme_images_path($callback = false)
{
    if ($callback) {
        return get_theme_assets_path() . 'images/';;
    }
    echo get_theme_assets_path() . 'images/';
}

function svg_ready()
{
    $detect = app('Agent');

    if ($detect->browser() == 'IE' && $detect->version($detect->browser()) < 9) {
        return false;
    } else {
        return true;
    }
}

function svg_ready_prefix($default = '.jpg')
{
    if (svg_ready()) {
        echo '.svg';
    } else {
        echo $default;
    }
}

function is_mobile()
{
    $detect = app('Agent');
    if ($detect->isMobile()) {
        return true;
    }

    return false;
}

function is_tablet()
{
    $detect = app('Agent');
    if ($detect->isTablet()) {
        return true;
    }

    return false;
}

function mobile_image_prefix()
{
    if (is_mobile()) {
        return '-mobile';
    } else {
        return '';
    }
}

function get_esc_permalink()
{
    return esc_url(get_permalink());
}

function theme_comment()
{
    $config = app('config');
    return $config->get('comment.default');
}

function primary_menu()
{
    $name = 'menu-main';

    ob_start();
    wp_nav_menu(array(
        'theme_location' => $name,
        'container' => false,
        'depth' => 2,
        'container_id' => '',
        'container_class' => '',
        'menu_class' => 'nav nav-pills',
        'items_wrap' => '<ul id="primary_menu" class="%1$s %2$s">%3$s</ul>',
        'fallback_cb' => '\WpTheme\Modules\Navigation\WalkerCustomTheme()::fallback',
        'walker' => new \WpTheme\Modules\Navigation\WalkerCustomTheme()
    ));
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function footer_menu($name = 'menu-footer')
{
    ob_start();
    if (has_nav_menu($name)) {
        wp_nav_menu(array(
            'theme_location' => $name,
            'container' => 'nav',
            'container_class' => '',
            'depth' => 1,
            'link_before' => '',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'fallback_cb' => '\WpTheme\Modules\Navigation\WalkerCustomTheme::fallback',
            'walker' => new \WpTheme\Modules\Navigation\WalkerCustomTheme()
        ));
    }
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

// Load is_home() Blog Frontpage postdata
function get_home_pagedata()
{
    // Get "Blog Page ID"
    $page_id = get_option('page_for_posts');

    // Get Post
    $page = get_post($page_id);

    // Return Resultset
    return array(
        'this' => $page,
        'id' => $page_id,
        'title' => $page->post_title,
        'content' => apply_filters('the_content', $page->post_content),
    );
}

function throw_404()
{
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
    include THEME_DIR . '/404.php';
    die();
}