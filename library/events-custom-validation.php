<?php

function dogium_validate_em($result, $EM_Event){

if ( !current_user_can('administrator')) {
	// Standard users can only submit group events
	if ( ! isset( $_REQUEST['group_id'] ) || $_REQUEST['group_id'] == '' ) {
	    $EM_Event->add_error( __('You are only allowed to create group events.', 'dogium') );
	    $result = false;
	}

	if ( ! isset ( $_REQUEST['em_tickets'][1]['ticket_type'] ) || $_REQUEST['em_tickets'][1]['ticket_type'] !== 'members' ) {
		$EM_Event->add_error( __('Only members are allowed to attend group events.', 'dogium') );
		$result = false;
	}

	if ( ! isset ( $_REQUEST['em_tickets'][1]['ticket_members_roles'] ) || sizeof( $_REQUEST['em_tickets'][1]['ticket_members_roles'] ) > 1 || $_REQUEST['em_tickets'][1]['ticket_members_roles'][0] !== 'subscriber' ) {
		$EM_Event->add_error( __('Only logged in users are allowed to attend group events.', 'dogium') );
		$result = false;
	}

	/**
	 * @return string
	 */
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
//echo '<pre>';
//print_r($_REQUEST);
//echo '</pre>';
return $result;
}
add_filter('em_event_validate','dogium_validate_em', 1, 2);