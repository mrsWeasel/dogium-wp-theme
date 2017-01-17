<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<aside class="sidebar">
	<?php do_action( 'foundationpress_before_sidebar' ); ?>
	<?php if (bbp_is_forum_archive()) {
		dynamic_sidebar( 'community-sidebar' );
	} else {
		dynamic_sidebar( 'sidebar-widgets' );
	}
	?>
</aside>
