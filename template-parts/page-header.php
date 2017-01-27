  <?php
  $id = $page_title = $page_subtitle = $dgm_background = '';

  // If we don't do this for news page (home), WP is going to get id from the first post in loop
  if ( is_home() ) {
    $id = get_option( 'page_for_posts' );
  } elseif (!is_search() && !is_404()) {
    $id = $post->ID;
  }

  $dgm_background = get_field('dgm_background', $id);

  if ( is_search() ) :
    $page_title = sprintf(esc_html('Search results for "%s"', 'dogium'), get_search_query() );
  elseif ( is_404() ) :
    $page_title = esc_html('404 – Page not found', 'dogium');
    $page_subtitle = esc_html("Nothing was found at this location.", 'dogium'); 
  else :  
    $page_title = get_post_meta($id, 'dgm_custom_heading', true);
  endif;

  if ( '' == $page_title && is_home() ) {
    $page_title = esc_html('News', 'dogium');
  } elseif ('' == $page_title) {
    $page_title = get_the_title();
  }
  $page_subtitle = get_post_meta($id, 'dgm_subheading', true);

  // bbPress forum header
  if ( function_exists('bbp_get_forum_archive_title') && function_exists( 'bbp_get_topic_archive_title' )) {
    if ( bbp_is_forum_archive() ) {
      $page_title = bbp_get_forum_archive_title();
    } elseif ( bbp_is_topic_archive() ) {
      $page_title = bbp_topic_archive_title();
    }
  }

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