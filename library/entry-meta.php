<?php
/**
 * Entry meta information for posts
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		global $post;
		$author_id = $post->post_author;
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . get_the_date() . '</time>';
		echo ' | ';
		echo '<span class="byline author">' . get_the_author_meta('display_name', $author_id) . '</span>';
	}
endif;
