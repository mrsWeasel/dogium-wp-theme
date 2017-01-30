<?php

function dogium_excerpt_more( $more ) {
	global $post;
	if ( ! is_home() && ! is_archive() ) {
		// return early if not on home page / archive page
		return $more;
	}

	$permalink = esc_url( get_permalink($post->ID) );

	return sprintf( "<a class='button small dogium-read-more' href='{$permalink}'>%s</a>", __('Read more', 'dogium') );
}

//add_filter('excerpt_more', 'dogium_excerpt_more');

function dogium_excerpt_length( $length ) {
	return 30;
}

add_filter('excerpt_length', 'dogium_excerpt_length', 10);