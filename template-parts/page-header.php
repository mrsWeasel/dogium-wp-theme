  <?php
  $dgm_background = get_field('dgm_background');
  if ( '' != $dgm_background ) {
      $bg_url = esc_url( $dgm_background );
  } else {
      $bg_url = '';
  } 


  $page_title = get_post_meta($post->ID, 'dgm_custom_heading', true);
  if ('' == $page_title) {
    $page_title = get_the_title();
  }
  $page_subtitle = get_post_meta($post->ID, 'dgm_subheading', true);

  if ( function_exists('bbp_get_forum_archive_title') && function_exists( 'bbp_get_topic_archive_title' )) {
    if ( bbp_is_forum_archive() ) {
      $page_title = bbp_get_forum_archive_title();
    } elseif ( bbp_is_topic_archive() ) {
      $page_title = bbp_topic_archive_title();
    }
  }

  ?>
<?php if ('' != $bg_url) : ?>
<header id="page-header" style="background-image: url(<?php echo $bg_url; ?>);">
<?php else : ?>
<header id="page-header">  
<?php endif; ?>
    <div class="row">
        <div class="medium-8 medium-centered columns">    
            <h1 class="text-center white text-shadow entry-title"><?php echo esc_html($page_title); ?></h1>
            <?php if ('' != $page_subtitle) : ?>
            <p class="intro text-center white text-shadow"><?php echo esc_html($page_subtitle);?></p>
            <?php endif; ?> 
        </div>
    </div>
</header> 