<?php

function dogium_add_dog_select_friends($field) {
	global $post;
	// reset
	$field['choices'] = array();
	$data = array();

	// this will fall back to current user if author is not yet defined -LH
	$author = get_post_field('post_author', $post->ID);
	$friend_ids = friends_get_friend_user_ids($author);
	
	foreach($friend_ids as $friend_id) {

		$user = get_userdata($friend_id);
		$data[] = array('name' => $user->display_name, 'id' => $friend_id, 'email' => $user->user_email);
	}


	if (is_array($data)) {
		foreach($data as $key=>$val) {
			$choice = $val['id'];
			$field['choices'][$choice] = $val['name'] . ' | ' . $val['email'];
		}
	}

	return $field;
}

add_filter('acf/load_field/name=dgm_owners', 'dogium_add_dog_select_friends');