<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_header' ); ?>
<?php
	// Get the Cover Image
    $cover_image_url = bp_attachments_get_attachment('url', array(
          'object_dir' => 'groups',
          'item_id' => bp_get_group_id(),
    ));
    $change_cover_link = bp_get_group_permalink() . 'admin/group-cover-image/';
?>

<div id="dogium-member-cover" style="background-image: url(<?php echo esc_url($cover_image_url);?>)">
<?php
	if ( bp_group_is_admin() ) : ?>
	<a id="change-cover-link" title="<?php esc_attr_e('Change cover image', 'dogium');?>" href="<?php echo esc_attr( $change_cover_link );?>"><span class="screen-reader-text"><?php esc_html_e('Change cover image', 'dogium');?></span><i class="fa fa-photo" aria-hidden="true"></i></a>
	<?php endif; ?>
			<div class="row">
				<div class="item-header-container-wrap medium-10 columns medium-centered">
					<div id="item-header-container">
						<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
						<div id="item-header-avatar">
							<a href="<?php echo esc_url( bp_get_group_permalink() ); ?>" title="<?php echo esc_attr( bp_get_group_name() ); ?>">

								<?php bp_group_avatar(); ?>

							</a>
						</div><!-- #item-header-avatar -->
						<?php endif; ?>

					<div id="item-header-content">
						<h1 class="white text-shadow"><?php echo esc_html( bp_get_group_name() ); ?></h1>
						<p class="white text-shadow"><span class="highlight"><?php bp_group_type(); ?></span> <?php echo strip_tags( bp_get_group_description() ); ?></p>

						<div id="item-buttons"><?php
							/**
							 * Fires in the group header actions section.
							 *
							 * @since 1.2.6
							 */
							do_action( 'bp_group_header_actions' ); ?>
					
						</div><!-- #item-buttons -->

						<?php
						/**
						 * Fires before the display of the group's header meta.
						 *
						 * @since 1.2.0
						 */
						do_action( 'bp_before_group_header_meta' ); ?>

						<div id="item-meta">

							<?php

							/**
							 * Fires after the group header actions section.
							 *
							 * @since 1.2.0
							 */
							do_action( 'bp_group_header_meta' ); ?>

							

							<?php bp_group_type_list(); ?>
						</div>
						<div id="item-actions">

						<?php if ( bp_group_is_visible() ) : ?>
							<?php 
							/**
							 * Fires after the display of the group's administrators.
							 *
							 * @since 1.1.0
							 */
							do_action( 'bp_after_group_menu_admins' );
							if ( bp_group_has_moderators() ) :

								/**
								 * Fires before the display of the group's moderators, if there are any.
								 *
								 * @since 1.1.0
								 */
								do_action( 'bp_before_group_menu_mods' ); ?>

								<?php

								/**
								 * Fires after the display of the group's moderators, if there are any.
								 *
								 * @since 1.1.0
								 */
								do_action( 'bp_after_group_menu_mods' );

							endif;
						endif; ?>
					</div><!-- #item-actions -->
				</div><!-- #item-header-content -->
		</div>	
	</div>
</div><!-- #dogium-member-header -->

<?php

/**
 * Fires after the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_header' ); ?>

<div id="template-notices" role="alert" aria-atomic="true">
	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
	do_action( 'template_notices' ); ?>

</div>