<?php
/**
 * @package Dogium
 * @since 1.0
 * @author Laura Heino
 */

function dogium_show_more_events( $query ) {
	if (is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if (is_tax('event-categories')) {
		$query->set('posts_per_page', 50);
		return;
	}
}

add_action('pre_get_posts', 'dogium_show_more_events');