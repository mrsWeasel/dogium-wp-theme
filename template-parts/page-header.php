  <?php
  $id = $page_title = $page_subtitle = $dgm_background = '';

  // If we don't do this for news page (home), WP is going to get id from the first post in loop
  if ( is_home() ) {
    $id = get_option( 'page_for_posts' );
  } elseif ( bp_is_directory() ) {
    $page = get_page_by_path( 'yhteiso' );
    $id =  '' != $page ? $page->ID : 0;
  } else {
    $id = $post->ID;
  }

  $dgm_background = get_field('dgm_background', $id);
 
  $page_title = get_post_meta($id, 'dgm_custom_heading', true);

  if ( '' == $page_title && is_home() ) {
    $page_title = esc_html('News', 'dogium');
  } elseif ('' == $page_title) {
    $page_title = get_the_title();
  }
  $page_subtitle = get_post_meta($id, 'dgm_subheading', true);

  ?>
<?php if ('' != $dgm_background) : ?>
<header id="page-header" style="background-image: url(<?php echo esc_url( $dgm_background ); ?>);">
<?php else : ?>
<header id="page-header">  
<?php endif; ?>
    <div class="row">
        <div class="medium-8 medium-centered columns">    
            <h1 class="text-center white text-shadow entry-title"><?php echo esc_html($page_title); ?></h1>
            <?php if ( is_singular('post') ) : ?>
              <div class="header-entry-meta"><?php foundationpress_entry_meta(); ?></div>
            <?php elseif ('' != $page_subtitle) : ?>
            <p class="intro text-center white text-shadow"><?php echo esc_html($page_subtitle);?></p>
            <?php endif; ?> 
        </div>
    </div>
</header> 