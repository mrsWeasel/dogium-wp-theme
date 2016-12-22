<?php

// Dog post type
if ( ! function_exists('dogium_register_dog_post_type') ) {
	function dogium_register_dog_post_type() {
		$labels = array(
			'name' => _x('Dogs', 'post type general name'),
			'singular_name' => _x('Dog', 'post type singular name'),
			'add_new' => _x('Add new', 'dog'),
			'add_new_item' => __('Add new dog', 'dogium'),
			'edit_item' => __('Edit dog', 'dogium'),
			'new_item' => __('New dog', 'dogium'),
			'all_items' => __('All dogs', 'dogium'),
			'view_item' => __('View dog', 'dogium'),
			'search_items' => __('Search dogs', 'dogium'),
			'not_found' => __('No dogs found', 'dogium'),
			'not_found_in_trash' => __('No dogs found in the trash', 'dogium'),
			'parent_item_colon' => '&rarr;',
			'menu_name' => 'Dogs'
		);

		$args = array(
			'labels' => $labels,
			'description' => __('Dogs owned by community members', 'dogium'),
			'public' => true,
			'has_archive' => true,
			'hierarchical' => true,
			'rewrite' => array('slug' => __('dog', 'dogium')),
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments', 'page-attributes'),
	 	);

	 	register_post_type('dogium_dog', $args);

	}
}

// "Breed" custom taxonomy for Dogs
if (! function_exists('dogium_register_breed_taxonomy')) {
	function dogium_register_breed_taxonomy() {
		register_taxonomy(
			'dogium_breed',
			'dogium_dog',
			array(
				'label' => __('Breed', 'dogium'),
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => __('breed', 'dogium'),
				)
			)
		);
	}
}

add_action('init', 'dogium_register_dog_post_type');
add_action('init', 'dogium_register_breed_taxonomy');