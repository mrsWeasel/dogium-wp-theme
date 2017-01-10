<?php
/**
 * The template for displaying dogs
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// TODO: Check if this is needed (user can edit form)
acf_form_head();
get_header();

?>

<header id="page-header">
    <div class="row">
        <div class="medium-8 medium-centered columns">
            <?php 
        	$official_name = get_post_meta($post->ID, 'dgm_official_name', true);

        	if ( !empty($official_name) ) {
          		$official_name = ' <span class="subheader white">' . esc_html($official_name) . '</span>';
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
						$breed = get_post_meta($post->ID, 'dgm_breed', true);
						if ( '' != $breed && $term_other ) : ?>
							<p><strong><?php esc_html_e('Breed:', 'dogium'); ?></strong> <?php echo esc_html($breed); ?></p>
						<?php endif; ?>

						<?php
						$date_of_birth = get_post_meta($post->ID, 'dgm_date_of_birth', true);
							if (!empty($date_of_birth)) {
								$date_of_birth = new DateTime($date_of_birth);
								$date_of_birth = $date_of_birth->format('j.n.Y');
								?>
								<p><strong><?php esc_html_e('Date of birth:', 'dogium'); ?></strong> <?php echo $date_of_birth; ?></p>
								<?php } ?>
						<?php
						$gender = get_post_meta($post->ID, 'dgm_gender', true);
						if ( !empty($gender) ) : ?>
							<p><?php echo esc_html( $gender ); ?></p>
						<?php endif; ?>	
						<?php
						// Check if field exists and if not, create a new array
						$owners = '' !== get_field('dgm_owners') ? get_field('dgm_owners') : array();
						$all_owners = array();

						$other_owners_string = get_post_meta($post->ID, 'dgm_other_owners', true);
						if ('' != ($other_owners_string)) {
						
							$other_owners_string = trim( $other_owners_string );
							$other_owners = explode("\n", $other_owners_string );
						}

						array_unshift($owners, get_the_author_meta('ID'));
						foreach($owners as $owner) {
							array_push ( $all_owners, bp_core_get_userlink( $owner ) );
						}
						
						if ( ! empty( $other_owners ) ) {
							foreach($other_owners as $other_owner) {
								array_push( $all_owners, trim( $other_owner ) );
							}
						}
						$all_owners = implode(', ', $all_owners);
						?>
						<p><strong><?php esc_html_e('Owners:', 'dogium');?></strong> <?php echo $all_owners; ?></p>
						<?php
						// Check if friends / groups have been added as breeders, if not, create an empty array to avoid errors
						$breeder_friends = get_post_meta($post->ID, 'dgm_friends_as_breeders', true);
						$breeder_friends = !empty($breeder_friends) ? $breeder_friends : array();
						$breeder_groups = get_post_meta($post->ID, 'dgm_groups_as_breeders');
						$breeder_groups = !empty($breeder_groups) ? $breeder_groups : array();
						$other_breeders_string = get_post_meta($post->ID, 'dgm_other_breeders', true);

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
						if ( !empty($other_breeders_string) ) {
							$other_breeders_string = trim( $other_breeders_string );
							$other_breeders = explode("\n", $other_breeders_string );
							if ( '' != ( $other_breeders ) ) {
								foreach($other_breeders as $other_breeder) {
									array_push( $all_breeders, trim( $other_breeder ) );
								}
							}
						}

						$all_breeders = implode(', ', $all_breeders);
						if ('' != $all_breeders) : ?>
							<p><strong><?php esc_html_e('Breeders:' , 'dogium'); ?></strong> <?php echo $all_breeders; ?></p>
						<?php endif; ?>
						<?php
						$author = $post->post_author;
	    				$user_domain = bp_core_get_user_domain( $author ) . 'dogs';
	    				?>
						<?php the_content(); ?>
						
							
							<?php 
								// Check if current user has ability to edit / delete post
								if (current_user_can('edit_post', $post->ID)) : ?>
								<a class="button small" data-open="edit-dog-modal"><i class="fa fa-pencil" aria-hidden="true"></i> <?php esc_html_e('Edit', 'dogium'); ?></a>
								<a class="button small alert" data-open="delete-dog-modal"><i class="fa fa-trash" aria-hidden="true"></i> <?php esc_html_e('Delete', 'dogium'); ?></a>
							<?php endif; ?>
						
				</div>
			</div>
		</div>
		
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
		</footer>
		<?php $edit_form = new DogForms; ?>
		<?php $edit_form->print_delete_confirm(); ?>
		<?php $edit_form->print_edit_form(); ?>
		<?php do_action( 'foundationpress_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationpress_after_comments' ); ?>
		<?php
		?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>

<?php get_footer();
