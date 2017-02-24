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
 * @package Dogium
 * @since Dogium 1.0.0
 */

 get_header(); 
 get_template_part( 'template-parts/page-header' );?>

 <div id="page-three-columns" role="main">
 <div class="large-6 large-push-3 columns"> 
 <?php do_action( 'foundationpress_before_content' ); ?>
 <?php while ( have_posts() ) : the_post(); ?>
  
   <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
       <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
       <div class="entry-content">
          <div class="clearfix">
          <?php dogium_list_event_categories( 'nayttelyt' ); ?>
          <?php dogium_list_event_categories( 'agility' ); ?>
          <?php dogium_list_event_categories( 'kilpailut-kokeet-testit' ); ?>
          <?php dogium_list_event_categories( 'kurssit-ja-luennot' ); ?>
          <?php dogium_list_event_categories( 'epaviralliset' ); ?>
          </div>
          <?php the_content(); ?>      
       </div>
       <footer>
           <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'dogium' ), 'after' => '</p></nav>' ) ); ?>
       </footer>
       <?php do_action( 'foundationpress_page_before_comments' ); ?>
       <?php comments_template(); ?>
       <?php do_action( 'foundationpress_page_after_comments' ); ?>
    </article>
 <?php endwhile;?>
 </div>
  <div class="large-3 large-pull-6 columns">
     <?php dynamic_sidebar('events-sidebar-left'); ?>         
  </div>
  <div class="large-3 columns">
    <?php dynamic_sidebar('events-sidebar'); ?>
  </div>

 <?php do_action( 'foundationpress_after_content' ); ?>

 </div>

 <?php get_footer();
