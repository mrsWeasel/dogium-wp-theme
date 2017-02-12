<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Dogium
 * @since Dogium 1.0.0
 */

 get_header(); 

 $page_title = $page_subtitle = '';
  if ( bbp_is_forum_archive() ) {
      $page_title = esc_html__('Discussion', 'dogium');
      $page_subtitle = esc_html__('Please keep up good spirit and polite language', 'dogium');
  } elseif ( bbp_is_single_forum() ) {
      $page_title = bbp_get_forum_title();   
  } elseif ( bbp_is_topic_archive() ) {
      $page_title = bbp_topic_archive_title();
  } elseif ( bbp_is_single_topic() )  {
      $page_title = bbp_get_topic_title(); 
  }

 ?>
  <header id="page-header-forum">
      <div class="row">
          <div class="medium-8 medium-centered columns">    
              <h1 class="text-center white text-shadow entry-title"><?php echo esc_html($page_title); ?></h1>
                <?php if ('' != $page_subtitle) : ?>
              <p class="intro text-center white text-shadow"><?php echo esc_html($page_subtitle);?></p>
              <?php endif; ?> 
          </div>
      </div>
  </header> 

 <div id="page" role="main">

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
       </footer>
   </article>
 <?php endwhile;?>

 <?php do_action( 'foundationpress_after_content' ); ?>
  <div class="medium-3 columns">
    <?php dynamic_sidebar('forum-sidebar'); ?>
 </div>
 </div>


 <?php get_footer();