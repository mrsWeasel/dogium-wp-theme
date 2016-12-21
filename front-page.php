<?php
/**
 * The template for displaying the front page.
 *
 * This template includes BP activity stream and some custom fields specific to this page only.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); ?>

 <div id="page" role="main">
   <div class="extended row">
     <div class="medium-3 columns">
       <?php dynamic_sidebar('home-left-sidebar'); ?>
     </div>
   
   <div class="medium-6 columns">
      <div id="buddypress">
          <?php if ( is_user_logged_in() ) :
          bp_get_template_part( 'activity/post-form' ); 
          endif; ?>
         <?php get_template_part( 'buddypress/activity/activity-loop' ); ?> 
      </div>
      <?php do_action( 'foundationpress_before_content' ); ?>
      <?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
         <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
         <div class="entry-content">
             <?php the_content(); ?>
             <?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
         </div>
         <footer>
             <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
             <p><?php the_tags(); ?></p>
         </footer>
         <?php do_action( 'foundationpress_page_before_comments' ); ?>
         <?php comments_template(); ?>
         <?php do_action( 'foundationpress_page_after_comments' ); ?>
      </article>
      <?php endwhile;?>

   <?php do_action( 'foundationpress_after_content' ); ?>
   </div>
   <div class="medium-3 columns">
     <?php dynamic_sidebar('home-right-sidebar'); ?>
   </div>
  </div>
 </div>

 <?php get_footer();
