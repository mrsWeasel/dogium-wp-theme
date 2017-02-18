<?php
/**
 * The template for displaying search form
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for:', 'dogium'); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e('Search', 'dogium'); ?>" value="" name="s" />
	</label>
	<button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Submit search', 'dogium'); ?></span></button>
</form>