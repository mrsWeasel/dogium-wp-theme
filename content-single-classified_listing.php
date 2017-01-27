<?php global $post; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="single_classified_listing" itemscope itemtype="http://schema.org/ClassifiedPosting">
		<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />

		<?php if ( get_option( 'classified_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
			<div class="classified-manager-info"><?php _e( 'This listing is not currently active.', 'dogium' ); ?></div>
		<?php else : ?>
			<?php
				/**
				 * single_classified_listing_start hook
				 *
				 * @hooked classified_listing_header_display - 20
				 * @hooked classified_listing_meta_display - 30
				 */
				do_action( 'single_classified_listing_start' );
			?>

			<div class="classified_description" itemprop="description">
				<?php echo apply_filters( 'the_classified_description', get_the_content() ); ?>
			</div>

			<?php
				/**
				 * single_classified_listing_end hook
				 */
				do_action( 'single_classified_listing_end' );
			?>
			<?php 
			$body = sprintf(__('Hello! Thought you might find this item (%s) interesting: %s', 'dogium'), esc_html(get_the_title()), esc_url(get_permalink()) );
			?>
			<p>
			<a href="mailto:?subject=<?php the_title();?>&body=<?php echo $body;?>"><i class="fa fa-send" aria-hidden="true"></i> <?php esc_html_e('Tell a friend', 'dogium'); ?></a>
			&nbsp;
			<a href="#" data-open="flag-as-unappropriate"><i style="color: red" class="fa fa-flag" aria-hidden="true"></i> <?php esc_html_e('Report unappropriate content', 'dogium'); ?></a>
			</p>
			<div class="reveal" id="flag-as-unappropriate" data-reveal>
			<h3><?php esc_html_e('Report unappropriate content', 'dogium'); ?>: <?php echo get_the_title(); ?></h3>
			<?php if (is_user_logged_in()) : ?>
		    <p><?php esc_html_e('Why do you think this item is unappropriate?', 'dogium'); ?></p>
			<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
				<label for="flag-message"><?php esc_html_e('Message (required)', 'dogium'); ?></label>
				<textarea id="flag-message" name="flag-message"></textarea>
				<label for="flag-question"><?php esc_html_e('How much is 1 + 1?', 'dogium'); ?></label>
				<input id="flag-question" name="flag-question" type="text"/>
				<input type="submit" class="button secondary" name="submit" value="<?php esc_attr_e('Submit', 'dogium'); ?>"/>
				<?php wp_nonce_field( 'flag-unappropriate_' . $post->ID, '_flag-unappropriate' ); ?>
				<input type="hidden" name="action" value="flag_unappropriate">
				<input type="hidden" name="post_id" value="<?php echo esc_attr($post->ID); ?>">
			</form>
			<?php else : ?>
				<?php $login_url = wp_login_url( get_permalink() ); ?>
				<?php $register_url = wp_registration_url(); ?>

				<div class="callout warning">
				<p>
				<?php echo sprintf(
				__('This action is for logged in users only. Please <a href="%s">login</a> or <a href="%s">register</a>.', 'dogium'), 
				$login_url,
				$register_url
				); ?>
				</p>
				</div>
			<?php endif; ?>
			<button class="close-button" data-close aria-label="<?php esc_attr_e('Close modal', 'dogium');?>" type="button">
			    <span aria-hidden="true">&times;</span>
			</button>
			</div>
		<?php endif; ?>
	</div>
</article>