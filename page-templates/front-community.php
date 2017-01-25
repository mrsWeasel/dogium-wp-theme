<?php
/*
Template Name: Front Page Community
*/
/**
 * The template for displaying the community front page.
 *
 * This template includes BP activity stream and some custom fields specific to this page only.
 * 
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); ?>
  <?php
    if (get_field('dgm_background')) {
        $bg_url = esc_url(get_field('dgm_background'));
    }
  ?>
  <header id="front-page-header" style="background-image: url(<?php echo $bg_url; ?>);">
    <div class="row">
      <div class="medium-8 medium-centered columns">
        <?php
        if (get_field('dgm_fp_heading')) : ?>
          <h1 class="text-center white text-shadow">
          <?php echo esc_html( get_field('dgm_fp_heading') );?>
          </h1>
        <?php 
        endif;
        if (get_field('dgm_fp_tagline')) : ?>
          <p class="intro text-center white text-shadow">
          <?php echo esc_html( get_field('dgm_fp_tagline') );?> 
          </p>
        <?php
        endif;
        ?>
      </div>

    </div>
   </header> 
 <div id="page-full-width" role="main">
 
   <div class="extended row">
   <div class="medium-7 large-6 large-push-3 columns">
     
      <?php do_action( 'foundationpress_before_content' ); ?>
      <?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
         <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
          <div id="buddypress">
          <?php if ( is_user_logged_in() ) :
          bp_get_template_part( 'activity/post-form' ); 
          endif; ?>
         <div class="activity">
         <?php get_template_part( 'buddypress/activity/activity-loop' ); ?>
         </div>
        
        </div>
         <div class="entry-content clearfix">
          <div class="row column">
             <?php
             $link_text = esc_html( get_field('dgm_community_link_text') );
             $link_url = esc_url( get_field('dgm_community_page_link_url') );
             if ( !empty($link_text) && !empty($link_url) ) {  
              echo "<a id='community-link' class='button float-right' href='{$link_url}'>{$link_text} <i class='fa fa-arrow-right' aria-hidden='true'></i></a>";
             }
              ?>
            </div> 
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
   <div class="medium-5 large-3 large-push-3 columns">
     <?php dynamic_sidebar('community-sidebar'); ?>
   </div>
    <div class="medium-12 large-3 large-pull-9 columns">
       <?php dynamic_sidebar('home-left-sidebar'); ?>
    </div>
  </div>
 </div>

 <?php get_footer();
