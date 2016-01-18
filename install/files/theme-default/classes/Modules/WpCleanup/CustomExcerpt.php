<?php

namespace WpTheme\Modules\WpCleanup;

class CustomExcerpt {

    /**
     * Initialize
     */
    public function __construct() {
        add_filter( 'excerpt_more', [$this, 'remove_ellipsis_brackets'] );
        add_filter( 'excerpt_length', [$this, 'custom_excerpt_length'], 999 );
        add_filter( 'the_excerpt', [$this, 'remove_shortcodes'] );
    }

    /**
     * Change […] to … in the_excerpt()
     */
    public function remove_ellipsis_brackets( $more ) {
        global $post;
        return;
    }

    /**
     * Change the_excerpt() lenght
     */
    public function custom_excerpt_length( $length ) {
        return 80;
    }

    /**
     * Remove shortcodes from excerpt and excerpt-RSS
     */
    public function remove_shortcodes( $content ) {
        $content = strip_shortcodes( $content );
        return $content;
    }

}