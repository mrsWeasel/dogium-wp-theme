<?php
/**
 * Register widget areas
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
function foundationpress_sidebar_widgets() {
	register_sidebar(array(
	  'id' => 'blog-sidebar',
	  'name' => __( 'News Page Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));
	register_sidebar(array(
	  'id' => 'events-sidebar',
	  'name' => __( 'Events Home Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));
		register_sidebar(array(
	  'id' => 'events-sidebar-left',
	  'name' => __( 'Events Home Left Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));
	register_sidebar(array(
	  'id' => 'forum-sidebar',
	  'name' => __( 'Forums Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));
	register_sidebar(array(
	  'id' => 'home-left-sidebar',
	  'name' => __( 'Home Left Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'community-sidebar',
	  'name' => __( 'Community Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'community-ads',
	  'name' => __( 'Community Ads', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'marketplace-sidebar',
	  'name' => __( 'Marketplace Sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-1',
	  'name' => __( 'Footer widgets 1', 'dogium' ),
	  'description' => __( 'Drag widgets to this footer container', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-2',
	  'name' => __( 'Footer widgets 2', 'dogium' ),
	  'description' => __( 'Drag widgets to this footer container', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets-3',
	  'name' => __( 'Footer widgets 3', 'dogium' ),
	  'description' => __( 'Drag widgets to this footer container', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));

	register_sidebar(array(
	  'id' => 'search-sidebar',
	  'name' => __( 'Search sidebar', 'dogium' ),
	  'description' => __( 'Drag widgets to this footer container', 'dogium' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	));
}

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;
