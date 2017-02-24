<?php

function dogium_list_event_categories( $parent_term_slug ) {
  /**
   * @param string $parent_term_slug
   * @return array of term objects
   * @author Laura Heino
   */

  $parent_term = get_term_by( 'slug', $parent_term_slug, 'event-categories' );
  $parent_term_id = $parent_term->term_id;

  // Bail if term doesn't exist
  if ( !$parent_term || ! term_exists( $parent_term_slug ) ) {
    return;
  }

  $event_cats = get_terms( array(
  'taxonomy' => 'event-categories',
  'hide_empty' => false,
  'parent' => intval( $parent_term_id ),
  'orderby' => 'term_order'
  ) );

  $title = get_term( $parent_term )->name; ?>

  <?php $has_children = get_term_children( intval( $parent_term_id ), 'event-categories' ); ?>
  <div class="widget widget_categories">
  <h2 class="secondary-title"><?php echo esc_html( $title ); ?></h2>
    <ul class="no-bullet">
    <?php if ( ! $has_children ) : ?>
      <?php $term_link = get_term_link($parent_term_id); ?>
      <li class="cat-item"><a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $title ); ?></a></li>
    <?php elseif ( $event_cats ) : ?>
    <?php
      foreach( $event_cats as $event_cat ) : ?>
      <?php $term_link = get_term_link($event_cat->term_id); ?>
      <li class="cat-item"><a href="<?php echo esc_url( $term_link ); ?>"><?php echo $event_cat->name; ?></a></li>
    <?php endforeach; ?>
    <?php endif; ?>
    </ul>
  </div> 
<?php }
