<?php

/**
  * GeoDirectory modifications
  * @since 1.0.0
  * @author Laura Heino
  */


function dogium_add_geodir_listing_button() {
	$output = '';
	$output .= '<div class="large-2 columns"><div style="padding: 5px">';
	$output .= '<a class="button primary hollow float-right" href="http://dogium.com/palvelut/lisaa-palvelu"><i class="fa fa-plus" aria-hidden="true"></i> ';
	$output .= __('Add new listing', 'dogium');
	$output .= '</a></div></div>';
	echo $output;
}

add_action('geodir_after_search_form', 'dogium_add_geodir_listing_button');

function dogium_geodir_list_output() {
	global $geodir_post_category_str, $cat_count;
	$term_icons = geodir_get_term_icon();
	$terms = get_terms(array(
		'taxonomy' => 'gd_placecategory',
		'hide_empty' => false
	));

	if ( !empty($terms) ) {
		echo '<div class="widget widget_categories geodir-custom-cat-list">';
		echo '<h3 class="widget-title">';
		esc_html_e('Place categories', 'dogium');
		echo '</h3>';
		echo '<ul>';
		foreach ($terms as $term) {
			$term_link = get_term_link($term);
			$term_id = $term->term_id;
			$term_count = $term->count;
			?>
			<li><a href="<?php echo esc_url($term_link); ?>"><img src="<?php echo esc_url($term_icons[$term_id]);?>"> <?php echo esc_html($term->name); ?></a></li>
			<?php
		}
		echo '</ul>';
		echo '</div>';
	}
}

add_action('geodir_home_sidebar_left', 'dogium_geodir_list_output', 1);
add_action('geodir_detail_sidebar_inside', 'dogium_geodir_list_output', 1);
add_action('geodir_search_sidebar_right', 'dogium_geodir_list_output', 1);
add_action('geodir_listings_sidebar_right', 'dogium_geodir_list_output', 1);

// remove place details from sidebar
remove_action('geodir_detail_sidebar_inside', 'geodir_details_sidebar_place_details', 10);

// remove listing detail page slider
remove_action( 'geodir_details_main_content','geodir_action_details_slider',30);

// remove listing detail page tabs
remove_action( 'geodir_details_main_content', 'geodir_show_detail_page_tabs',60);

// show additional info for each listing on gridview
add_action('geodir_before_listing_post_excerpt', 'dogium_print_details' );


function dogium_print_details( $echo = true ) {
	global $post;
	$output = array();

	$phone = esc_attr( $post->geodir_contact );
	$address = esc_html( $post->post_address );
	$zip = esc_html( $post->post_zip );
	$city = esc_html( $post->post_city );
	$website = esc_url( $post->geodir_website );

	if ( $address ) {
		$output[] = $address;
	}
	if ( $city && $zip ) {
		$output[] = $zip . ' ' . $city;
	} elseif ( $city ) {
		$output[] = $city;
	} elseif ( $zip ) {
		$output[] = $zip;
	}

	if ( $phone ) {
		$output[] = "<a href='tel:{$phone}'><i class='fa fa-phone' aria-hidden='true'></i> " . $phone . "</a>";
	}

	if ( $website ) {
		$output[] = "<a href='{$website}' target='_blank'>www</a>";
	}

	if ( $echo ) {
		if ( !empty($output) ) {
		echo '<ul class="no-margin geodir-detail-list">';

		foreach($output as $item) {
			echo '<li>' . $item . '</li>';
		}
		echo '</ul>';
		}
	} else {
		// just return the whole array if we choose not to echo
		return $output;
	}

}

// add featured image to listing detail page
add_action( 'geodir_details_main_content','dogium_details',30);

function dogium_details($post) {
	global $post;
	$terms = wp_get_post_terms($post->ID, 'gd_placecategory');
	$term_icons = geodir_get_term_icon();

	if ($terms) {
		echo '<ul class="menu geodir-categories-horizontal-list">';
		foreach ($terms as $term) {
			$term_link = esc_url( $term_icons[$term->term_id] );
			echo "<li><img src='{$term_link}'/> {$term->name}</li>";
		}
		echo '</ul>';
	}

	// Generate output for listing detail page
	ob_start();
	$output = '';
	$output .= '<div class="row collapse">';
	$output .= '<div class="medium-9 columns">';

	$details = dogium_print_details(false);
	if ($details) {
		$output .= '<ul class="geodir-detail-list">';
		foreach ($details as $item) {
			$output .= '<li>' . $item . '</li>';
		}
		$output .= '</ul>';
	}

	$output .= apply_filters('the_content', get_the_content() );
	$output .= '<div class="thumbnail">';
	if ( has_post_thumbnail($post) ) :
		$output .= get_the_post_thumbnail($post, 'featured-small');
	endif;
	$output .= '</div>';
	
	$output .= '</div>';
	$output .= '</div>';
	ob_get_clean();

	echo $output;
	
}
