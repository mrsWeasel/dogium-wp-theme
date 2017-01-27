<li <?php classified_listing_class(); ?>>
	<a href="<?php the_classified_permalink(); ?>">
		<div class="media-object">
			<div class="media-object-section">
				<div class="thumbnail">
				<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail( array(80,50,true) ); ?>
				<?php else : ?>
						<img src="<?php echo get_template_directory_uri() . '/assets/images/paw_80x50.jpg';?>"/>
				<?php endif; ?>
				</div>
			</div>
			<div class="media-object-section">
				<div class="classified-title">
					<h3><?php the_title(); ?></h3>
				</div>
				<ul class="meta">
					<li class="classified-location"><?php the_classified_location( false ); ?></li>
					<li class="classified-price"><?php dogium_the_classified_price(); ?></li>
					<li class="classified-type <?php echo get_the_classified_type() ? sanitize_title( get_the_classified_type()->slug ) : ''; ?>"><?php the_classified_type(); ?></li>
				</ul>
			</div>
		</div>
		
	</a>
</li>