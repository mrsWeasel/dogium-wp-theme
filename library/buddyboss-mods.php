<?php
/**
 * Modify some BuddyBoss Wall Privacy options + relocate activity likes count through plugin hooks
 * @author Laura Heino
 * @since 1.0.0
 */

// In case the plugin gets deactivated
if (! class_exists('BuddyBoss_Wall_Plugin')) {
	return;
}

// Media upload visibility: unset some options
function dogium_profile_media_visibility() {
	    $is_single_group = bp_is_group();
    if ( $is_single_group ) {
		/*
		 * if group is hidden or private, we shouldn't show activity privacy options
		 * as the privacy is determined on group level anyway.
		 */
		global $groups_template;
		$group = & $groups_template->group;
		if ( !empty( $group ) ) {
			// do not show this for groups at all
			return '';
		}
	}
    $html = '<select name="bbm-media-privacy" id="bbm-media-privacy">';

    $options = bbm_get_visibility_lists( $is_single_group );
    // unset 'onlyme'
	if (isset($options['onlyme'])) {
		unset($options['onlyme']);
	}
	if (isset($options['loggedin'])) {
		unset($options['loggedin']);
	}


    foreach( $options as $key=>$val ){
        $html .= "<option value='" . esc_attr( $key ) . "'>$val</option>";
    }
    $html .= '</select>';

    return $html;
}

add_filter('bbm_get_media_visibility_filter', 'dogium_profile_media_visibility');



// Profile visibility : unset option 'onlyme'
function dogium_profile_activity_visibility() {
	$html = '<select name="bbwall-activity-privacy" id="bbwall-activity-privacy">';

	$options = buddyboss_wall_get_visibility_lists();
	// unset 'onlyme' and 'loggedin'
	if (isset($options['onlyme'])) {
		unset($options['onlyme']);
	}
	if (isset($options['loggedin'])) {
		unset($options['loggedin']);
	}

	
	foreach ( $options as $key => $val ) {
		$html .= "<option value='" . esc_attr( $key ) . "'>$val</option>";
	}
	$html .= '</select>';
	return $html;
}

add_filter('buddyboss_wall_get_profile_activity_visibility_filter', 'dogium_profile_activity_visibility');

// Group update visibility: unset everything
function dogium_wall_get_groups_activity_visibility() {
	if ( bp_is_group() ) {
		/*
		 * no need for this as groups don't need the setting at all
		 */
		global $groups_template;
		$group = & $groups_template->group;
		if ( !empty( $group ) ) {
			//this is a hidden/private group. dont show the privacy UI
			return '';
		}
	}
	$html = '<select name="bbwall-activity-privacy" id="bbwall-activity-privacy">';

	$options = buddyboss_wall_get_visibility_lists( true );
	// unset 'onlyme'
	if (isset($options['onlyme'])) {
		unset($options['onlyme']);
	}
	// unset 'friends'
	if (isset($options['friends'])) {
		unset($options['friends']);
	}
	foreach ( $options as $key => $val ) {
		$html .= "<option value='" . esc_attr( $key ) . "'>$val</option>";
	}
	$html .= '</select>';
	return $html;
}

add_filter( 'buddyboss_wall_get_groups_activity_visibility', 'dogium_wall_get_groups_activity_visibility');


// Just to be on the safe side. Never trust your users.
function dogium_add_visibility_to_activity($content, $user_id, $activity_id) {
	$visibility = 'public';

	$options = buddyboss_wall_get_visibility_lists();
	// unset 'onlyme'
	if (isset($options['onlyme'])) {
		unset($options['onlyme']);
	}
	if (isset($options['loggedin'])) {
		unset($options['loggedin']);
	}
	if (isset($options['grouponly'])) {
		unset($options['grouponly']);
	}

	if ( isset( $_POST[ 'visibility' ] ) && in_array( esc_attr( $_POST[ 'visibility' ] ), array_keys( $options ) ) ) {
		$visibility = esc_attr( $_POST[ 'visibility' ] );
	}
	
	bp_activity_update_meta( $activity_id, 'bbwall-activity-privacy', $visibility );

}



function dogium_remove_activity_posted_update() {
	remove_action( 'bp_activity_posted_update', 'buddyboss_wall_add_visibility_to_activity', 10);
}
add_action( 'wp_loaded', 'dogium_remove_activity_posted_update');



if ( buddyboss_wall()->is_wall_privacy_enabled() ):
	add_action( 'bp_activity_posted_update', 'dogium_add_visibility_to_activity', 20, 3 );
endif;
/**
 * Privacy selectbox html
 * @return type String
 */
function dogium_editing_privacy_script_template() {
	if ( bp_is_group_home() ) {
		$options = buddyboss_wall_get_visibility_lists( true );
		// unset 'onlyme'
		if (isset($options['onlyme'])) {
			unset($options['onlyme']);
		}
		// unset 'friends'
		if (isset($options['friends'])) {
			unset($options['friends']);
		}
	} else {
		$options = buddyboss_wall_get_visibility_lists();
		// unset 'onlyme'
		if (isset($options['onlyme'])) {
			unset($options['onlyme']);
		}
		// unset 'loggedin'
		if (isset($options['loggedin'])) {
			unset($options['loggedin']);
		}
	}
	?>

	<script type="text/html" id="buddyboss-wall-form-wrapper-tpl">
		<div class="activity-comments buddyboss-wall-form-wrapper" style="display:none">
			<form id="form_buddyboss-wall-privacy" method="POST" onsubmit="return buddyboss_wall_submit_privacy();">
				<input type="hidden" name="bboss_wall_privacy_nonce" value="<?php echo wp_create_nonce( 'bboss_wall_privacy' ); ?>" >
				<input type="hidden" name="activity_id" value="">

				<div class="clearfix" id="buddyboss-wall-privacy">
					<div class="field">
						<label><?php _e( 'Who can see this', 'buddyboss-wall' ); ?></label>
						<select name="bbwall-privacy-selectbox" id="bbwall-privacy-selectbox" class="bbwall-privacy-selectbox">
							<?php
							foreach ( $options as $key => $val ) {
								?>
								<option value="<?php echo esc_attr( $key ); ?>" ><?php echo $val; ?></option><?php
							}
							?>
						</select>
					</div>
					<div class="field submit">
						<input type="submit" id="buddyboss-wall-privacy-submit" value="<?php _e( 'Save', 'buddyboss-wall' ); ?>" > &nbsp;
						<a class='buddyboss-wall-privacy-cancel' href='#' onclick='return buddyboss_wall_privacy_close();'>
							<?php _e( 'Cancel', 'buddyboss-wall' ); ?>
						</a>
						<i class="buddyboss-wall-ajax-loader privacy-filter-ajax-loader fa fa-spinner"></i>
					</div>
				</div>

				<div id="message"></div>
			</form>
		</div>
	</script>
	<?php
}

add_action( 'wp_head', 'dogium_remove_privacy_script_template_action' );
function dogium_remove_privacy_script_template_action(){
	remove_action( 'wp_footer', 'buddyboss_wall_editing_privacy_script_template' );
}
add_action( 'wp_footer', 'dogium_editing_privacy_script_template' );