<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

?>

		</section>
		<div id="footer-container">
			<footer id="footer">
				<?php do_action( 'foundationpress_before_footer' ); ?>
				<div class="extended row">
					<div class="large-3 columns">
						<?php dynamic_sidebar( 'footer-widgets-1' ); ?>
					</div>
					<div class="large-3 columns">
						<?php dynamic_sidebar( 'footer-widgets-2' ); ?>
					</div>
					<div class="large-3 columns">
						<?php dynamic_sidebar( 'footer-widgets-3' ); ?>
					</div>
					<div class="large-3 columns">
						<div class="widget">
							<ul class="menu">
							<?php
							if (is_user_logged_in()) : ?>

								<li class="menu-item"><a href="<?php echo esc_url( bp_loggedin_user_domain() ); ?>"><i class="fa fa-user"></i> <?php esc_html_e('My profile', 'dogium'); ?></a></li>
								<li class="menu-item"><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php esc_attr_e('Logout', 'dogium'); ?>"><i class="fa fa-lock"></i> <?php esc_html_e('Logout', 'dogium'); ?></a></li>
							<?php else: ?>
								<li class="menu-item"><a href="<?php echo wp_login_url( get_permalink() ); ?>" title="<?php esc_attr_e('Login', 'dogium'); ?>"><?php esc_html_e('Login', 'dogium')?></a></li>
								<li class="menu-item"><a href="<?php echo wp_registration_url(); ?> " title="<?php esc_attr_e('Register', 'dogium'); ?>"><?php esc_html_e('Register', 'dogium'); ?></a></li>	
	 						<?php endif; ?>
	 						</ul>
 						</div>
					</div>
				</div>
				<?php do_action( 'foundationpress_after_footer' ); ?>
			</footer>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>