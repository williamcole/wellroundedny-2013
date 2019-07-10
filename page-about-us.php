<?php
/**
 * Template Name: About Us Page
 */

get_header(); ?>

	<div id="primary" class="site-content full-width">
		<div id="content" role="main">
			<div class="content-wrap">
				<div class="main-content">
					<?php while ( have_posts() ) : the_post(); ?>

						<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php
						if( has_post_thumbnail() ) {
							$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							echo '<div class="about-image"><img src="' . $image_src[0]  . '" width="100%"  /></div>';
						}
						?>

						<?php get_template_part( 'content', 'page' ); ?>

					<?php endwhile; // end of the loop. ?>
				</div>

				<?php

				/* LIST CONTRIBUTORS */
				
				// include all admins
				//$include_ids = explode(',', get_option( 'section_name_administrators order') );
				
				// include defined list of contributors
				$include_ids = array(3,4,788,862,863,105,752,838,749,856,852,866,867,638);
				
				// exclude users from list (WILL admin = 859)
				$exclude_ids = array(859);
				
				$args = array(
					'orderby' => 'include',
					'role' => 'administrator',
                    'include' => $include_ids,
                    //'exclude' => $exclude_ids
				);

				$authors = get_users( $args );

				if( count( $authors ) ) {

					echo '<div id="team" data="' . get_current_user_id() . '">';
					echo '<h2>The Team</h2>';

					foreach( $authors as $author ) {

						// set author ID
						$author_id = $author->ID;

						// only show authors with published posts or galleries
						//if( count_user_posts( $author_id ) > 0 ) {

							echo '<div class="team-item">';

							// author image
							echo '<div class="team-photo">';
							echo '<a href="' . get_author_posts_url( $author_id ) . '">';
							userphoto( $author_id );
							echo '</a>';
							echo '</div>';

							// author name
							echo '<h5><a href="' . get_author_posts_url( $author_id ) . '">' . $author->display_name . '</a></h5>';

							if ($description = get_the_author_meta('description', $author_id)) {
								echo '<p>' . $description . '</p>';
							}

							echo '</div>';
						//}

					}

					echo '</div>';
				}

				?>

				<?php if ($contributors_page = get_page_by_path('contributors')) : ?>
					<a href="<?php echo get_permalink($contributors_page->ID); ?>" class="our-contributors-link">
						Meet our contributors
					</a>
				<?php endif; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>