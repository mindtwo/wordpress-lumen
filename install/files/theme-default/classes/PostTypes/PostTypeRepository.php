<?php

namespace WpTheme\PostTypes;

use Illuminate\Support\Collection;
use Timber;

/**
 * Class PostType
 */
abstract class PostTypeRepository {

    /**
     * Declared in implementation
     *
     * @var string
     */
    protected $post_type = '';

    /**
     * Initialize
     */
    function __construct() {}

    /**
     * @param $args
     *
     * @return array
     */
    public function latest($args=null) {
        $args = array_merge( [
            'tax_query' => false,
            'posts_per_page' => 6,
            'post_type' => $this->post_type,
            'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 )
        ], is_array($args) ? $args : [] );

        // Taxonomy filter
        $args = $this->add_taxonomy_arguments( $args );

        $posts = Timber::get_posts($args);
        $pagination = Timber::get_pagination();
        return compact('posts', 'pagination');
    }

    /**
     * @param $post_id
     *
     * @return Collection
     */
    public function get_metas($post_id) {
        return new Collection(get_fields($post_id));
    }

    /**
     * @param $args
     *
     * @return mixed
     */
    protected function add_taxonomy_arguments( $args ) {

        // Save temporary tax query argument by default
        $taxonomy_query_tmp = $args['tax_query'];

        // Remove tax query by default
        unset($args['tax_query']);

        // Quick return if tax query is no array
        if ( !is_array( $taxonomy_query_tmp ) ) {
            return $args;
        }

        // Loop tax query
        foreach ( $taxonomy_query_tmp as $taxonomy => $slugs ) {
            // Skip interation if $slug is false
            if ( !$slugs ) { continue; }

            // Transform string to array
            if(!is_array($slugs)) {
                $slugs = array_map( 'trim', explode( ',', $slugs ) );
            }

            // Save to result variable
            $result[] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $slugs,
            );
        }

        // Append result to argument list
        if(isset($result)) {
            $args['tax_query'] = $result;
        }

        // Return arguments
        return $args;
    }
}