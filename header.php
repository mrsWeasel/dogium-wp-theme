<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-82767459-1', 'auto');
		  ga('send', 'pageview');

		</script>
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
						<p><a href="<?php echo bp_loggedin_user_domain(); ?>"><?php esc_html_e( 'My profile', 'dogium');?></a> | <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php esc_attr_e('Logout', 'dogium'); ?>"><?php esc_html_e('Logout', 'dogium'); ?></a>
						<?php dogium_display_unread_notifications(); ?></p>

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
		<div id="search-container" aria-hidden="true" data-visible="false">
			<?php get_search_form(); ?>
		</div>
	</header>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' );