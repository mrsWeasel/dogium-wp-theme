<?php if ( is_active_sidebar( 'classified-manager-sidebar-single' )  ) : ?>

	<aside id="classified-manager-single-sidebar-secondary" role="complementary">
		<!-- Our own price formatting function (append € instead of prepending) LH -->
		<?php dogium_the_classified_price('<span class="classified-price">', '</span>'); ?>
		<?php if ( users_can_contact() ) : ?>
		<?php get_classified_manager_template( 'classified-contact.php' ); ?>
		<?php endif; ?>

		<!-- Get author avatar, name + profile link -->
		<?php 
		$id = get_the_author_meta('ID');
		$display_name = bp_core_get_user_displayname($id);
		$avatar = bp_core_fetch_avatar( array('item_id' => $id) );
		$user_link = bp_core_get_user_domain($id);
		?>

		<div class="contact-details">
			<a href="<?php echo esc_url( $user_link ); ?>"><?php echo $avatar . ' ' . $display_name;?></a>
		</div>

		<?php dynamic_sidebar('classified-manager-sidebar-single'); ?>
	</aside><!-- .sidebar .widget-area -->

<?php endif; ?>