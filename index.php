<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		
			<div id="home-gallery"><?php
				
				/* RESPONSIVE HOME GALLERY */
				
				// load our gallery javascripts and css
				wp_enqueue_script( 'jquery-cycle2', get_stylesheet_directory_uri() . '/js/jquery.cycle2.js' );
				wp_enqueue_script( 'jquery-cycle2-center', get_stylesheet_directory_uri() . '/js/jquery.cycle2.center.js' );
				wp_enqueue_script( 'jquery-cycle2-swipe', get_stylesheet_directory_uri() . '/js/jquery.cycle2.swipe.js' );
				wp_enqueue_script( 'gallery-home', get_stylesheet_directory_uri() . '/js/gallery-home.js', array(), '1.0', true );
				
				// PREVIEW MODE
				// show drafts when user is logged in
				// var also used below for home boxes
				// $post_status = array('publish'); // default
				$post_status = ( is_user_logged_in() ) ? array('publish','draft') : array('publish');
				
				$args = array(
					'category__not_in' => array(6,8), // exclude Bump Envy (6) and Giveaways (8)
					'post_type' => 'post',
					'post_status' => $post_status,
					'posts_per_page' => 3,
				);
				
				$home_gallery = new WP_Query( $args );
				$ids_to_exclude = array();
				
				if( $home_gallery->have_posts() ) :
					
					echo '<div class="cycle-slideshow" 
						data-cycle-fx="fade" 
						data-cycle-pager=".cycle-pager" 
						data-cycle-slides="> div" 
						data-cycle-swipe=true
						data-cycle-timeout="5000" 
						>';
					
					while( $home_gallery->have_posts()) : $home_gallery->the_post();
						
						// save these ids so we can exclude below
						$ids_to_exclude[] = $post->ID;
						
						?>
						
						<div class="new-gallery-item">
				    		<div class="new-gallery-image">
				    			<div class="cycle-image"><a href="<?php the_permalink(); ?>"><?php 
				    				if( has_post_thumbnail() ) {		    					
					    				echo wrny_get_full_width_image();
					    			} else {
					    				// default image for preview mode
						    			echo '<img src="' . get_stylesheet_directory_uri() . '/images/wrny-home-gallery-placeholder.png" width="100%" scale="0">';
					    			}
				    			?></a></div>
				    		</div>
				    		<div class="new-gallery-text">
				    			<div class="new-gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				    			<div class="new-gallery-content"><?php the_excerpt(); ?></div>
				    			<a class="read-more" href="<?php the_permalink(); ?>">READ MORE ></a>
				    			<div class="cycle-pager"></div>
				    		</div>
				    		<div class="new-gallery-text-bg"></div>
				    		<div class="clear"></div>
				    	</div><!--/.new-gallery-item-->
				    	
						<?php
						
					endwhile;
				
					echo '</div><!--/.cycle-slideshow-->';
					echo '<div class="clear"></div>';
				
				endif;
				
				wp_reset_query();
								
			?></div>
			
			<?php
			
			/* HOMEPAGE TOUT - Registry Picks */
			$args = array(
				'post_type' => 'post',
				'post_status' => $post_status,
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'key'     => 'display_on_homepage',
						'value'   => 1,
						'compare' => '=',
					),
				),
			);
			
			$home_tout = new WP_Query( $args );
			
			if( $home_tout->have_posts() ) {
				while( $home_tout->have_posts()) : $home_tout->the_post();
					
					$img_desktop = get_post_meta( get_the_ID(), 'homepage_image_desktop', true );
					$img_mobile = get_post_meta( get_the_ID(), 'homepage_image_mobile', true );
					
					// set mobile img to desktop if not set
					$img_desktop_url = !empty( $img_desktop['guid'] ) ? $img_desktop['guid'] : false;
					$img_mobile_url = !empty( $img_mobile['guid'] ) ? $img_mobile['guid'] : $img_desktop_url;
					
					// make sure at least one image exists
					if( !empty( $img_desktop_url ) || !empty( $img_mobile_url ) ) {
						?>
						<div id="homepage-tout">
							<?php if( !empty( $img_desktop_url ) ) { ?>
								<a class="homepage-tout-img-desktop" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $img_desktop_url; ?>" width="100%" height="auto"></a>
							<?php } ?>
							<?php if( !empty( $img_mobile_url ) ) { ?>
								<a class="homepage-tout-img-mobile" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $img_mobile_url; ?>" width="100%" height="auto"></a>
							<?php } ?>
						</div><!--/#homepage-tout-->
						<?php
					}
				endwhile;
			}
			
			wp_reset_query();
			
			?>
			
			<div id="home-boxes"><?php
			
				/* HOME BOXES */
				
				$args = array(
					'category__not_in' => array(6,8), // exclude Bump Envy (6) and Giveaways (8)
					'post_type' => 'post',
					'post_status' => $post_status,
					'posts_per_page' => 8,
					'post__not_in' => $ids_to_exclude
				);
				
				$home_boxes = new WP_Query( $args );
				$c = 0;
				
				if( $home_boxes->have_posts() ) {
					while( $home_boxes->have_posts()) : $home_boxes->the_post();
					
						$c++;				
					
						?>
						<div class="home-box<?php if( $c % 2 == 0 ) echo ' right'; ?>">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
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
						
					endwhile;
				}
				
				// dont reset query, interferes with Bump Envy widget
				//wp_reset_query();
				
			?></div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>