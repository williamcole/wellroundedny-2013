<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

if( is_home() ) {

	// HOME PAGE GALLERY
	global $c, $post;
	$c++;				
					
	?>
	<div class="home-box<?php if( $c % 2 == 0 ) echo ' right'; ?>">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php echo wrny_get_full_width_image(); ?>
			<div class="home-content-bg"></div>
			<div class="home-content">
				<div class="home-title"><?php the_title(); ?></div>
			</div>
		</a>
	</div>
	<?php
	
	if( $c % 2 == 0 ) {
		echo '<div class="clear"></div>';
	}

} else {

	// EVERYTHING ELSE

	?>
	<!-- CONTENT -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<div class="featured-post">
				<?php _e( 'Featured post', 'twentytwelve' ); ?>
			</div>
		<?php endif; ?>
		<header class="entry-header">

			<?php if( is_archive() ) { ?>

				<div class="archive-box">
					
					<?php if ( has_post_thumbnail()) : ?>
					   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('archive'); ?></a>
					<?php else: ?>
						<div class="no-image archive"></div>
					<?php endif; ?>
						
					<?php if ( is_single() ) : ?>
						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1><!--/.entry-title -->
					<?php else : ?>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1><!--/.entry-title -->
                    <?php endif; // is_single() ?>

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				</div>

			<?php } else { ?>
				
				<?php // hide header date, title, excerpt ?>
				<?php if( !get_post_meta( get_the_ID(), 'hide_header_text', true ) ) { ?>
				
					<?php if ( is_single() ) : ?>
						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1><!--/.entry-title -->
					<?php else : ?>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1><!--/.entry-title -->
	                <?php endif; // is_single() ?>
	
	                <div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
	
	                <?php //vince ?>
	                <?php //<a href="http://wellroundedny.com/newsletter/">Click Here to join the WellRounded insider email list.</a> ?>
                
                <?php } ?>

            <?php } ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		
		<?php elseif ( !is_category() ) : ?>
			
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
			
		<?php endif; ?>
		
		<footer class="entry-meta">
			
			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			
			<?php twentytwelve_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description">
                        <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->

	<?php

}

?>