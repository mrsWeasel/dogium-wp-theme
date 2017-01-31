<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

get_header(); 
get_template_part( 'template-parts/page-header' );?>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'dogium' ); ?></p>
				</div>
				<p><?php _e( 'Please try the following:', 'dogium' ); ?></p>
				<ul>
					<li><?php _e( 'Check your spelling', 'dogium' ); ?></li>
					<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'dogium' ), home_url() ); ?></li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'dogium' ); ?></li>
				</ul>
			</div>
		</article>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
