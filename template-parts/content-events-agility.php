<?php
$alternative_location = get_post_meta($post->ID, 'dgm_alternative_location', true);
$alternative_venue = get_post_meta($post->ID, 'dgm_alternative_venue', true);
$event_www = get_post_meta($post->ID, 'dgm_event_www', true);
$last_enrollment = get_field('dgm_agility_last_day');
?>

<strong><?php esc_html_e('Date', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTDATES[/events_list]");?><br>
<strong><?php esc_html_e('Weekday', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#l[/events_list]");?><br>
<?php if ('' != $alternative_venue) : ?>
	<strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo esc_html($alternative_venue); ?><br>
<?php endif; ?>
<?php if ('' != $alternative_location) : ?>
	<strong><?php esc_html_e('Location', 'dogium'); ?></strong>: <?php echo esc_html($alternative_location); ?><br>
<?php endif; ?>
<?php if ('' != $last_enrollment) : ?>
	<strong><?php esc_html_e('Last enrollment', 'dogium'); ?></strong>: <?php echo esc_html($last_enrollment); ?><br>
<?php endif; ?>
<?php if ('' != $event_www) : ?>
	<a href="<?php echo esc_url($event_www); ?>" target="_blank"><?php esc_html_e('Event website', 'dogium'); ?></a>
<?php endif; ?>