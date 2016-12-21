<?php

add_filter('rwmb_meta_boxes', 'dogium_dog_meta_boxes');


if ( ! function_exists('dogium_dog_meta_boxes') ) {
	function dogium_dog_meta_boxes( $meta_boxes ) {
		$prefix = 'dgm_';

		/*if ( function_exists('get_current_screen') ) {
			if ('post' == get_current_screen()->base) {
				global $post;
				$post_id = $post->ID;
			}
		} else {
			$post_id = '';
		}*/

		// TEMP
		$post_id = 78;
		

		$author = get_post_field('post_author', $post_id);
		$friend_ids = friends_get_friend_user_ids($author);
		$friend_ids[] = get_current_user_ID();

		$meta_boxes[] = array(
			'title' => __('Dog details', 'dogium'),
			'id' => $prefix . 'details',
			'post_types' => 'dogium-dog',
			'fields' => array(
				array(
				'name' => __('Date of birth', 'dogium'),
				'id' => $prefix . 'date-of-birth',
				'type' => 'date'
				),
				array(
				'name' => __('Gender', 'dogium'),
				'id' => $prefix . 'gender',
				'type' => 'radio',
				'options' => array(
					'male' => __('Male', 'dogium'),
					'female' => __('Female', 'dogium')
					),
				'inline' => false,
				),
				array(
				'name' => __('Owners', 'dogium'),
				'desc' => __('Select owner(s) for this dog.', 'dogium'),
				'id' => $prefix . 'owners',
				'type' => 'user',
				'field_type' => 'checkbox_list',
				'query_args' => array('include'=>$friend_ids),
				)
			),

		);

		return $meta_boxes;
	}

}