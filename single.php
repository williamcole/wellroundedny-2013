<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php wp_enqueue_script( 'pinterest', get_stylesheet_directory_uri() . '/js/pinterest.js', array(), '1.0', true ); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php

				if( in_category('picks') ) {
					
					// Editors Picks
					get_template_part( 'content-picks', get_post_format() );
				
				} else {
				
					// content
					get_template_part( 'content', get_post_format() );
					
					// share buttons
					#wrny_share_buttons();

					if( get_post_type() !== 'press' ) {
					
						// author info
						wrny_author_info();
						
						// similar stories
						wrny_similar_stories();
						
						// category link
						wrny_category_link();

					}

					?>
				
					<nav class="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
						
						<?php
						
						$prev_post = get_previous_post();
						if( !empty( $prev_post ) ) {
							?>
							<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span>%title<span class="excerpt">'.$prev_post->post_excerpt.'</span>' ); ?></span>
							<?php
						}
						
						$next_post = get_next_post();
						if( !empty( $next_post ) ) {
							?>
							<span class="nav-next"><?php next_post_link( '%link', '%title<span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span><span class="excerpt">'.$next_post->post_excerpt.'</span>' ); ?></span>
							<?php
						}
						
						?>
					</nav><!-- .nav-single -->
					
					<?php comments_template( '', true ); ?>
				
				<?php

				}
	
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_template_part('blocks/social-share'); ?>

<?php get_footer(); ?>