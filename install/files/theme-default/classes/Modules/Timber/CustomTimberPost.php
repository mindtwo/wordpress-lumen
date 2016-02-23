<?php

namespace WpTheme\Modules\Timber;

use TimberPost;

class CustomTimberPost extends TimberPost {
    public function __construct( $post_id = null, $post_type = 'post' ) {
        if ( is_string( $post_id ) ) {

            // If $post_id is a string, we'll consider it a slug and try to get the ID
            $args = array(
                'name' => $post_id,
                'post_type' => $post_type, // Because slugs aren't necessarily unique, we'll have to specify post type
                'posts_per_page' => 1,
                'no_found_rows' => true,
            );
            if ( $posts = get_posts( $args ) ) {
                $post = array_shift( $posts );
                $post_id = $post->ID;
            }
        }

        parent::__construct( $post_id );

    }
}