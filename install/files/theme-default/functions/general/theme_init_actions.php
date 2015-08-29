<?php

/**
 * Find and delete the WP default sample page, post and comment
 */
function delete_pages() {
    if ( is_admin() ) {
        $defaultPosts = array( 1,2,3 );
        
        foreach ( $defaultPosts as $post) {
            wp_delete_post( $post );
        }
    }
}
add_action('after_setup_theme', 'delete_pages');

/**
 * Adds pages on theme activation
 */
function create_pages() {
    if ( is_admin() ) {
        $pageTitles = array( 'Home', 'Kontakt' );
        
        foreach ( $pageTitles as $page ) {
            if ( null == get_page_by_title( $page ) ) {
                $newPage = array(
                    'post_title' => $page,
                    'post_content' => '',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                );
                
                $pageID = wp_insert_post( $newPage, $error );
                
                if( $page == 'Kontakt' ) {
                    update_post_meta( $pageID, '_wp_page_template', 'template-contact.php' );
                }
            }
        }
    }
}
add_action('after_setup_theme', 'create_pages');
