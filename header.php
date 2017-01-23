<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div id="login-bar">
			<div class="row">
				<div class="small-12 columns">
					<?php if (! is_user_logged_in()) : ?>
					<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="<?php esc_attr_e('Login', 'dogium'); ?>"><?php esc_html_e('Login', 'dogium')?></a>
					| <a href="<?php echo wp_registration_url(); ?> " title="<?php esc_attr_e('Register', 'dogium'); ?>"><?php esc_html_e('Register', 'dogium'); ?></a>
					<?php else : ?>
						<p><?php esc_html_e('Logged in as', 'dogium'); ?> <a href="<?php echo bp_loggedin_user_domain(); ?>"><?php echo bp_core_get_user_displayname( get_current_user_id() ); ?></a>. <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php esc_attr_e('Logout', 'dogium'); ?>"><?php esc_html_e('Logout?', 'dogium'); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="title-bar" data-responsive-toggle="site-navigation">
			<button class="menu-icon" type="button" data-toggle="mobile-menu"></button>
			<div class="title-bar-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/dogium-logo.png';?>"/>
				</a>
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/dogium-logo.png';?>" alt="Dogium"/>
				</a>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>
				<button id="search-toggle" role="button">
					<i class="fa fa-search"></i>
				</button>
				<?php dogium_display_unread_notifications(); ?>
				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
	</header>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' );