<?php
/**
 * The template for displaying dogs
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
acf_form_head();
get_header();?>

<header id="page-header">
    <div class="row">
        <div class="medium-8 medium-centered columns">
            <?php 
        	$official_name = '';
        	if ( get_field('dgm_official_name') ) {
          		$official_name = ' <span class="subheader white">' . esc_html(get_field('dgm_official_name')) . '</span>';
        	}
        	?>
        	<h1 class="text-center white text-shadow"><?php the_title();?><?php echo $official_name; ?></h1>
        </div>
    </div>
</header> 

<div id="single-dog" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<div class="extended row">
			<div class="medium-5 columns">
			<?php if (has_post_thumbnail($post)) {
				the_post_thumbnail('featured-small');
			} ?>
			</div>
			<div class="medium-7 columns">
				
				<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
					<div class="entry-content">
						<?php

						$term_other = dogium_get_dog_terms($post->ID);
						
						if ( get_field('dgm_breed') && $term_other ) : ?>
							<?php
							$breed = esc_html( get_field('dgm_breed') );	
							?>
							<p><strong><?php esc_html_e('Breed:', 'dogium'); ?></strong> <?php echo $breed; ?></p>
						<?php endif; ?>

						<?php
						if ( get_field('dgm_date_of_birth') ) : ?>
							<?php 
							$date_of_birth = esc_html( get_field('dgm_date_of_birth') ); 
							$date_of_birth = new DateTime($date_of_birth);
							$date_of_birth = $date_of_birth->format('j.n.Y');
							?>
							<p><strong><?php esc_html_e('Date of birth:', 'dogium'); ?></strong> <?php echo $date_of_birth; ?></p>
						<?php endif; ?>

						<?php
						if ( get_field('dgm_gender') ) : ?>
							<?php $gender = esc_html( get_field('dgm_gender') ); ?>
							<p><?php echo $gender; ?></p>
						<?php endif; ?>	
						<?php
						// Check if field exists and if not, create a new array
						$owners = '' !== get_field('dgm_owners') ? get_field('dgm_owners') : array();
						$other_owners = '';
						$all_owners = array();

						if ( get_field('dgm_other_owners') ) {
							$other_owners_string = trim( get_field('dgm_other_owners') );
							$other_owners = explode("\n", $other_owners_string );
							$other_owners = array_filter($other_owners, 'trim');
						}

						array_unshift($owners, get_the_author_meta('ID'));
						foreach($owners as $owner) {
							array_push ( $all_owners, bp_core_get_userlink( $owner ) );
						}
						
						if ( '' != $other_owners ) {
							foreach($other_owners as $other_owner) {
								array_push( $all_owners, trim($other_owner) );
							}
						}
						$all_owners = implode(', ', $all_owners);
						?>
						<p><strong><?php esc_html_e('Owners:', 'dogium');?></strong> <?php echo $all_owners; ?></p>
						<?php
						// Check if friends / groups have been added as breeders, if not, create an empty array to avoid errors
						$breeder_friends = '' != get_field('dgm_friends_as_breeders') ? get_field('dgm_friends_as_breeders') : array();
						$breeder_groups = '' != get_field('dgm_groups_as_breeders') ? get_field('dgm_groups_as_breeders') : array();
						$other_breeders = '';
						$all_breeders = array();

						// First, add breeder friends
						foreach($breeder_friends as $breeder_friend) {
							array_push( $all_breeders, bp_core_get_userlink( $breeder_friend ) );
						}

						// Then group breeders
						foreach($breeder_groups as $breeder_group) {
							$group = groups_get_group( array( 'group_id' => $breeder_group) );
							$group_name = $group->name;
							$group_permalink = trailingslashit( bp_get_root_domain() . '/' . bp_get_groups_root_slug() . '/' . $group->slug . '/' );
							$group_permalink = esc_url($group_permalink);
							array_push( $all_breeders, "<a href='{$group_permalink}'>{$group_name}</a>" );
						}

						// Lastly, other breeders
						if ( get_field('dgm_other_breeders') ) {
							$other_breeders_string = trim( get_field('dgm_other_breeders') );
							$other_breeders = explode("\n", $other_breeders_string );
							$other_breeders = array_filter($other_breeders, 'trim');
						}
						if ( '' != $other_breeders ) {
							foreach($other_breeders as $other_breeder) {
								array_push( $all_breeders, trim($other_breeder) );
							}
						}

						$all_breeders = implode(', ', $all_breeders);

						?>
						<p><strong><?php esc_html_e('Breeders:' , 'dogium'); ?></strong> <?php echo $all_breeders; ?></p>
						<?php the_content(); ?>
						<?php
						$current_user_id = get_current_user_id();
						$post_author_id = get_post_field('post_author', $post);
							if ($current_user_id == $post_author_id) {
								// tähän muokkaus / poisto + wp-nonce
							}
						?>

						<?php acf_form(); ?>

						<?php
						if (current_user_can('administrator')) {
							edit_post_link( __( 'Backend editor', 'dogium' ), '<span class="edit-link">', '</span>' );
						}
						?>
				</div>
			</div>
		</div>
		
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>

		<?php do_action( 'foundationpress_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>
<?php get_footer();
