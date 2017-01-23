<?php get_header(); ?>
<?php get_template_part( 'template-parts/page-header' ); ?>

<div id="classified-manager-single" <?php classified_listing_class('classified-manager-single'); ?>">
	<div class="row">
		<div class="medium-8 columns">
			<main id="classified-manager-main">
			<?php
		// Start the loop.
			while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_classified_manager_template_part( 'content-single', 'classified_listing' );

			// End of the loop.
			endwhile;
			?>
			</main>
		</div>
		<div class="medium-4 columns">
			<?php get_classified_manager_sidebar(); ?>
		</div>
	</div><!-- .row -->

</div><!-- .content-area -->

<?php get_footer(); ?>
