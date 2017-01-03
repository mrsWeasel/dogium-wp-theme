  <?php
  if (get_field('dgm_background')) {
      $bg_url = esc_url(get_field('dgm_background'));
  } else {
      $bg_url = '';
    } ?>
        <header id="page-header" style="background-image: url(<?php echo $bg_url; ?>);">
          <div class="row">
              <div class="medium-8 medium-centered columns">
                <h1 class="text-center white text-shadow"><?php the_title();?></h1>
              </div>
          </div>
        </header> 