<?php

/*
 * Reorder BuddyPress Tabs and remove / rename some
 * 
 *
 */

if ( ! function_exists('dogium_customize_bp_tabs') ) {
	function dogium_customize_bp_tabs() {
		global $bp;
		// Rename
		buddypress()->members->nav->edit_nav(array(
			'name' => __('My Timeline', 'dogium'),
			'position' => 1,
			), 'just-me', 'activity' );
		buddypress()->members->nav->edit_nav(array(
			'name' => __('Public Wall', 'dogium'),
			'position' => 2,
			), 'friends', 'activity');
	}
}

if ( ! function_exists('dogium_remove_bp_tabs') ) {
	function dogium_remove_bp_tabs() {
		// Remove
		if (! bp_is_user() ) {
			return;
		}
		$hidden_tabs = array(
			'favorites' => 1,
			'mentions' => 1,
			'groups' => 1,
		);

		foreach ( array_keys($hidden_tabs) as $tab ) {
			bp_core_remove_subnav_item('activity', $tab); 
		}
	}
}



add_action('bp_setup_nav', 'dogium_customize_bp_tabs');
add_action('bp_actions', 'dogium_remove_bp_tabs');