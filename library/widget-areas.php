<?php
/**
 * Register widget areas
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
function foundationpress_sidebar_widgets() {
	register_sidebar(array(
	  'id' => 'blog-sidebar',
	  'name' => __( 'News Page Sidebar', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));
	register_sidebar(array(
	  'id' => 'events-sidebar',
	  'name' => __( 'Events Home Sidebar', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));
	register_sidebar(array(
	  'id' => 'home-left-sidebar',
	  'name' => __( 'Home Left Sidebar', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));

	register_sidebar(array(
	  'id' => 'community-sidebar',
	  'name' => __( 'Community Sidebar', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));

	register_sidebar(array(
	  'id' => 'marketplace-sidebar',
	  'name' => __( 'Marketplace Sidebar', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-1',
	  'name' => __( 'Footer widgets 1', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this footer container', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-2',
	  'name' => __( 'Footer widgets 2', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this footer container', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-3',
	  'name' => __( 'Footer widgets 3', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this footer container', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-4',
	  'name' => __( 'Footer widgets 4', 'foundationpress' ),
	  'description' => __( 'Drag widgets to this footer container', 'foundationpress' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));
}

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;
