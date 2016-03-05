<?php

namespace WpTheme\Routes\Directive;

use WpTheme\Routes\RouteDirective;

class LocationPost extends RouteDirective {

    public function handle() {
        add_rewrite_rule(
            'location\/blog\/(.+[^/])',
            'index.php?pagename=blog&name=$matches[1]',
            'top'
        );

        // $this->flush_rules();
    }
}