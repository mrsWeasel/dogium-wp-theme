<?php
/*
Template Name: Marketplace
*/

get_header();
get_template_part( 'template-parts/page-header' );
?>
 <div id="page-full-width" role="main">
    <div class="row">
     <div class="medium-9 columns">
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
       </article>
     <?php endwhile;?>
     <?php do_action( 'foundationpress_after_content' ); ?>
     </div>
     <div class="medium-3 columns">
        <?php dynamic_sidebar('marketplace-sidebar'); ?>
        
        <?php 
        $terms = get_terms(array(
          'taxonomy' => 'classified_listing_category',
          'hide_empty' => false
        ));
        
        echo '<div class="widget widget_categories classifieds-custom-cat-list">';
        echo '<h3 class="widget-title">';
        esc_html_e('Product categories', 'dogium');
        echo '</h3>';
        echo '<ul>';
        foreach ($terms as $term) {
          $term_link = get_term_link($term);
          $term_id = $term->term_id;
          ?>
          <li><a href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($term->name); ?></a></li>
          <?php
        }
        echo '</ul>';
        echo '</div>';


        ?>
     </div>
   </div><!-- .row -->
 </div>

 <?php get_footer();