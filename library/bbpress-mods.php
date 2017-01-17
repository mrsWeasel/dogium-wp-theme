<?php

add_action('bbp_before_main_content', 'dogium_bbp_wrapper_open');
add_action('bbp_after_main_content', 'dogium_bbp_wrapper_close');

function dogium_bbp_wrapper_open() {
	get_template_part( 'template-parts/page-header' );
	echo '<div class="row">';
}

function dogium_bbp_wrapper_close() {
	echo '</div>';
}