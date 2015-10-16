<?php

/**
 * Enable SQL Debugmode
 */
if (defined('WP_DEBUG') && WP_DEBUG == true && current_user_can( 'administrator' ) ) {
	add_action('admin_footer', 'my_admin_footer_function');
	function my_admin_footer_function() {
		global $wpdb;
		echo "<div style='margin-left:180px; margin-bottom: 20px; background: #fff;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04); border: 1px solid #e5e5e5;'>";
		echo "<h3 style='border-bottom: 1px solid #e5e5e5; margin: 0; font-size: 14px; padding: 8px 12px;'>SQL Queries (Only in debug mode and WordPress admin accounts)</h3>";
		echo "<pre class='metabox-holder'style='padding: 20px;' >";
		print_r( $wpdb->queries );
		echo "</pre>";
		echo "</div>";
	}
}