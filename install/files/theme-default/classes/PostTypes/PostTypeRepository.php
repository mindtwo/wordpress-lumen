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
    function __construct() {
    }

    /**
     * @param $args
     *
     * @return array
     */
    public function latest( $args = null ) {
        $args = array_merge( [
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'post_type'      => $this->post_type,
            'paged'          => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 )
        ], is_array( $args ) ? $args : [ ] );

        $posts      = Timber::get_posts( $args );
        query_posts($args);
        $pagination = Timber::get_pagination();

        return compact( 'posts', 'pagination' );
    }

    /**
     * @param $post_id
     *
     * @return Collection
     */
    public function get_metas( $post_id ) {
        return new Collection( get_fields( $post_id ) );
    }
}