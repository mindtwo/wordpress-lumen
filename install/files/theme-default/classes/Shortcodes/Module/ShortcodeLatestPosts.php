<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\PostTypes\Repository\Post;
use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeLatestPosts extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'category' => false,
            'count' => 6,
            'headline' => trans('cpt-testimonial.slider.headline'),
        ), $atts ) );

        $posts = (new Post())->latest(['posts_per_page' => $count, 'tax_query' => ['category'=>$category]])['posts'];
        return $this->render_view( 'partials/shortcode-latest-posts.php.twig', compact( 'headline', 'posts') );
    }

}