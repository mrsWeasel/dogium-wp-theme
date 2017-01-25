<?php if ( $contact = get_the_classified_contact_method() ) :
	wp_enqueue_script( 'wp-classified-manager-classified-contact' );
	global $post;
	?>
	<div class="classified_contact contact">
		<?php do_action( 'classified_contact_start', $contact ); ?>

		<div class="contact_details">
			<h2 class="widget-title"><?php esc_html_e('Contact seller', 'dogium'); ?></h2>
			<!-- Get author avatar, name + profile link -->
			<?php 
			$id = get_the_author_meta('ID');
			$display_name = bp_core_get_user_displayname($id);
			$avatar = bp_core_fetch_avatar( array('item_id' => $id) );
			$user_link = bp_core_get_user_domain($id);
			?>
			<div class="seller-profile">
				<a href="<?php echo esc_url( $user_link ); ?>"><?php echo $avatar . ' ' . $display_name;?></a>
			</div>
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
				<input type="submit" class="button secondary" name="submit" value="<?php esc_attr_e('Submit', 'dogium'); ?>"/>
				<?php wp_nonce_field( 'seller-message_' . $post->ID, '_seller-message' ); ?>
				<input type="hidden" name="action" value="seller_message">
				<input type="hidden" name="post_id" value="<?php echo esc_attr($post->ID); ?>">
			</form>

			<button class="close-button" data-close aria-label="<?php esc_attr_e('Close modal', 'dogium');?>" type="button">
			    <span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php do_action( 'classified_contact_end', $contact ); ?>
	</div>
<?php endif; ?>