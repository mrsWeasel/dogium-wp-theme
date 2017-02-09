<?php

function dogium_validate_em($result, $EM_Event){

if ( !is_admin() && !current_user_can('administrator')) {
	// Standard users can only submit group events
	if ( ! isset( $_REQUEST['group_id'] ) || $_REQUEST['group_id'] == '' ) {
	    $EM_Event->add_error( __('You are only allowed to create group events.', 'dogium') );
	    $result = false;
	}

	$allowed_category = get_term_by('slug', 'ryhmatapahtuma', 'event-categories')->term_id;


	if ( ! isset ( $_REQUEST['event_categories']) ) {
		$EM_Event->add_error( __('Category is required.', 'dogium') );
		$result = false;
	} else {
		$categories = $_REQUEST['event_categories'];
		if ( sizeof( $categories ) > 1 ) {
			$EM_Event->add_error( __('Only a single category is allowed.', 'dogium') );
			$result = false;
		}
		/**
		 * @var $categories | array of strings
		 * @var $allowed_category | int
		 */
		if ( $categories[0] !== strval( $allowed_category ) ) {
			$EM_Event->add_error( __('You must use the correct category for group events.', 'dogium') );
			$result = false;
		}	
	}
}

return $result;
}
add_filter('em_event_validate','dogium_validate_em', 1, 2);