<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

if ( ! function_exists( 'foundationpress_scripts' ) ) :
	function foundationpress_scripts() {

	$theme = wp_get_theme();
	$version = $theme->get('Version');	

	// Enqueue the main Stylesheet.
	wp_enqueue_style( 'main-stylesheet', get_template_directory_uri() . '/assets/stylesheets/foundation.css', array(), $version, 'all' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700');
	// If you'd like to cherry-pick the foundation components you need in your project, head over to gulpfile.js and see lines 35-54.
	// It's a good idea to do this, performance-wise. No need to load everything if you're just going to use the grid anyway, you know :)
	if ( is_singular('dogium_dog')) {
		wp_enqueue_script( 'swipebox', get_template_directory_uri() . '/assets/javascript/jquery.swipebox.min.js', array('jquery'), $version, true );
	}
	
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/javascript/foundation.js', array('jquery', 'swipebox'), $version, true );

	// Add the comment-reply library on pages where it is necessary
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}

add_action( 'wp_enqueue_scripts', 'foundationpress_scripts' );
endif;

function dogium_dequeue_bp_styles() {
	wp_dequeue_style( 'bp-legacy-css' );
}

add_action( 'wp_enqueue_scripts', 'dogium_dequeue_bp_styles', 20 );

// disable wp-admin css on front-end acf forms
add_action( 'wp_enqueue_scripts', 'dogium_deregister_styles', 100 );
 

function dogium_deregister_styles() {
  wp_deregister_style( 'wp-admin' );		
}