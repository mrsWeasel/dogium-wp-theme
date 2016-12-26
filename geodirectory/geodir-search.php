<?php
/**
 * Template for the GD search page
 * Modified for Dogium by Laura Heino (Added Bootstrap markup)
 * You can make most changes via hooks or see the link below for info on how to replace the template in your theme.
 *
 * @link http://docs.wpgeodirectory.com/customizing-geodirectory-templates/
 * @since 1.0.0
 * @package GeoDirectory
 */

// get header
get_header();

###### WRAPPER OPEN ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_open', 'search-page', 'geodir-wrapper', '');


###### TOP CONTENT ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_top_content', 'search-page');
/**
 * Calls the top section widget area and the breadcrumbs on the search page.
 *
 * @since 1.1.0
 */
do_action('geodir_search_before_main_content');
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_before_main_content', 'search-page');

/**
 * Adds the title to the search page.
 *
 * This action adds the title to the search page.
 *
 * @since 1.1.0
 */
?>
<div class="container-fluid">
<div class="row">
<div class="col-xs-12">
<?php
do_action('geodir_search_page_title');
/**
 * Called after the page title, can add a description to the page.
 *
 * @since 1.1.0
 */
do_action('geodir_search_page_description');
?>

</div>
</div>

<div class="row">
<?php

###### SIDEBAR ######
/**
 * Adds the search page left sidebar to the search template page if active.
 *
 * @since 1.1.0
 */
do_action('geodir_search_sidebar_left');

?>
<div class="col-md-8">
<?php
###### MAIN CONTENT WRAPPERS OPEN ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_content_open', 'search-page', 'geodir-wrapper-content', '');


###### MAIN CONTENT ######
/**
 * Calls the search page main content area on the search template page.
 *
 * @since 1.1.0
 */
do_action('geodir_search_content');
?>
</div>
<?php

###### MAIN CONTENT WRAPPERS CLOSE ######
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_content_close', 'search-page');


###### SIDEBAR ######
/**
 * Adds the search page right sidebar to the search template page if active.
 *
 * @since 1.1.0
 */

?>
<div class="col-md-4">
<?php
do_action('geodir_search_sidebar_right');
?>
</div>
</div>
</div>
<?php
###### WRAPPER CLOSE ######	
/** This action is documented in geodirectory-templates/add-listing.php */
do_action('geodir_wrapper_close', 'search-page');

###### BOTTOM SECTION WIDGET AREA ######
/**
 * Adds the details bottom section widget area, you can add more classes via ''.
 *
 * @since 1.1.0
 */
//do_action('geodir_sidebar_search_bottom_section');

?>

<?php

get_footer();  