<?php
$alternative_location = get_post_meta($post->ID, 'dgm_alternative_location', true);
$alternative_venue = get_post_meta($post->ID, 'dgm_alternative_venue', true);
$type_of_test = get_post_meta($post->ID, 'dgm_type_of_test', true);
$classes = get_post_meta($post->ID, 'dgm_test_classes', true);
$judge = get_post_meta($post->ID, 'dgm_test_judge', true);
?>

<p><strong><?php esc_html_e('Date', 'dogium'); ?></strong>: <?php echo do_shortcode('[events_list]#j.#n.#Y[/events_list]');?></p>
<?php if ('' != $alternative_location) : ?>
	<p><strong><?php esc_html_e('Location', 'dogium'); ?></strong>: <?php echo esc_html($alternative_location); ?></p>
<?php endif; ?>
<?php if ('' != $alternative_venue) : ?>
	<p><strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo esc_html($alternative_venue); ?></p>
<?php endif; ?>
<?php if ('' != $type_of_test) : ?>
	<p><strong><?php esc_html_e('Type of test', 'dogium'); ?></strong>: <?php echo esc_html($type_of_test); ?></p>
<?php endif; ?>
<?php if ('' != $classes) : ?>
	<p><strong><?php esc_html_e('Classes', 'dogium'); ?></strong>: <?php echo esc_html($classes); ?></p>
<?php endif; ?>
<?php if ('' != $judge) : ?>
	<p><strong><?php esc_html_e('Judge', 'dogium'); ?></strong>: <?php echo esc_html($judge); ?></p>
<?php endif; ?>
