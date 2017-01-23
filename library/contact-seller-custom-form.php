<?php
/**
 * Custom form for contacting the author of a classified
 * @author Laura Heino
 * @since 1.0.0
 */

class DogiumContactSellerForm {

	public function __construct() {
		add_action('admin_post_nopriv_seller_message', array($this, 'seller_form_handler'));
		add_action('admin_post_seller_message', array($this, 'seller_form_handler'));
	}

	function seller_form_handler() {
		$post_id = $_POST['post_id'];
		$post = get_post($post_id);
		// Todo: nonce checking
		// We need post author as recipient...
		$author = $post->post_author;
		$author_email = get_the_author_meta('user_email', $author);
		$subject = $post->post_title;
		$sender_name = $_POST['sender-name'];
		$sender_email = $_POST['sender-email'];
		$message = $_POST['seller_message'];
		
		// Todo: validate this crap
		wp_mail( $author_email, $subject, $message);
		//wp_redirect( home_url() );
		print_r($_POST);
		echo $author_email;
		echo $subject;
		//exit;
	}

}

new DogiumContactSellerForm;
