<?php
/**
 * Display BP Notifications in header
 * @author Laura Heino
 * @since 1.0.0
 */


if (! function_exists('dogium_display_unread_notifications')) {
	function dogium_display_unread_notifications() {
		$output = '';
		if ( ! is_user_logged_in() ) {
			// return early if not logged in
			return;
		} else {
			$output .= sprintf('<a class="dogium-notifications" href="%snotifications">', bp_loggedin_user_domain() );
			$output .= sprintf('<img src="%s"/>', get_template_directory_uri() . '/assets/images/icons/notification.png');
			$output .= '<span>' . bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) . '</span>';
			$output .= '</a>';
		}
		echo $output;
	}
}