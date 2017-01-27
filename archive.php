<?php
/**
 * The template for blog archives
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();

// We use main blog page header image for our archives, too
$id = get_option( 'page_for_posts' );
$dgm_background = get_field('dgm_background', $id);

$page_title = $page_subtitle = '';
	// What kind of archive is it?
	if ( is_category() ) :
		$category = get_the_category($post->ID);
		$page_title = $category[0]->name;
		$page_subtitle = sprintf(esc_html('All posts in category "%s"', 'dogium'), $page_title);
	elseif ( is_tag() ) :
		$page_title = single_tag_title('', false);
		$page_subtitle = sprintf(esc_html('All posts tagged "%s"', 'dogium'), $page_title);
	elseif ( is_author() ) :
		$author = get_userdata( get_query_var('author') );
		$page_title = $author->nickname;
		$page_subtitle = sprintf(esc_html('All posts written by %s', 'dogium'), $page_title);
	elseif (is_day()) :
		$page_title = get_the_date();
		$page_subtitle = esc_html('Daily archive', 'dogium'); 
	elseif (is_month()) :
		$page_title = get_the_date('F Y');
		$page_subtitle = esc_html('Monthly archive', 'dogium'); 
	elseif (is_year()) :
		$page_title = get_the_date('Y');
		$page_subtitle = esc_html('Yearly archive', 'dogium'); 
	endif; 	
?>
<?php if ('' != $dgm_background) : ?>
<header id="page-header" style="background-image: url(<?php echo esc_url( $dgm_background ); ?>);">
<?php else : ?>
<header id="page-header">  
<?php endif; ?>
    <div class="row">
        <div class="medium-8 medium-centered columns">    
            <h1 class="text-center white text-shadow entry-title"><?php echo $page_title; ?></h1>
            <p class="intro text-center white text-shadow"><?php echo $page_subtitle;?></p>
        </div>
    </div>
</header> 

<div id="page" role="main">
	<article class="main-content">
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php $counter = 0; ?>
		<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			<?php if ( ++$counter % 3 === 0 ) : ?>
				</div>
				<div class="row">
			<?php endif; ?>	
		<?php endwhile; ?>
		</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; // End have_posts() check. ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
		?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php endif; ?>

	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();