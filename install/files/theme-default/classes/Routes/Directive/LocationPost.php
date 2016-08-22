<?php

namespace WpTheme\Routes\Directive;

use WpTheme\Routes\RouteDirective;

class LocationPost extends RouteDirective
{

    public function register()
    {
        add_action('init', array($this, 'handle'));
        add_action('template_redirect', array($this, 'url_rewrite_templates'));
    }

    public function handle()
    {
        add_rewrite_tag('%location%', '([^&]+)');
        add_rewrite_rule(
            '(.+[^/])\/blog\/(.+[^/])',
            'index.php?post_type=post&location=$matches[1]&name=$matches[2]',
            'top'
        );
        // $this->flush_rules();
    }

    public function url_rewrite_templates()
    {
        if (get_query_var('location') && get_query_var('post_type') == 'post') {
            add_filter('template_include', function () {
                return get_template_directory() . '/single.php';
            });
        }
    }

}