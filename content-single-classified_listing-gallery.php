<?php do_action( 'single_classified_listing_gallery_start' ); ?>

<div class="classified_images" itemscope itemtype="http://data-vocabulary.org/Organization">

	<!-- Customized image size (default would be full size) LH -->
	<?php the_classified_featured_image('featured-small'); ?>

</div>

<div class="classified_images_gallery" itemscope itemtype="http://data-vocabulary.org/Organization">
	<?php the_classified_images(); ?>
</div>

<?php do_action( 'single_classified_listing_gallery_end' ); ?>