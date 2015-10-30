<?php

class AjaxActionsModule {


	/**
	 * GlobalAjaxActions constructor.
	 */
	public function __construct() {

		// Register actions
		// add_action( 'wp_ajax_test',             array( $this, 'ajax_load_twint_blog_posts' ) );
		// add_action( 'wp_ajax_nopriv_test',      array( $this, 'ajax_load_twint_blog_posts' ) );

		// register ajax handlers for loading the blog posts (load more)
		add_action( 'wp_ajax_twint_blog_posts', array( $this, 'ajax_load_blog_posts' ) );
		add_action( 'wp_ajax_nopriv_twint_blog_posts', array( $this, 'ajax_load_blog_posts' ) );

	}

	/**
	 * Ajax action to load blog posts action
	 */
	public function ajax_load_blog_posts() {
		// get the parameters
		$page = $_POST['paged'];
		$order = $_POST['order'];
		$orderby = $_POST['orderby'];
		$count = isset($_POST['count']) ? $_POST['count'] : get_option('posts_per_page');
		$cat = $_POST['cat'];

		$args = $this->get_blog_posts_wpquery_args( $page, $order, $orderby, $count, $cat );

		$query = new WP_Query( $args );

		$response = array(
			'result_count' => 0,
			'result_list' => array(),
			'hasmore' => false
		);

		ob_start();

		while ( $query->have_posts() ) {

			$query->the_post();

			// TODO: Load template

		}

		$response['result_count'] = (int) $query->found_posts;
		$response['result_list'] = ob_get_contents();
		$response['hasmore'] = ( $query->max_num_pages == $page ) ? false : true;

		ob_end_clean();

		header( "Content-Type: application/json" );
		echo json_encode( $response );
		exit;
	}


	/**
	 * Ajax action stub
	 *
	 * @return array
	 */
	// public function ajax_test() {
	// }


	/**
	 * Get the blog posts wp_query arguments array
	 *
	 * @param      $page
	 * @param      $order
	 * @param      $orderby
	 * @param      $count
	 * @param      $cat
	 *
	 * @return array
	 */
	private function get_blog_posts_wpquery_args( $page, $order, $orderby, $count, $cat ) {

		// The Query
		$args = array(
			'post_type' => 'post',
			'order' => $order,
			'orderby' => $orderby,
			'posts_per_page' => $count,
			'meta_query' => array(),
			'paged' => $page,
			'post_status' => 'publish'
		);

		// Limit by categories
		if ( !is_null($cat) ) {
			$args['category_name'] = $cat;
		}

		return $args;
	}
}

$ajax_actions_module = new AjaxActionsModule();