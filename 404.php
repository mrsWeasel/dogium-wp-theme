<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

get_header(); 
get_template_part( 'template-parts/page-header-thin' );?>

<div class="row">
	<div class="small-12 large-8 large-centered columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1><?php esc_html_e('Page not found', 'dogium'); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'dogium' ); ?></p>
				</div>
				<div>
					<?php
					$dogium_404_query = new WP_Query('pagename=404-dogium');
					while ( $dogium_404_query->have_posts() ) : $dogium_404_query->the_post();
						the_content();
					endwhile;
					// This might not be necessary as we do not have another loop here 
					// but doesn't hurt to have it
					wp_reset_postdata();
					?>
				</div>
			</div>
		</article>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
