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
        $output = [];
        $post_id = is_home() ? get_field( 'blog_page_id', 'option' ) : false;
        $data = get_fields($post_id);
        if ( array_key_exists('flexible-content', $data) ) {
            foreach($data['flexible-content'] as $key => $field) {
                switch ( $field['acf_fc_layout'] ) {
                    case 'col_one_content':
                        $output[] = $this->render_view( 'col_one_content.php.twig', ['data'=>$field] );
                        break;
                    case 'col_two_content':
                        $output[] = $this->render_view( 'col_two_content.php.twig', ['data'=>$field] );
                        break;
                    case 'col_three_content':
                        $output[] = $this->render_view( 'col_three_content.php.twig', ['data'=>$field] );
                        break;
                    case 'tab_or_accordion':
                        $output[] = $this->render_view( 'tab_or_accordion.php.twig', ['data'=>$field,'key'=>$key] );
                        break;
                    case 'colored_teaser_centered_content':
                        $output[] = $this->render_view( 'colored_teaser_centered_content.php.twig', ['data'=>$field] );
                        break;
                    case 'shortcode':
                        $output[] = $this->render_view( 'shortcode.php.twig', ['data'=>$field, 'shortcode_content'=>do_shortcode('[' . $field['shortcode'] . ']')] );
                        break;
                    case 'slider':
                        $output[] = $this->render_view( 'slider.php.twig', ['data'=>$field] );
                        break;
                    case 'intro':
                        $output[] = $this->render_view( 'intro.php.twig', ['data'=>$field] );
                        break;
                    case 'seperator':
                        $output[] = $this->render_view( 'seperator.php.twig', ['data'=>$field] );
                        break;
                }
            }
        }

        return implode('',$output);
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