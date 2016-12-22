<?php
/**
 * The template for displaying dogs
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

<div id="single-post" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<div class="extended row">
			<div class="medium-5 columns">
			<?php if (has_post_thumbnail($post)) {
				the_post_thumbnail('featured-small');
			} ?>
			</div>
			<div class="medium-7 columns">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
					<div class="entry-content">
						<h2><?php esc_html_e('Owners', 'dogium');?></h2>

						<?php

						// Check if field exists and if not, create a new array
						$owners = '' !== get_field('dgm_owners') ? get_field('dgm_owners') : array();

						// This absolutely must be an array but if there is only one owner, a string is returned instead.
						if ( ! is_array($owners) ) {
							$temp = array();
							$temp[] = $owners;
							$owners = $temp;
						}

						array_unshift($owners, get_the_author_meta('ID'));
						foreach($owners as $owner) {
							echo '<li>' . bp_core_get_userlink( $owner ) . '</li>';
						}
						?>
					
						<?php the_content(); ?>

					<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</div>
		</div>
		
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php the_post_navigation(); ?>
		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>
<?php get_footer();
