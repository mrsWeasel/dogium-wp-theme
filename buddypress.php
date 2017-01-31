<?php
/**
 * The template for displaying buddypress pages.
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

 get_header(); ?>
 <?php
 if ( ! bp_is_user() && ! bp_is_group() ) {
  get_template_part('template-parts/page-header');
 }
 ?>
 <div id="page-buddypress" role="main">
<?php
 if ( ! bp_is_user() && ! bp_is_group() ) : ?>
  <div class="row">
   <div class="medium-9 columns">
     <?php endif; ?>  
     <?php do_action( 'foundationpress_before_content' ); ?>
     <?php while ( have_posts() ) : the_post(); ?>
     <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
         <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
         <div class="entry-content">
             <?php the_content(); ?>
             <?php edit_post_link( __( 'Edit', 'dogium' ), '<span class="edit-link">', '</span>' ); ?>
         </div>
         <footer>
             <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'dogium' ), 'after' => '</p></nav>' ) ); ?>
             <p><?php the_tags(); ?></p>
         </footer>
         <?php do_action( 'foundationpress_page_before_comments' ); ?>
         <?php comments_template(); ?>
         <?php do_action( 'foundationpress_page_after_comments' ); ?>
     </article>
   <?php endwhile;?>
   <?php do_action( 'foundationpress_after_content' ); ?>
   <?php
   if ( ! bp_is_user() && ! bp_is_group() ) : ?>
  </div><!---->
 <div class="medium-3 columns">
   <?php dynamic_sidebar('community-sidebar'); ?> 
 </div>
 </div>
<?php endif; ?>
 </div>

 <?php get_footer();
