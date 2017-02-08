<div class="row collapse">
	<div class="large-6 columns">
	<strong><?php esc_html_e('Date(s)', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_{j.n.Y} - #@_{j.n.Y}[/events_list]");?><br>
	<strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONNAME[/events_list]"); ?><br>
	<strong><?php esc_html_e('Contact information', 'dogium'); ?></strong>: <br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONADDRESS[/events_list]"); ?><br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONPOSTCODE[/events_list]"); ?> <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONTOWN[/events_list]"); ?><br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_BOOKINGBUTTON[/events_list]"); ?>
	</div>
	<div class="large-6 columns">
		<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONMAP[/events_list]");?>
	</div>

</div>
<?php echo do_shortcode("[events_list][/events_list]"); ?>