<?php
/**
 * The template for displaying search results pages.
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

get_header(); 
get_template_part( 'template-parts/page-header-thin' );?>
<div id="page-full-width">
	<div class="row">
		<div class="large-9 columns" role="main">
		<header>
	      <h1 class="entry-title"><?php echo sprintf(esc_html__('Search results for "%s"', 'dogium'), get_search_query() ); ?></h1>
	    </header>

		<?php do_action( 'foundationpress_before_content' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif;?>

		<?php do_action( 'foundationpress_before_pagination' ); ?>

		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
		?>

			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'dogium' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'dogium' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php do_action( 'foundationpress_after_content' ); ?>

		</div>
		<div class="large-3 columns">
			<?php dynamic_sidebar('search-sidebar'); ?>	
		</div>
	</div>
</div>
<?php get_footer();
