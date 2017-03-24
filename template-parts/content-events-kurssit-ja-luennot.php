<?php
$alternative_location = get_post_meta($post->ID, 'dgm_alternative_location', true);
$alternative_venue = get_post_meta($post->ID, 'dgm_alternative_venue', true);
$event_www = get_post_meta($post->ID, 'dgm_event_www', true);
$course_lecturer_instructor = get_post_meta($post->ID, 'dgm_course_lecturer_instructor', true);
$course_organizer = get_post_meta($post->ID, 'dgm_course_organizer', true);
$course_info = get_post_meta($post->ID, 'dgm_course_info', true);

$allowed_html = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array(),
    'p' => array(),
);
?>

<strong><?php esc_html_e('Date', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTDATES[/events_list]");?><br>
<?php if ('' != $course_lecturer_instructor) : ?>
	<strong><?php esc_html_e('Lecturer / instructor', 'dogium'); ?></strong>: <?php echo esc_html($course_lecturer_instructor); ?><br>
<?php endif; ?>
<?php if ('' != $course_organizer) : ?>
	<strong><?php esc_html_e('Organizer', 'dogium'); ?></strong>: <?php echo esc_html($course_organizer); ?><br>
<?php endif; ?>
<?php if ('' != $course_info) : ?>
	<strong><?php esc_html_e('Info', 'dogium'); ?></strong>: <?php echo wp_kses($course_info, $allowed_html); ?><br>
<?php endif; ?>
<?php if ('' != $alternative_venue) : ?>
	<strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo esc_html($alternative_venue); ?><br>
<?php endif; ?>
<?php if ('' != $alternative_location) : ?>
	<strong><?php esc_html_e('Location', 'dogium'); ?></strong>: <?php echo esc_html($alternative_location); ?><br>
<?php endif; ?>
<?php if ('' != $event_www) : ?>
	<a href="<?php echo esc_url($event_www); ?>" target="_blank"><?php esc_html_e('Event website', 'dogium'); ?></a>
<?php endif; ?>

