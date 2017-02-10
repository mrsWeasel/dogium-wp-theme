<?php
global $EM_Event;

if( !function_exists('bp_is_active') || !bp_is_active('groups') ) return false;
$user_groups = array();
$group_data = groups_get_user_groups(get_current_user_id());
if( !is_super_admin() ){
	foreach( $group_data['groups'] as $group_id ){
		if( groups_is_user_admin(get_current_user_id(), $group_id) ){
			$user_groups[] = groups_get_group( array('group_id'=>$group_id)); 
		}
	}
	$group_count = count($user_groups);
}else{
    $groups = groups_get_groups(array('show_hidden'=>true, 'per_page'=>0));
    $user_groups = $groups['groups'];
	$group_count = $groups['total'];
}

if ( bp_is_group() ) {
	$group_name = bp_get_current_group_name();
	$group_id = bp_get_current_group_id();
	 ?>
	<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
	<?php
} elseif ( $EM_Event->group_id != '' ) {
	$group_id = $EM_Event->group_id; ?>
	<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
	<?php
} elseif ( count($user_groups) > 0 ) { 
	?>
	<select name="group_id">
		<?php
		//in case user isn't a group mod, but can edit other users' events
		if( !empty($EM_Event->group_id) && !in_array($EM_Event->group_id, $group_data['groups']) ){
			$other_group = groups_get_group( array('group_id'=>$EM_Event->group_id));
			?>
			<option value="<?php echo $other_group->id; ?>" selected="selected"><?php echo $other_group->name; ?></option>
			<?php
		}
		//show user groups
		foreach($user_groups as $BP_Group){
			?>
			<option value="<?php echo $BP_Group->id; ?>" <?php echo ($BP_Group->id == $EM_Event->group_id) ? 'selected="selected"':''; ?>><?php echo $BP_Group->name; ?></option>
			<?php
		} 
		?>
	</select>
	</p>
	
<?php } else {
	?><p><em><?php _e('No groups defined yet.','events-manager'); ?></em></p><?php
}