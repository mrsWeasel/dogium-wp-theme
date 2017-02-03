<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package Dogium
 * @since Dogium 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Display bp notification count */
require_once( 'library/notifications.php' );

/** Modify BuddyBoss Privacy options */
require_once( 'library/buddyboss-mods.php' );

/** Modify BBPress forum output */
require_once( 'library/bbpress-mods.php' );

/** Geodirectory Cat Listing */
require_once( 'library/geodirectory-mods.php' );

/** Classifieds WP Plugin mods **/
require_once( 'library/classifieds-wp-mods.php' );

/** Custom form for handling classifieds seller messages **/
require_once( 'library/contact-seller-custom-form.php' );

/** Pretty custom excerpt for our blog posts **/
require_once( 'library/excerpt.php' );

/** Template tags for event templates **/
require_once( 'library/events-template-tags.php' );

/** Register event custom fields **/
require_once( 'library/event-custom-fields.php');


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

add_action( 'init', 'blockusers_init' );
function blockusers_init() {
	// 
	if ( is_admin() && ! current_user_can( 'manage_options' ) && ! wp_doing_ajax() && ! dogium_doing_admin_post() ) {
		wp_redirect( home_url() );
		exit;
	}
}

add_filter( 'ajax_query_attachments_args', 'show_users_own_attachments', 1, 1 );
function show_users_own_attachments( $query ) 
{
 $id = get_current_user_id();
 if( !current_user_can('manage_options') )
 $query['author'] = $id;
 return $query;
}

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('manage_options') && !is_admin()) {
	  show_admin_bar(false);
	}
}

// Testing: remove medialibrary tab
function remove_medialibrary_tab($tabs) {
    if ( !current_user_can( 'level_5' ) ) {
        unset($tabs['library']);
    }
    return $tabs;
}
add_filter('media_upload_tabs', 'remove_medialibrary_tab');
//add_filter( 'pre_get_posts' , 'show_more_posts' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );
