<?php
$show_groups = get_post_meta($post->ID, 'dgm_show_groups', true);
$event_www = get_post_meta($post->ID, 'dgm_event_www', true);
// Use acf function to get easy formatting for dates
$show_last_cheap_day = get_field('dgm_show_last_cheap_day');
$show_last_day = get_field('dgm_show_last_day');
?>

<div class="row collapse">
	<div class="large-6 columns">
	<strong><?php esc_html_e('Date(s)', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_{j.n.Y} - #@_{j.n.Y}[/events_list]");?><br>
	<?php if ('' != $show_groups) : ?>
		<strong><?php esc_html_e('Groups', 'dogium'); ?></strong>: <?php echo esc_html($show_groups); ?><br>
	<?php endif; ?>
	<?php if ('' != $show_last_cheap_day) : ?>
		<strong><?php esc_html_e('Last enrollment day with cheapest price', 'dogium'); ?></strong>: <?php echo esc_html($show_last_cheap_day); ?><br>
	<?php endif; ?>
	<?php if ('' != $show_last_day) : ?>
		<strong><?php esc_html_e('Last enrollment day', 'dogium'); ?></strong>: <?php echo esc_html($show_last_day); ?><br>
	<?php endif; ?>
	<strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONNAME[/events_list]"); ?><br>
	<strong><?php esc_html_e('Contact information', 'dogium'); ?></strong>: <br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONADDRESS[/events_list]"); ?><br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONPOSTCODE[/events_list]"); ?> <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONTOWN[/events_list]"); ?><br>
	<?php if ('' != $event_www) : ?>
		<a href="<?php echo esc_url($event_www); ?>" target="_blank"><?php esc_html_e('Event website', 'dogium'); ?></a>
	<?php endif; ?>
	</div>
	<div class="large-6 columns">
		<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONMAP[/events_list]");?>
	</div>

</div>