<?php
/**
 * Populate ACF select menu with users friends. Reset co-owners if needed (author change.)
 *
 * @author Laura Heino
 * @since 1.0.0
 *
 */

function dogium_add_dog_select_friends($field) {
	global $post;
	// reset
	$field['choices'] = array();
	$data = array();

	// This will fall back to current user if author is not yet defined (for new posts).
	$author = get_post_field('post_author', $post->ID);
	$friend_ids = friends_get_friend_user_ids($author);
	
	foreach($friend_ids as $friend_id) {

		$user = get_userdata($friend_id);
		$data[] = array('name' => $user->display_name, 'id' => $friend_id, 'email' => $user->user_email);
	}

	// Populate ACF select menu
	if (is_array($data)) {
		foreach($data as $key=>$val) {
			$choice = $val['id'];
			$field['choices'][$choice] = $val['name'] . ' | ' . $val['email'];
		}
	}

	return $field;
}

add_filter('acf/load_field/name=dgm_owners', 'dogium_add_dog_select_friends');

function dogium_changed_dog_owner($post_ID, $post_after, $post_before) {
	// if writer is changed, reset co-owners list
	if ( $post_after->post_author !== $post_before->post_author ) {
			delete_field('dgm_owners', $post_ID);
	} 

}

add_action('post_updated', 'dogium_changed_dog_owner', 10, 3);