<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

get_header(); 
get_template_part( 'template-parts/page-header-thin' );?>

<div id="single-post" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<?php if (has_post_thumbnail()) : ?>
			<div class="thumbnail">
				<?php the_post_thumbnail('featured-medium'); ?>
			</div>
			<?php endif; ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="header-entry-meta"><?php foundationpress_entry_meta(); ?></div>
		</header>
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'dogium' ), 'after' => '</p></nav>' ) ); ?>
			<?php $tag = get_the_tags(); if ( $tag ) { ?><p class="tags"><?php the_tags('', ' ', ''); ?></p><?php } ?>
		</footer>
		<?php the_post_navigation(); ?>
		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer();
