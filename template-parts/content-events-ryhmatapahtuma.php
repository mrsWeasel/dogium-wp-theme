<div class="row collapse">
	<div class="large-6 columns">
	<div class="event-details">
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTIMAGE{900,900}[/events_list]"); ?>
	</div>
	<div class="event-details">
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTNOTES[/events_list]"); ?>
	<strong><?php esc_html_e('Date(s)', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_{j.n.Y} - #@_{j.n.Y}[/events_list]");?><br>
	<strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONNAME[/events_list]"); ?><br>
	<strong><?php esc_html_e('Contact information', 'dogium'); ?></strong>: <br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONADDRESS[/events_list]"); ?><br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONPOSTCODE[/events_list]"); ?> <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONTOWN[/events_list]"); ?><br>
	</div>
	<div class="event-details">
	<h2 class="secondary-title"><?php esc_html_e('Attendees', 'dogium');?></h2>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_ATTENDEES[/events_list]");?>
	<strong><?php esc_html_e('Available spaces:', 'dogium'); ?></strong> <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_AVAILABLESPACES[/events_list]"); ?>
	</div>
	<div class="event-details">
		<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_BOOKINGBUTTON[/events_list]");?>
	</div>
	</div>
	<div class="large-5 columns">
		
		<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONMAP[/events_list]");?>
		<?php global $EM_Event; ?>
		Laura muista poistaa nämä
		<p>Omistaja (kirjoittaja)</p>
		<?php var_dump($EM_Event->event_owner); ?>
		<p>Ryhmä</p>
		<?php var_dump($EM_Event->group_id); ?>
	</div>

</div>