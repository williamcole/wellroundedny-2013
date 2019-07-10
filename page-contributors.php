<?php
/**
 * Template Name: Contributors Page
 */

get_header(); ?>

	<div id="primary" class="site-content full-width">
		<div id="content" role="main">
			<div class="content-wrap">
				<?php the_post(); ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php

				/* LIST CONTRIBUTORS (all authors with published posts) */

				$per_page = 10;
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				//$offset = ($paged - 1) * $per_page;

				$args = array(
					'orderby' => 'display_name',
					'role__not_in' => array('administrator'),
					'paged' => $paged,
					'number' => $per_page,
					'include' => wrny_get_recent_authors_ids(),
				);

				$user_query = new WP_User_Query($args);

				$authors = (array) $user_query->get_results();

				$total_users = $user_query->get_total();
				$max_page = ceil($total_users / $per_page);

				$authors = get_users( $args );

				if( count( $authors ) ) {

					echo '<div id="contributors">';

					foreach( $authors as $author ) {

						// set author ID
						$author_id = $author->ID;

						// only show authors with published posts or galleries
						if( count_user_posts( $author_id ) > 0 ) {

							echo '<div class="contributor-item">';

							// author image
							echo '<div class="contributor-photo">';
							echo '<a href="' . get_author_posts_url( $author_id ) . '">';
							userphoto( $author_id );
							echo '</a>';
							echo '</div>';

							echo '<div class="contributor-content">';
							// author name
							echo '<h5><a href="' . get_author_posts_url( $author_id ) . '">' . $author->display_name . '</a></h5>';

							if ($description = get_the_author_meta('description', $author_id)) {
								echo '<p>' . $description . '</p>';
							}
							echo '</div>';

							echo '</div>';
						}

					}

					echo '</div>';

					if ($more_link = get_next_posts_link('more', $max_page)) {
						echo '<div class="more-link">' . $more_link . '</div>';
					}
				}

				?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>