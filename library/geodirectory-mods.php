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
		echo '<div class="widget geodir-custom-cat-list">';
		echo '<h3 class="widget-title">';
		esc_html_e('Place categories', 'dogium');
		echo '</h3>';
		echo '<ul>';
		foreach ($terms as $term) {
			$term_link = get_term_link($term);
			$term_id = $term->term_id;
			$term_count = $term->count;
			?>
			<li><a href="<?php echo esc_url($term_link); ?>"><img src="<?php echo esc_url($term_icons[$term_id]);?>"> <?php echo esc_html($term->name) . ' (' . $term_count . ')'; ?><a></li>
			<?php
		}
		echo '</ul>';
		echo '</div>';
	}
}

add_action('geodir_home_sidebar_left', 'dogium_geodir_list_output', 1);

// remove place details from sidebar
remove_action('geodir_detail_sidebar_inside', 'geodir_details_sidebar_place_details', 10);

// remove listing detail page slider
remove_action( 'geodir_details_main_content','geodir_action_details_slider',30);

// remove listing detail page tabs
remove_action( 'geodir_details_main_content', 'geodir_show_detail_page_tabs',60);

// add featured image to listing detail page
add_action( 'geodir_details_main_content','dogium_details',30);

function dogium_details($post) {
	global $post;
	
	$phone = esc_attr( $post->post_contact );
	$address = esc_html( $post->post_address );
	$zip = $post->post_zip;
	$city = $post->post_city;
	$website = esc_url( $post->geodir_website );

	// Generate output for listing detail page
	ob_start();
	$output = '';
	$output .= '<div class="row collapse">';
	$output .= '<div class="medium-9 columns">';
	$output .= '<div class="thumbnail">';
	if ( has_post_thumbnail($post) ) :
		$output .= get_the_post_thumbnail($post, 'featured-small');
	endif;
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="medium-3 columns">';
	$output .= '<div class="callout">';
	$output .= apply_filters('the_content', get_the_content() );
	$output .= sprintf('<strong>%s</strong>', __('Contact information', 'dogium'));
	$output .= '<ul class="geodir-detail-list">';
	$output .= '' != $phone ? sprintf( '<li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:%s">%s </a></li>', $phone, $phone) : '';
	
	$output .= '' != $address ? sprintf( '<li>%s</li>', $address) : '';
	$output .= '' != $zip ? sprintf( '<li>%s</li>', $zip) : '';
	$output .= '' != $city ? sprintf( '<li>%s</li>', $city) : '';
	$output .= '' != $website ? sprintf( '<li><i class="fa fa-globe" aria-hidden="true"></i> <a href="%s">%s</a></li>', $website, __('Website', 'dogium')) : '';
	$output .= '</ul>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	ob_get_clean();

	echo $output;
	
}
