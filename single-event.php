<?php
/**
 * The template for displaying single events
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); 

// We need to treat different event categories
global $post;
$event_category = '';
$event_categories = get_the_terms($post->ID, 'event-categories');

if ($event_categories) {
	// Get the first term ( no event should have multiple categories )
	$event_category = $event_categories[0];
	$event_parent_id = $event_category->parent;
	
	if ($event_parent_id) {
		$slug = get_term( $event_parent_id )->slug;
	} else {
		$slug = $event_category->slug;
	}
}

?>

<div id="single-post" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">
			<?php get_template_part('template-parts/content-events', $slug); ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
		</footer>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer();