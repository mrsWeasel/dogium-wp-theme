<?php
global $post;
$EM_Event = em_get_event($post->ID, 'post_id');
?>
<div class="row collapse">
	<div class="large-6 columns">
	
	<div class="event-details">	
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTIMAGE{150,150}[/events_list]"); ?>
	</div>
	<div class="event-details">
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_EVENTNOTES[/events_list]"); ?>
	<strong><?php esc_html_e('Date(s)', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_{j.n.Y} - #@_{j.n.Y}[/events_list]");?><br>

	<?php if ($EM_Event->has_location) : ?>
	<strong><?php esc_html_e('Venue', 'dogium'); ?></strong>: <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONNAME[/events_list]"); ?><br>
	<strong><?php esc_html_e('Contact information', 'dogium'); ?></strong>: <br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONADDRESS[/events_list]"); ?><br>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONPOSTCODE[/events_list]"); ?> <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONTOWN[/events_list]"); ?><br>
	<?php endif; ?>
	</div>
	<div class="event-details">
	<h2 class="secondary-title"><?php esc_html_e('Attendees', 'dogium');?></h2>
	<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_ATTENDEES[/events_list]");?>

	<?php if ($EM_Event->has_bookings) : ?>
	<strong><?php esc_html_e('Available spaces:', 'dogium'); ?></strong> <?php echo do_shortcode("[events_list post_id='{$post->ID}']#_AVAILABLESPACES[/events_list]"); ?>
	 <?php endif; ?>

	</div>
	<div class="event-details">
		<?php
		/**
	     * We need this for our custom privileges (only group members can attend
	     * if group is private / closed). All logged in users can attend if group is public
	     * @since Dogium 1.0
	     * @author Laura Heino
	     */
	    $user = get_current_user_id();
	    // Get group with ownership of this event
	    $group_id = $EM_Event->group_id;
	    $group = groups_get_group( array( 'group_id' => $group_id ) );
		$is_member = groups_is_user_member($user, $group_id);
		// Initialize
		$user_can_book = false;

		$group_visibility = $group->status;
		switch ($group_visibility) {
			case 'hidden':
				$user_can_book = $is_member ? true : false;
				break;
			case 'private':
				$user_can_book = $is_member ? true : false;
				break;
			default:
				$user_can_book = is_user_logged_in() ? true : false;
				break;
		}

	if ($user_can_book) {	
	echo do_shortcode("[events_list post_id='{$post->ID}']#_BOOKINGBUTTON[/events_list]");
	} ?>
	</div>
	</div>
	<div class="large-5 columns">
		<?php echo do_shortcode("[events_list post_id='{$post->ID}']#_LOCATIONMAP[/events_list]");?>

	</div>
</div>