<?php

function dogium_the_classified_price( $before = '', $after = '', $echo = true, $post = null ) {
	$classified_price = get_the_classified_price( $post );
	$classified_currency = get_option( 'classified_manager_listing_currency' );

	if ( strlen( $classified_price ) == 0 )
		return;

	$classified_price = esc_attr( strip_tags( $classified_price ) );
	$classified_price = $before . $classified_price . ' ' . $classified_currency . $after;

	if ( $echo )
		echo $classified_price;
	else
		return $classified_price;
}


// Disable 'type' and 'website' from Classifieds form
add_filter( 'submit_classified_form_fields', 'dogium_disable_classifieds_fields' );
function dogium_disable_classifieds_fields( $fields ) {
	unset( $fields['classified']['classified_type'] );
	unset( $fields['classified']['classified_website'] );
	return $fields;
}

// Move item meta AFTER content (instead of before)
add_action( 'single_classified_listing_end', 'classified_listing_meta_display' );
function dogium_remove_classified_listing_meta_display(){
	remove_action( 'single_classified_listing_start', 'classified_listing_meta_display', 30 );
}
add_action( 'single_classified_listing_start', 'dogium_remove_classified_listing_meta_display' );

function dogium_get_classified_featured_image_src() {
	return get_template_directory_uri() . '/assets/images/paw.jpg';
}

add_filter( 'classified_manager_default_classified_featured_image', 'dogium_get_classified_featured_image_src' );

function dogium_get_share_links() {
	echo do_shortcode('[TheChamp-Sharing]');
}

add_action('single_classified_listing_end', 'dogium_get_share_links');