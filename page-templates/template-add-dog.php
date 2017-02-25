<?php
/*
Template Name: Add Dog
*/
/**
 * The template for displaying the 'Add Dog' page.
 * 
 * @since 1.0.0
 * @author Laura Heino
 * @uses ACF
 *
 */
defined( 'ABSPATH' ) or die( 'No direct access allowed.' );

if ( is_user_logged_in() ) {
	acf_form_head();
}

get_header();
get_template_part( 'template-parts/page-header-thin' );?>

<div id="page-narrow" role="main">	

 <?php while ( have_posts() ) : the_post(); ?>
   <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
      <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      </header>
       <div class="entry-content">
             <?php if (!is_user_logged_in()) : ?>
             		<div class="callout warning">
             			<p><?php echo sprintf(
             			__('Only logged in users are allowed to add dogs. Please <a href="%s">log in</a> or register.', 'dogium'),
             			wp_login_url( get_permalink() ) 
             			); ?></p>
             		</div>
             <?php else : ?>
             <?php the_content(); ?> 
             <?php
             if (class_exists('DogForms')) {
                $dog_form = new DogForms;
                $dog_form->print_new_dog_form(); 
             }
             ?>	
             <?php endif; ?>

       </div>
   </article>
 <?php endwhile;?>

</div> 

<?php
get_footer();