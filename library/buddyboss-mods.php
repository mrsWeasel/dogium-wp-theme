<?php
/**
 * Modify some BuddyBoss Wall Privacy options through plugin hooks
 * @author Laura Heino
 * @since 1.0.0
 */

// Profile visibility : unset option 'onlyme'
function dogium_profile_activity_visibility() {
	$html = '<select name="bbwall-activity-privacy" id="bbwall-activity-privacy">';

	$options = buddyboss_wall_get_visibility_lists();
	// unset 'onlyme'
	if (isset($options['onlyme'])) {
		unset($options['onlyme']);
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
		 * if group is hidden or private, we shouldn't show activity privacy options
		 * as the privacy is determined on group level anyway.
		 */
		global $groups_template;
		$group = & $groups_template->group;
		if ( !empty( $group ) && ( 'hidden' == $group->status || 'private' == $group->status ) ) {
			//this is a hidden/private group. dont show the privacy UI
			return apply_filters( 'buddyboss_wall_get_groups_activity_visibility', '' );
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