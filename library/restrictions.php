<?php
/**
 * @package Dogium
 * @since 1.0.2
 * @author Laura Heino
 */

function dogium_doing_admin_post() {
	/**
	  * @param array | $output | Initialize empty output array for our regex pattern
	  * @param string | $requerst_uri
	  * @return bool | True if request made to admin-post.php, false otherwise
	  */
	$output = array();
	$request_uri = $_SERVER['REQUEST_URI'];
	preg_match( "/[\/\-a-zA-Z0-0]*wp-admin\/admin-post.php(\/)?$/", $request_uri, $output );
	if (!empty($output) && $output[0] !== '') {
		return true;
	} else {
		return false;
	}
}

add_action( 'init', 'dogium_block_users_from_admin' );

function dogium_block_users_from_admin() {
	// We do not wish to block access to wp-admin if user hasn't even logged in yet
	if (!is_user_logged_in()) {
		return;
	}
	// Redirect basic users from admin area
	// wp_doing_ajax() works from version 4.7 - we should not need support for legacy WP versions.
	if ( is_admin() && ! current_user_can( 'manage_options' ) && ! wp_doing_ajax() && ! dogium_doing_admin_post() ) {
		wp_redirect( home_url() );
		exit;
	}
}


add_filter( 'ajax_query_attachments_args', 'dogium_show_users_own_attachments', 1, 1 );

function dogium_show_users_own_attachments( $query ) {
	// Only allow viewing OWN items in medialibrary
	 $id = get_current_user_id();
	 if( !current_user_can('manage_options') )
	 $query['author'] = $id;
	 return $query;
}

add_action('after_setup_theme', 'dogium_remove_admin_bar');

function dogium_remove_admin_bar() {
	if (!current_user_can('manage_options') && !is_admin()) {
	  show_admin_bar(false);
	}
}