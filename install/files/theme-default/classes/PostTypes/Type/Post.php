<?php

namespace WpTheme\PostTypes\Type;

use Timber;
use WpTheme\PostTypes\PostType;

class Post extends PostType
{

    /**
     * Register action
     */
    public function register()
    {
        add_action('admin_menu', [$this, 'remove_page_location_field']);
    }

    public function remove_page_location_field()
    {
        remove_meta_box('formatdiv', $this->post_type, 'side');
        remove_meta_box('categorydiv', $this->post_type, 'side');
        remove_meta_box('tagsdiv-post_tag', $this->post_type, 'side');
    }

}