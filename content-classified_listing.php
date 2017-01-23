<?php
/**
 * Modified listings template (grid + image size)
 * @author Laura Heino
 * @since 1.0.0
 */
?>
<?php global $post, $wpcm_wrap; ?>

<?php $col_classes = array(); ?>

<?php // Wrap every n number of classifieds. ?>

<?php if ( ! empty( $per_row ) && 0 === ( $wpcm_wrap % $per_row ) ): ?>

	<?php if ( $wpcm_wrap ): ?>

		</div>

		<?php $wpcm_wrap = 0; ?>

	<?php endif; ?>

<?php endif; ?>
	
	<?php 
		// Modify column classes to fit our theme
		$col_classes[] = 'medium-' . ( 12 / $per_row );
		$col_classes[] = 'end';
		$col_classes = implode(' ', $col_classes);
	?>

	<div class="columns <?php echo esc_attr( $col_classes ); ?>">
	<article <?php classified_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
		<a href="<?php esc_url( the_classified_permalink() ); ?>">
			<?php the_classified_featured_image( $size = 'featured-xsmall', $link = false ); ?>
			<?php dogium_the_classified_price('<span class="label primary">', '</span>', $post); ?>
			<div class="classified-title">
				<h3><?php the_title(); ?></h3>
			</div>
			<div class="classified-location">
				<?php the_classified_location( false ); ?>
			</div>
			<div class="classified-listing-meta">
				<ul class="meta">
					<?php do_action( 'classified_listing_meta_start' ); ?>
					<li class="classified-type <?php echo get_the_classified_type() ? sanitize_title( get_the_classified_type()->slug ) : ''; ?>"><?php the_classified_type(); ?></li>
					<li class="date"><date><?php printf( __( '%s ago', 'classifieds-wp' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>

					<?php do_action( 'classified_listing_meta_end' ); ?>
				</ul>
			</div>
		</a>
	</article>
	</div>	
<?php $wpcm_wrap++; ?>
