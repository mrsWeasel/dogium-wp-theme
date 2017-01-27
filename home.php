<?php
/**
 * The template for blog posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
get_template_part( 'template-parts/page-header' );?>

<div id="page" role="main">
	<article class="main-content">
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php $counter = 0; ?>
		<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			<?php if ( ++$counter % 3 === 0 ) : ?>
				</div>
				<div class="row">
			<?php endif; ?>	
		<?php endwhile; ?>
		</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; // End have_posts() check. ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
		?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php endif; ?>

	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
