  <?php
  if (get_field('dgm_background')) {
      $bg_url = esc_url(get_field('dgm_background'));
  } else {
      $bg_url = '';
    } ?>
        <header id="page-header" style="background-image: url(<?php echo $bg_url; ?>);">
          <div class="row">
              <div class="medium-8 medium-centered columns">
                <?php if (bbp_is_forum_archive()) :?>
                 <h1 class="text-center white text-shadow entry-title"><?php bbp_forum_archive_title(); ?></h1> 
                <?php elseif (bbp_is_topic_archive()) : ?>
                  <h1 class="text-center white text-shadow entry-title"><?php bbp_topic_archive_title(); ?>asdf</h1>
                <?php else : ?>
                <h1 class="text-center white text-shadow entry-title"><?php the_title();?></h1>
                <?php endif; ?>
              </div>
          </div>
        </header> 