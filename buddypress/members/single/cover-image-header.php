<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_header' ); ?>
	<?php 
	// Get the Cover Image
    $cover_image_url = bp_attachments_get_attachment('url', array(
          'object_dir' => 'members',
          'item_id' => bp_displayed_user_id(),
        ));
	$change_cover_link = bp_loggedin_user_domain() . 'profile/change-cover-image/';
	?>
<div id="dogium-member-cover" class="clearfix" style="background-image: url(<?php echo esc_url($cover_image_url);?>)">
	<?php
	if ( bp_displayed_user_id() === get_current_user_id() ) : ?>
	<a id="change-cover-link" title="<?php esc_attr_e('Change cover image', 'dogium');?>" href="<?php echo esc_attr( $change_cover_link );?>"><span class="screen-reader-text"><?php esc_html_e('Change cover image', 'dogium');?></span><i class="fa fa-photo" aria-hidden="true"></i></a>
	<?php endif; ?>
	<div class="row">
		<div class="medium-10 columns medium-centered">
			<div id="item-header-container">
			<div id="item-header-avatar">
				<a href="<?php bp_displayed_user_link(); ?>">

					<?php bp_displayed_user_avatar( 'type=full' ); ?>

				</a>
			</div><!-- #item-header-avatar -->
			<div id="item-header-content">

				<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
					<h2 class="user-nicename">@<?php bp_displayed_user_mentionname(); ?></h2>
				<?php endif; ?>

				<div id="item-buttons"><?php

					/**
					 * Fires in the member header actions section.
					 *
					 * @since 1.2.6
					 */
					do_action( 'bp_member_header_actions' ); ?></div><!-- #item-buttons -->
				<span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_user_last_activity( bp_displayed_user_id() ) ); ?>"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

				<?php

				/**
				 * Fires before the display of the member's header meta.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_member_header_meta' ); ?>

				<div id="item-meta">

					<?php if ( bp_is_active( 'activity' ) ) : ?>

						<div id="latest-update">
							<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

						</div>

					<?php endif; ?>

					<?php

					 /**
					  * Fires after the group header actions section.
					  *
					  * If you'd like to show specific profile fields here use:
					  * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
					  *
					  * @since 1.2.0
					  */
					 do_action( 'bp_profile_header_meta' );

					 ?>

				</div><!-- #item-meta -->
			</div><!-- #item-header-content -->		
			</div>	
		</div>
	</div><!-- .row -->	
</div><!-- #dogium-member-cover -->

<?php

/**
 * Fires after the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_header' ); ?>

<div id="template-notices" role="alert" aria-atomic="true">
	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
	do_action( 'template_notices' ); ?>

</div>
