<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<?php if (is_home() || is_archive()) : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry large-4 columns end'); ?>>
		<div class="card">
			<?php if (has_post_thumbnail()) : ?>
				<div class="thumbnail">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-small'); ?></a>
				</div>	
			<?php endif; ?>
			<div class="card-section">
				<header>
					<h2 class="secondary-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<div class="entry-content">
					
				</div>
				<footer>
					<?php $tag = get_the_tags(); if ( $tag ) { ?><p class="tags"><?php the_tags('', ' ', ''); ?></p><?php } ?>
				</footer>
			</div>	
		</div>
	</div>
<?php else : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry'); ?>>
		<header>
			<h2 class="secondary-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
		<footer>
			<?php $tag = get_the_tags(); if ( $tag ) { ?><p class="tags"><?php the_tags('', ' ', ''); ?></p><?php } ?>
		</footer>
	</div>	

<?php endif;