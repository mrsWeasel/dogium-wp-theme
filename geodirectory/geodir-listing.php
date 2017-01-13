<?php
/**
 * Template for the listings (category) page
 * Modified for Dogium by Laura Heino (Added Bootstrap markup)
 * You can make most changes via hooks or see the link below for info on how to replace the template in your theme.
 *
 * @link http://docs.wpgeodirectory.com/customizing-geodirectory-templates/
 * @since 1.0.0
 * @package GeoDirectory
 */

// call header
get_header();

###### WRAPPER OPEN ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_open', 'listings-page', 'geodir-wrapper', '');

###### TOP CONTENT ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_top_content', 'listings-page');
/**
 * Calls the top section widget area and the breadcrumbs on the listings page.
 *
 * @since 1.1.0
 */
do_action('geodir_listings_before_main_content');
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_before_main_content', 'listings-page');

/**
 * Adds the title to the listings page.
 *
 * This action adds the title to the listings page.
 *
 * @since 1.1.0
 */
?>
<div class="row">
<div class="small-12 columns">
<?php
do_action('geodir_listings_page_title');
/**
 * Called after the page title, can add a description to the page.
 *
 * @since 1.1.0
 */
do_action('geodir_listings_page_description');
?>
</div>
</div>
<div class="row">
<?php
###### SIDEBAR ######
/**
 * Adds the listings page left sidebar to the listings template page if active.
 *
 * @since 1.1.0
 */
do_action('geodir_listings_sidebar_left');


// Bootstrap column wrapper for main content -Laura
?>
<div class="medium-8 columns">
<?php

###### MAIN CONTENT WRAPPERS OPEN ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_content_open', 'listings-page', 'geodir-wrapper-content', '');


###### MAIN CONTENT ######
/**
 * Calls the listings page main content area on the listings template page.
 *
 * @since 1.1.0
 */
do_action('geodir_listings_content');

?>

</div>

<?php

###### MAIN CONTENT WRAPPERS CLOSE ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_content_close', 'listings-page');

###### SIDEBAR ######
/**
 * Adds the listings page right sidebar to the listings template page if active.
 *
 * @since 1.1.0
 */
?>
<div class="medium-4 columns">
<?php
do_action('geodir_listings_sidebar_right');
?>
</div>
<?php

###### WRAPPER CLOSE ######	
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_close', 'listings-page');

###### BOTTOM SECTION WIDGET AREA ######
/**
 * Adds the listings page bottom widget area to the listings template page if active.
 *
 * @since 1.1.0
 */
do_action('geodir_sidebar_listings_bottom_section');

?>

</div><!-- .row -->

<?php

get_footer();  