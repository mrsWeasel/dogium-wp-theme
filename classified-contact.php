<?php if ( $contact = get_the_classified_contact_method() ) :
	wp_enqueue_script( 'wp-classified-manager-classified-contact' );
	global $post;
	print_r($_GET);
	?>
	<div class="classified_contact contact">
		<?php do_action( 'classified_contact_start', $contact ); ?>

		<input type="button" class="contact_button button" value="<?php esc_attr_e( 'Contact Information', 'classifieds-wp' ); ?>" />

		<div class="contact_details">
			<?php
				/**
				 * classified_manager_contact_details_email or classified_manager_contact_details_url hook
				 */
				do_action( 'classified_manager_contact_details_' . $contact->type, $contact );
			?>
			<a class="button secondary round" href="#" data-open="send-message-to-seller"><i class="fa fa-envelope" aria-hidden="true"></i> <?php esc_html_e('Send message', 'dogium'); ?></a>
		</div>
		<div class="reveal" id="send-message-to-seller" data-reveal>
		  <h3><?php esc_html_e('Subject', 'dogium'); ?>: <?php echo get_the_title(); ?></h3>
		  
		<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
			<label for="sender-name"><?php esc_html_e('Your name (required)', 'dogium'); ?></label>
			<input id="sender-name" name="sender-name" type="text"/>
			<label for="sender-email"><?php esc_html_e('Your email (required)', 'dogium'); ?></label>
			<input id="sender-email" name="sender-email" type="email"/>
			<label for="sender-message"><?php esc_html_e('Message (required)', 'dogium'); ?></label>
			<textarea id="sender-message" name="sender-message"></textarea>
			<label for="sender-question"><?php esc_html_e('How much is 1 + 1?', 'dogium'); ?></label>
			<input id="sender-question" name="sender-question" type="text"/>
			<input type="submit" class="button success" name="submit" value="<?php esc_attr_e('Submit', 'dogium'); ?>"/>
			<?php wp_nonce_field( 'seller-message_' . $post->ID, '_seller-message' ); ?>
			<input type="hidden" name="action" value="seller_message">
			<input type="hidden" name="post_id" value="<?php echo esc_attr($post->ID) ?>">
		</form>

		  <button class="close-button" data-close aria-label="Close modal" type="button">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php do_action( 'classified_contact_end', $contact ); ?>
	</div>
<?php endif; ?>