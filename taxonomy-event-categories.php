<?php
/**
 * The template for event categories
 *
 * @package Dogium
 * @since Dogium 1.0.0
 * @author Laura Heino
 */

get_header();
get_template_part( 'template-parts/page-header-thin' );

// Test subcategories
$test_id = get_term_by('slug', 'kilpailut-kokeet-testit', 'event-categories')->term_id;
$test_cat = get_term_children($test_id, 'event-categories');

// Show subcategories
$show_id = get_term_by('slug', 'nayttelyt', 'event-categories')->term_id;
$show_cat = get_term_children($show_id, 'event-categories');
$show_cat[] = $show_id;

// Course subcategories
$course_id = get_term_by('slug', 'kurssit-ja-luennot', 'event-categories')->term_id;
$course_cat = get_term_children($course_id, 'event-categories');

// Unofficial subcategories
$unofficial_id = get_term_by('slug', 'epaviralliset', 'event-categories')->term_id;
$unofficial_cat = get_term_children($unofficial_id, 'event-categories');

// Agiligy (has no child categories)
$agility_id = get_term_by('slug', 'agility', 'event-categories')->term_id;

?>

<div id="page-full-width" role="main">
	<article class="main-content">
		<?php 
		
		$queried_object = get_queried_object();
		$current_cat = $queried_object->term_id;

		// Category name for page title
		$cat_title = $queried_object->name;
		?>
		<header>
		<h1 class="blue"><?php echo $cat_title; ?></h1>
		</header>		
		<table>
			<thead>
				<tr>
					<th><?php esc_html_e('Date(s)', 'dogium'); ?></th>

					<?php if (in_array($current_cat, $unofficial_cat)) : ?>
					<th><?php esc_html_e('Weekday', 'dogium'); ?></th>
					<?php endif; ?>

					<th><?php esc_html_e('Event name', 'dogium'); ?></th>

					<th><?php esc_html_e('Town', 'dogium'); ?></th>

					<?php if (in_array($current_cat, $course_cat)) : ?>
					<th><?php esc_html_e('Organizer', 'dogium'); ?></th>
					<?php endif; ?>

					<?php if (in_array($current_cat, $test_cat)) : ?>
					<th><?php esc_html_e('Judge', 'dogium'); ?></th>
					<?php endif; ?>

					<?php if (in_array($current_cat, $show_cat)) : ?>
					<th><?php esc_html_e('Groups', 'dogium'); ?></th>
					<?php endif; ?>

					<?php if (in_array($current_cat, $show_cat)) : ?>
					<th><?php esc_html_e('Last cheapest enrollment', 'dogium'); ?></th>
					<th><?php esc_html_e('Last enrollment', 'dogium'); ?></th>
					<?php endif; ?>

					<?php if (!in_array($current_cat, $test_cat)) : ?>
					<th><?php esc_html_e('Event website', 'dogium'); ?></th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<td><?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTDATES[/events_list]");?></td>

					<?php if (in_array($current_cat, $unofficial_cat)) : ?>
					<td><?php echo do_shortcode("[events_list post_id='{$post->ID}']#l[/events_list]");?></td>
					<?php endif; ?>

					<td><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>

					<?php if (in_array($current_cat, $show_cat)) : ?>
					<td><?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONTOWN[/events_list]");?></td>
					<?php else : ?>
					<?php $alternative_location = get_post_meta($post->ID, 'dgm_alternative_location', true); ?>
					<td><?php echo esc_html($alternative_location); ?></td>
					<?php endif; ?>


					<?php if (in_array($current_cat, $course_cat)) : ?>
					<?php $organizer = get_post_meta($post->ID, 'dgm_course_organizer', true); ?>
					<td><?php echo esc_html( $organizer ); ?></td>
					<?php endif; ?>

					<?php if (in_array($current_cat, $test_cat)) : ?>
					<?php $judge = get_post_meta($post->ID, 'dgm_test_judge', true); ?>
					<td><?php echo esc_html( $judge ); ?></td>
					<?php endif; ?>	

					<?php if (in_array($current_cat, $show_cat)) : ?>
					<?php $groups = get_post_meta($post->ID, 'dgm_show_groups', true); ?>
					<td><?php echo esc_html( $groups ); ?></td>
					<?php endif; ?>

					<?php if (in_array($current_cat, $show_cat)) : ?>
					<?php $last_cheap_enrollment = get_field('dgm_show_last_cheap_day'); ?>
					<?php $last_enrollment = get_field('dgm_show_last_day'); ?>
					<td><?php echo esc_html($last_cheap_enrollment) ?></td>
					<td><?php echo esc_html($last_enrollment) ?></td>
					<?php endif; ?>

					<?php if (!in_array($current_cat, $test_cat)) : ?>
					<?php $website = get_post_meta($post->ID, 'dgm_event_www', true); ?>
					<td><a href="<?php echo esc_url($website);?>" target="_blank">www</a></td>
					<?php endif; ?>
				</tr>		

			<?php endwhile; ?>

		<?php endif; // End have_posts() check. ?>
			</tbody>
		</table>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
		?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'dogium' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'dogium' ) ); ?></div>
			</nav>
		<?php endif; ?>

	</article>

</div>

<?php get_footer();
