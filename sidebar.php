<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

?>
<aside class="sidebar">
	<?php do_action( 'foundationpress_before_sidebar' ); ?>
	<?php if (bbp_is_forum_archive()) {
		dynamic_sidebar( 'community-sidebar' );
	} elseif (is_home() || is_archive() || is_singular('post') || is_search()) {
		dynamic_sidebar( 'blog-sidebar' );
	}
	?>
</aside>
