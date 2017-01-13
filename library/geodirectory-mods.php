<?php

/**
  * GeoDirectory modifications
  * @since 1.0.0
  * @author Laura Heino
  */


function dogium_geodir_list_output() {
	global $geodir_post_category_str, $cat_count;
	$term_icons = geodir_get_term_icon();
	$terms = get_terms(array(
		'taxonomy' => 'gd_placecategory',
		'hide_empty' => false
	));

	if ( !empty($terms) ) {
		foreach ($terms as $term) {
			$term_link = get_term_link($term);
			$term_id = $term->term_id;
			$term_count = $term->count;
			?>
			<li><a href="<?php echo esc_url($term_link); ?>"><img src="<?php echo esc_url($term_icons[$term_id]);?>"> <?php echo esc_html($term->name) . ' (' . $term_count . ')'; ?><a></li>
			<?php
		}
	}
}

add_action('geodir_home_sidebar_left', 'dogium_geodir_list_output', 1);

// remove place details from sidebar
remove_action('geodir_detail_sidebar_inside', 'geodir_details_sidebar_place_details', 10);

// remove listing detail page slider
remove_action( 'geodir_details_main_content','geodir_action_details_slider',30);

// add featured image to listing detail page
add_action( 'geodir_details_main_content','dogium_action_details_slider',30);

function dogium_action_details_slider() {

	if ( has_post_thumbnail() ) : ?>
		<div class="thumbnail">
			<?php the_post_thumbnail('featured-small'); ?>
		</div>
	<?php endif;

	global $post;
	echo 'TESTI!!!';
	echo $post->post_address;
	echo $post->post_zip;
	echo $post->post_city;
	echo $post->geodir_website;
	echo 'TESTI LOPPUU!!!';
}

// remove listing detail page tabs
remove_action( 'geodir_details_main_content', 'geodir_show_detail_page_tabs',60);

// add post content to listing detail page
add_action( 'geodir_details_main_content', 'dogium_show_detail_page_content',60);

function dogium_show_detail_page_content() {
	the_content();
}