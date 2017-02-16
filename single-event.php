<?php
/**
 * The template for displaying single events
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */
global $post;
$EM_Event = em_get_event($post->ID, 'post_id');

get_header();
get_template_part( 'template-parts/page-header-thin' ); ?>


<div id="page-full-width" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php
// We need to treat different event categories
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

$group_id = $EM_Event->group_id;
$user = get_current_user_id();	
$group = groups_get_group( array( 'group_id' => $group_id ) );
$is_member = groups_is_user_member($user, $group_id); ?>

	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<?php if ( $slug == 'ryhmatapahtuma' && ( $group == '' || ( $group->status !== 'public' && ! $is_member ) ) ) : ?>
			<div class="callout warning"><p><?php esc_html_e('This content is private.', 'dogium'); ?></p></div>
		<?php else : ?>	
			<header>
				<h1 class="entry-title blue"><?php the_title(); ?></h1>

				<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTCATEGORIES[/events_list]");?>
			</header>
		
		<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
		<div class="entry-content">
			<?php get_template_part('template-parts/content-events', $slug); ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'dogium' ), 'after' => '</p></nav>' ) ); ?>
		</footer>
		<?php endif; ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>
<?php get_footer();