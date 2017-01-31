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
add_image_size( 'featured-xsmall', 360, 236, true );
add_image_size( 'featured-small', 620, 472, true );
add_image_size( 'featured-medium', 900, 590, true ); // name, width, height, crop



// Add additional image sizes
add_image_size( 'fp-xsmall', 360 );
add_image_size( 'fp-small', 620 );
add_image_size( 'fp-medium', 900 );

// Register the new image sizes for use in the add media modal in wp-admin
function foundationpress_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'fp-xsmall' => __( 'FP XSmall'),
		'fp-small'  => __( 'FP Small' ),
		'fp-medium' => __( 'FP Medium' ),
	) );
}
add_filter( 'image_size_names_choose', 'foundationpress_custom_sizes' );

// Remove inline width and height attributes for post thumbnails
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
