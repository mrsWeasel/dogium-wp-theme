<?php
/**
 * BuddyPress - Activity Loop
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * Modified by Laura Heino
 */

/**
 * Fires before the start of the activity loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_activity_loop' ); ?>

<?php 

$parameters = '';

//if ( is_front_page() ) {
	if ( is_user_logged_in() ) {
		// For logged in users, only show activity from friends and groups
		$parameters .= '&scope=just-me,friends,groups';
	}
	// Standard activity updates + activity updates with rtmedia image attachment
	$parameters .= '&action=rtmedia_update,activity_update';
	// Only show 5 entries
	$parameters .= '&max=5';
//}

?>

<?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ) . $parameters ) ) : ?>

	<?php if ( empty( $_POST['page'] ) ) : ?>

		<ul id="activity-stream" class="list-blog">

	<?php endif; ?>

	<?php while ( bp_activities() ) : bp_the_activity(); ?>

		<?php bp_get_template_part( 'activity/entry' ); ?>

	<?php endwhile; ?>

	
	<?php if ( bp_activity_has_more_items() ) : ?>


		<?php if ( !is_front_page() ) :?>
		<li class="load-more">
			<a href="<?php bp_activity_load_more_link() ?>"><?php _e( 'Load More', 'buddypress' ); ?></a>
		</li>
		<?php endif; ?>

	<?php endif; ?>	

	<?php if ( empty( $_POST['page'] ) ) : ?>

		</ul>

	<?php endif; ?>

<?php else : ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the finish of the activity loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_activity_loop' ); ?>

<?php if ( empty( $_POST['page'] ) ) : ?>

	<form action="" name="activity-loop-form" id="activity-loop-form" method="post">

		<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>

	</form>

<?php endif; ?>
