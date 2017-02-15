<?php
/**
 * Custom form for contacting the author of a classified
 * @author Laura Heino
 * @since 1.0.0
 */

class DogiumClassifiedForms {

	public function __construct() {
		// Allow posting to item author for both logged in / not logged in users
		add_action('admin_post_nopriv_seller_message', array($this, 'seller_form_handler'));
		add_action('admin_post_seller_message', array($this, 'seller_form_handler'));
		add_action('admin_post_flag_unappropriate', array($this, 'flag_unappropriate_ad'));
		add_action('single_classified_listing_start', array($this, 'output_validation_notice'));

	}

	public function flag_unappropriate_ad() {
		// This action is not allowed for non logged in users
		if ( ! is_user_logged_in() ) {
			return;
		}

		$post_id = $_POST['post_id'];

		$nonce = $_REQUEST['_flag-unappropriate'];
		if ( !isset( $nonce ) || ! wp_verify_nonce( $nonce, 'flag-unappropriate_' . $post_id ) ) {
			die( 'Security check failed.' );
		}

		$post_permalink = esc_url( get_permalink($post_id) );
		$redirect = empty($_POST['_wp_http_referer']) ? $post_permalink : $_POST['_wp_http_referer'];

		$validation = array();
		$message = $_POST['flag-message'];
		if ( '' == $message ) {
			$validation['message_error'] = true;
		} else {
			$validation['message_error'] = false;
		}

		$question = $_POST['flag-question'];
		if ($question != 2) {
			$validation['question_error'] = true;
		} else {
			$validation['question_error'] = false;
		}


		if (! $validation['message_error'] && ! $validation['question_error']) {
			$message = esc_html($message);
			$message .= "\n----\n";
			$message .= sprintf( __('Link to the classified ad in question: %s', 'dogium'), $post_permalink );

			wp_mail( 'info@dogium.com', esc_html('Reporting inappropriate item (dogium.com)', 'dogium'), $message);
			$validation['message_sent'] = true;

		} else {
			$validation['message_sent'] = false;
		}	
		$url = add_query_arg($validation, $redirect);
		wp_safe_redirect( $url, 302 );
		exit;
	}

	public function seller_form_handler() {
		$post_id = $_POST['post_id'];
		
		$nonce = $_REQUEST['_seller-message'];
		if ( !isset( $nonce ) || ! wp_verify_nonce( $nonce, 'seller-message_' . $post_id ) ) {
			die( 'Security check failed.' );
		}
		// TODO: Redirect to main classifieds page
		$redirect = empty($_POST['_wp_http_referer']) ? get_permalink($post_id) : $_POST['_wp_http_referer'];

		$post = get_post($post_id);
		// We need post author as recipient...
		$author = $post->post_author;
		$author_email = get_the_author_meta('user_email', $author);

		$validation = array();
		
		// Let's use the classified title as subject line for our email
		$subject = $post->post_title;
		$subject = preg_replace('/[^a-zA-Z0-9-_\.]/','', $subject);
		if ('' == $subject) {
			$validation['subject_error'] = true;
		} else {
			$validation['subject_error'] = false;
		}

		$sender_name = $_POST['sender-name'];
		// Name should not be left empty and there shouldn't be anything else than letters + spaces
		if ( empty($sender_name) || !preg_match("/^[a-zA-Z ]*$/",$sender_name)) {
  			$validation['name_error'] = true; 
		} else {
			$validation['name_error'] = false;
		}

		$sender_email = $_POST["sender-email"];
			if ( empty($sender_email) || !filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
  			$validation['email_error'] = true;
		} else {
			$validation['email_error'] = false;
		}

		$message = $_POST['sender-message'];
		if ( '' == $message ) {
			$validation['message_error'] = true;
		} else {
			$validation['message_error'] = false;
		}

		$question = $_POST['sender-question'];
		if ($question != 2) {
			$validation['question_error'] = true;
		} else {
			$validation['question_error'] = false;
		}


		if ( ! $validation['subject_error'] && ! $validation['name_error'] && ! $validation['email_error'] && ! $validation['message_error'] && ! $validation['question_error'] ) {

			$message = esc_html($message);
			$message .= "\n----\n";
			$message .= sprintf( __('This email was sent from your classified ad "%s" contact form (%s)', 'dogium'), $subject, get_permalink($post_id) );
			$headers = "Reply-To: <{$sender_email}>";

			$validation['message_sent'] = true;

			wp_mail( $author_email, $subject, $message, $headers);
			$url = add_query_arg($validation, $redirect);
			
		} else {
			$validation['message_sent'] = false;
			$url = add_query_arg($validation, $redirect);
		}

		// Redirect back to original location with appropriate url parameters
		wp_safe_redirect( $url, 302 );
		exit;
		
	}

	public function output_validation_notice() {
		if ( empty( $_GET ) ) {
			// Return early if there's nothing to GET
			return;
		}

		$output = '';
		$error_messages = array();
		$error_msg_output = '';

		if ( isset($_GET['message_sent']) && $_GET['message_sent'] ) {
			$output .= __('Message sent!', 'dogium');
			$class_names = 'callout success';
		} else {
			$output .= __('There were errors in the form:', 'dogium');
			$error_messages[] = !empty($_GET['name_error']) ? __('Name is required and only letters and white space characters are allowed.', 'dogium') : '';
			$error_messages[] = !empty($_GET['email_error']) ? __('Email is required and it needs to be a valid email address.', 'dogium') : '';
			$error_messages[] = !empty($_GET['message_error']) ? __('Message field cannot be empty.', 'dogium') : '';

			$error_messages[] = !empty($_GET['question_error']) ? __('You need to answer the math question correctly. This is necessary to avoid spam.', 'dogium') : '';
			
			$class_names = 'callout alert';
		}

		if ( !empty($error_messages) ) {
			$error_msg_output = '<ul>';
			foreach ($error_messages as $error_msg) {
				if ( '' != $error_msg ) {
					$error_msg_output .= '<li>' . $error_msg . '</li>';
				}
			}
			$error_msg_output .= '</ul>';
		}

		echo "<div class='{$class_names}'>{$output}{$error_msg_output}</div>";
	}

}

new DogiumClassifiedForms;
