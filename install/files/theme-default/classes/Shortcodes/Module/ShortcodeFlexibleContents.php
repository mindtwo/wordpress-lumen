<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeFlexibleContents extends ShortcodeModule {

    /**
     * Register acf flexible contents
     *
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        $output = '';

        if ( is_home() ) {
            $post_id = get_field( 'blog_page_id', 'option' );
        } else {
            $post_id = false;
        }

        if ( have_rows( 'flexible-content', $post_id ) ) {
            while ( have_rows( "flexible-content", $post_id ) ) : the_row();
                switch ( get_row_layout() ) {
                    case 'col_three_content':
                        $output = $this->render_view( 'col_one_content.php.twig' );
                        break;
                    case 'col_two_content':
                        $output = $this->render_view( 'col_three_content.php.twig' );
                        break;
                    case 'col_one_content':
                        $output = $this->render_view( 'col_two_content.php.twig' );
                        break;
                    case 'shortcode':
                        $output = $this->render_view( 'seperator.php.twig' );
                        break;
                    case 'slider':
                        $output = $this->render_view( 'shortcode.php.twig' );
                        break;
                    case 'intro':
                        $output = $this->render_view( 'intro.php.twig' );
                        break;
                    case 'seperator':
                        $output = $this->render_view( 'slider.php.twig' );
                        break;
                }
            endwhile;
        }

        return $output;
    }

    /**
     * Render view
     *
     * @param      $view
     * @param null $data
     *
     * @return mixed
     */
    protected function render_view( $view, $data = null ) {
        return parent::render_view( 'flexible-contents/' . $view, $data, false );
    }
}