<?php if ( is_active_sidebar( 'classified-manager-sidebar-single' )  ) : ?>

	<aside id="classified-manager-single-sidebar-secondary" role="complementary">
		<!-- Our own price formatting function (append € instead of prepending) LH -->
		<?php dogium_the_classified_price('<div class="main-price classified-price">', '</div>'); ?>


		<?php if ( users_can_contact() ) : ?>
		<?php get_classified_manager_template( 'classified-contact.php' ); ?>
		<?php endif; ?>

		<?php dynamic_sidebar('classified-manager-sidebar-single'); ?>
	</aside><!-- .sidebar .widget-area -->

<?php endif; ?>