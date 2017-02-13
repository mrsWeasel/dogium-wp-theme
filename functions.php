<?php
/**
 * Author: Laura Heino
 * URL: http://lauraheino.com
 *
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package Dogium
 * @since Dogium 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Display bp notification count */
require_once( 'library/notifications.php' );

/** Modify BuddyBoss Privacy options */
require_once( 'library/buddyboss-mods.php' );

/** Modify BBPress forum output */
require_once( 'library/bbpress-mods.php' );

/** Geodirectory Cat Listing */
require_once( 'library/geodirectory-mods.php' );

/** Classifieds WP Plugin mods **/
require_once( 'library/classifieds-wp-mods.php' );

/** Custom form for handling classifieds seller messages **/
require_once( 'library/contact-seller-custom-form.php' );

/** Pretty custom excerpt for our blog posts **/
require_once( 'library/excerpt.php' );

/** Template tags for event templates **/
require_once( 'library/events-template-tags.php' );

/** Register event custom fields **/
require_once( 'library/event-custom-fields.php');

/** Add some restrictions to basic users **/
require_once( 'library/restrictions.php');

/** Add some restrictions to basic users **/
require_once( 'library/events-custom-validation.php');

/** Get more events **/
require_once( 'library/events-manager-mods.php');

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );
