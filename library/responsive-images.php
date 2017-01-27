<?php
/**
 * Configure responsive images sizes
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 2.6.0
 */

// Add featured image sizes
//
// Sizes are optimized and cropped for landscape aspect ratio
// and optimized for HiDPI displays on 'small' and 'medium' screen sizes.
add_image_size( 'featured-xsmall', 320, 200, true );
add_image_size( 'featured-small', 640, 400, true ); // name, width, height, crop
add_image_size( 'featured-medium', 1280, 600, true );
add_image_size( 'featured-large', 1440, 600, true );
add_image_size( 'featured-xlarge', 1920, 600, true );

// Add additional image sizes
add_image_size( 'fp-xsmall', 320 );
add_image_size( 'fp-small', 640 );
add_image_size( 'fp-medium', 1024 );
add_image_size( 'fp-large', 1200 );
add_image_size( 'fp-xlarge', 1920 );

// Register the new image sizes for use in the add media modal in wp-admin
function foundationpress_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'fp-small'  => __( 'FP Small' ),
		'fp-medium' => __( 'FP Medium' ),
		'fp-large'  => __( 'FP Large' ),
		'fp-xlarge'  => __( 'FP XLarge' ),
	) );
}
add_filter( 'image_size_names_choose', 'foundationpress_custom_sizes' );

// Remove inline width and height attributes for post thumbnails
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
