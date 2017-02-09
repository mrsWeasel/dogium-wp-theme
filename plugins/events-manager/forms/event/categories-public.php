<?php
/*
 * This file is called by templates/forms/location-editor.php to display fields for uploading images on your event form on your website. This does not affect the admin featured image section.
* You can override this file by copying it to /wp-content/themes/yourtheme/plugins/events-manager/forms/event/ and editing it there.
*/
global $EM_Event;

/* @var $EM_Event EM_Event */ 
$categories = EM_Categories::get(array('orderby'=>'name','hide_empty'=>0));
$group_category = get_term_by('slug', 'ryhmatapahtuma', 'event-categories');
$group_category_id = $group_category->term_id; 
?>
<input type="hidden" name="event_categories[]" value="<?php echo $group_category_id; ?>">