<?php
/**
 * Template part for off canvas menu
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

?>

<nav class="off-canvas position-left" id="mobile-menu" data-off-canvas data-position="left" role="navigation">
  <?php foundationpress_mobile_nav(); ?>
  <div id="mobile-search-container">
			<?php get_search_form(); ?>
		</div>
</nav>

<div class="off-canvas-content" data-off-canvas-content>
