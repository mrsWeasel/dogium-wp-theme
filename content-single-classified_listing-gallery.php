<?php do_action( 'single_classified_listing_gallery_start' ); ?>

<div class="classified_images" id="featured-classified-image" itemscope itemtype="http://data-vocabulary.org/Organization">

	<!-- Customized image size (default would be full size) LH -->

	<?php the_classified_featured_image('fp-medium-height', false); ?>
	<?php global $post; ?>
	<?php dogium_the_classified_price('<span class="label primary main-price">', '</span>', $post); ?>
</div>

<div class="classified_images_gallery" itemscope itemtype="http://data-vocabulary.org/Organization">
	<?php the_classified_images(0, 'fp-small-height'); ?>
</div>

<?php do_action( 'single_classified_listing_gallery_end' ); ?>