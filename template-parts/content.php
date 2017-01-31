<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

?>
<?php if (is_home() || is_archive()) : ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry large-4 columns end dogium-excerpt'); ?>>
			<div class="card">
				<a href="<?php the_permalink(); ?>">
					<?php if (has_post_thumbnail()) : ?>
					<div class="thumbnail">
						<?php the_post_thumbnail('featured-small'); ?>
					</div>	
					<?php endif; ?>
					<div class="card-section">
						<div class="mask"></div>
						<header>
							<h2 class="secondary-title"><?php the_title(); ?></h2>
							<?php $author_id = $post->post_author; ?>
							<span class="byline author"><i class="fa fa-user" aria-hidden="true"></i> <?php echo get_the_author_meta('display_name', $author_id); ?></span>
						</header>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</a>
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