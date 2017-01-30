<?php
/*
Template Name: Events
*/
/**
 * The template for displaying Events page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); 
 get_template_part( 'template-parts/page-header' );?>

 <?php get_template_part( 'template-parts/featured-image' ); ?>

 <div id="page" role="main">

 <?php do_action( 'foundationpress_before_content' ); ?>
 <?php while ( have_posts() ) : the_post(); ?>
   <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
       <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
       <div class="entry-content">
          <?php the_content(); ?>

          <div class="row">
            <div class="large-4 columns">
              <?php dogium_list_event_categories( 'nayttelyt' ); ?>
              <?php dogium_list_event_categories( 'agility' ); ?>
            </div>
            <div class="large-4 columns">
              <?php dogium_list_event_categories( 'kilpailut-kokeet-testit' ); ?>
            </div>
             <div class="large-4 columns">
              <?php dogium_list_event_categories( 'kurssit-ja-luennot' ); ?>
              <?php dogium_list_event_categories( 'epaviralliset' ); ?>
            </div>
          </div>
       </div>
       <footer>
           <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
       </footer>
       <?php do_action( 'foundationpress_page_before_comments' ); ?>
       <?php comments_template(); ?>
       <?php do_action( 'foundationpress_page_after_comments' ); ?>
  </article>
  <div class="medium-3 columns">
    <?php dynamic_sidebar('events-sidebar'); ?>
  </div>

 <?php endwhile;?>

 <?php do_action( 'foundationpress_after_content' ); ?>

 </div>

 <?php get_footer();
