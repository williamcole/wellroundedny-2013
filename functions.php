<?php

############
# INCLUDES #
# ##########

require_once( dirname( __FILE__ ) .'/inc/admin.php' );
require_once( dirname( __FILE__ ) .'/inc/ads.php' );
require_once( dirname( __FILE__ ) .'/inc/newsletter.php' );
require_once( dirname( __FILE__ ) .'/inc/picks.php' );
require_once( dirname( __FILE__ ) .'/inc/pinterest.php' );
require_once( dirname( __FILE__ ) .'/inc/widgets.php' );

###########
# TESTING #
# #########

function wrny_init() {
	if( wrny_is_testing() ) {
		// temporary stylesheet
		//add_filter( 'stylesheet_uri', 'wrny_stylesheet_uri', 10, 2 );
	}
}
//add_action( 'init', 'wrny_init' );

// test function for admin Will
function is_wbc3() {
	$bool = false;
	$user = wp_get_current_user();
	if( $user && isset( $user->user_login ) && ( 'williambcole@gmail.com' == $user->user_email ) ) $bool = true;
	return $bool;	
}

function wrny_is_testing() {
	if( is_wbc3() || is_user_logged_in() ) {
		return true;
	} else {
		return false;
	}
}

// override stylesheet, useful for testing
function wrny_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
    return $stylesheet_dir_uri . '/style.new.css';
}

function wrny_remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'wrny_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'wrny_remove_cssjs_ver', 10, 2 );

################
# POST FORMATS #
################

function wrny_twentytwelve_setup() {
	// add_theme_support( 'post-formats', array( 'gallery' ) );
	remove_theme_support( 'post-formats', array( 'gallery' ) );
}
add_action( 'after_setup_theme', 'wrny_twentytwelve_setup', 999 );


#########
# FONTS #
#########

function wrny_enqueue_styles() { 
	
	// CSS
	//wp_register_style( 'bebas-neue', get_stylesheet_directory_uri() . '/fonts/bebas-neue-fontfacekit/stylesheet.css' );
	//wp_enqueue_style( 'bebas-neue' );
	wp_register_style( 'gandhi-serif', get_stylesheet_directory_uri() . '/fonts/gandhi-serif-fontfacekit/stylesheet.css' );
	wp_enqueue_style( 'gandhi-serif' );
	wp_register_style( 'roboto', get_stylesheet_directory_uri() . '/fonts/roboto-fontfacekit/stylesheet.css' );
	wp_enqueue_style( 'roboto' );
	wp_register_style( 'neoretro', get_stylesheet_directory_uri() . '/fonts/NeoRetroDraw-fontfacekit/stylesheet.css' );
	wp_enqueue_style( 'neoretro' );

	//Font Awesome
	wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome' );

	// Editors Picks
	#wp_register_style( 'picks', get_stylesheet_directory_uri() . '/css/picks.css' );
	#wp_enqueue_style( 'picks' );

	// JS
	wp_enqueue_script( 'site', get_stylesheet_directory_uri() . '/js/site.js', array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'wrny_enqueue_styles' );

function wrny_admin_enqueue_scripts() { 
	
	// Editors Picks
	wp_register_style( 'admin-picks', get_stylesheet_directory_uri() . '/css/admin-picks.css' );
	wp_enqueue_style( 'admin-picks' );
}
add_action( 'admin_enqueue_scripts', 'wrny_admin_enqueue_scripts' );

/*
function wrny_admin_scripts() {    
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}

function wrny_admin_styles() {
    wp_enqueue_style('thickbox');
}

// better use get_current_screen(); or the global $current_screen
if (isset($_GET['page']) && $_GET['page'] == 'post') {
    add_action( 'admin_print_scripts', 'wrny_admin_scripts' );
    add_action( 'admin_print_styles', 'wrny_admin_styles' );
}
*/

##########
# IMAGES #
##########

// add_image_size( 'name', 300, 100, false );
add_image_size( 'ad', 240, 120, true );
add_image_size( 'horz', 400, 9999, false );
add_image_size( 'medium', 300, 200, true );
add_image_size( 'medium-square', 300, 300, true );
add_image_size( 'widget', 340, 464, true );
add_image_size( 'archive', 300, 100, true );
add_image_size( 'similar', 150, 100, true );
add_image_size( 'article-gallery', 500, 500, true );
add_image_size( 'home-gallery', 644, 322, true );
add_image_size( 'author-thumb', 100, 100, true );

function wrny_get_full_width_image() {

	global $post;
	$html = '';
	
	# TODO: add options for image size, link, and fallback image
	
	if( has_post_thumbnail( $post->ID ) ) {
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-gallery' );
		$html = '<img src="' . $image_src[0]  . '" width="100%"  />';
	}
	
	return $html;
	
}


// fix http error on image upload
function wrny_change_graphic_lib($array) {
	return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}
add_filter( 'wp_image_editors', 'wrny_change_graphic_lib' );


##########
# HEADER #
##########

# TODO: make favicon image for this

// favicon
function wrny_favicon_link() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />' . "\n";
}
// add_action( 'wp_head', 'wrny_favicon_link' );

// write the markup for social media buttons
function wrny_social_media() {
	echo '<div class="social-media">
		<a class="email" href="'.esc_url( home_url( '/newsletter' ) ) . '">Email Newsletter Signup</a>
		<a class="facebook" href="http://facebook.com/wellroundedny" target="_blank">Facebook</a>
		<a class="twitter" href="https://twitter.com/WellRoundedNY" target="_blank">Twitter</a>
		<a class="instagram" href="https://instagram.com/wellroundedny/" target="_blank">Instagram</a>
		<a class="pinterest" href="http://pinterest.com/wellroundedny/" target="_blank">Pinterest</a>
	</div>';
}


##########
# FOOTER #
##########

function wrny_footer_text() {

	$footer_text = get_option( 'wrny_footer_text' );
	
	// display year
	$footer_text = str_replace( '[year]', date( 'Y' ), $footer_text );
	
	if( isset( $footer_text ) ) {
		echo $footer_text;
	}
	
}


###########
# CONTENT #
###########

/*
// customize the title (DEPRECATED)
function wrny_title( $title ) {
	
	if( in_category( 'Bump Envy' ) ) {
		//$title = str_replace( '5Qs With', '<span class="bump-text>NAME</span>', $title );
	} 
	
	return $title;
}
add_filter( 'the_title', 'wrny_title' );
*/

// customize the content
function wrny_content( $content ) {
	
	// hide post content on home page
	if( is_home() || is_archive() ) return;
	
	// kill gallery shortcode
	if( strpos( $content, '[gallery') !== false ) {
		//$content = strip_shortcodes( $content );
	}

	return $content;
}
add_filter( 'the_content', 'wrny_content' );

// insert the post thumbnail at the top of the content so Pinterest hover tag appears
function wrny_the_post_thumbnail( $content ) {
	
	global $post;

	if( in_category('picks', $post ) ) {
		return $content;
	}

	if( is_single() && has_post_thumbnail() && !get_post_meta( get_the_ID(), 'hide_top_featured_image', true ) ) {
	
		// check if this is a Bump Envy post
		$is_bump_envy = false;
		$categories = get_the_category();
		foreach( $categories as $category ) {
			if( $category->cat_name == 'Bump Envy' ) $is_bump_envy = true;
		}
		
		$img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		
		if( get_post_meta( get_the_ID(), 'display_vertical_image', true ) || $is_bump_envy ) {
		
			// right floated vertical image
			$content = '<img class="entry-vertical-image" src="' . $img_url . '">' . $content;
			
		} else {
		
			// full width image
			$content = '<div class="featured-image"><img src="' . $img_url . '"></div>' . $content;

		}
		
	}
	
	return $content;

}
add_filter( 'the_content', 'wrny_the_post_thumbnail' );

// customize the category title
function wrny_get_category_title() {
	
	// get category title
	$title = single_cat_title( '', false );
	
	// check if this is a Trimester category
	if( is_category( array( 2,3,4 ) ) ) {
		
		// determine active category
		$this_cat = '';
		if( is_category( 2 ) ) $this_cat = 't1';
		if( is_category( 3 ) ) $this_cat = 't2';
		if( is_category( 4 ) ) $this_cat = 't3';
		
		$title = '';
		$title .= '<span class="trimester-title">';
		$title .= 'Tips By Trimester';
		$title .= '<span class="trimester-nav ' . $this_cat . '">
			<a class="l1" href="' . home_url( '/category/1st-trimester/' ) . '">1</a>
			<a class="l2" href="' . home_url( '/category/2nd-trimester/' ) . '">2</a>
			<a class="l3" href="' . home_url( '/category/3rd-trimester/' ) . '">3</a>
		</span>';
		$title .= '</span>';
	
	}
	
	return $title;

}



########
# HOME #
########

# TODO: integrate into index.php, content.php, etc/
function wrny_home_box_markup( $c ) {

	global $post;
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
}

###########
# GALLERY #
###########

// override gallery shortcode so we can customize it
function wrny_gallery_shortcode( $attr ) {
	
	global $post;
	
	// get featured img id to exclude
	$featuredID = get_post_thumbnail_id();
	static $instance = 0;
	$instance++;
	
	if( !empty($attr['ids'] ) ) {
		if( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}
	
	$output = apply_filters( 'post_gallery', '', $attr );
	
	if( $output != '' ) {
		return $output;
	}
	
	if( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if( !$attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}
	
	extract( shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => '',
		'icontag'    => '',
		'captiontag' => '',
		'columns'    => 3,
		'size'       => 'article-gallery',
		'include'    => '',
		'exclude'    => ''
	), $attr ) );
	
	$id = intval( $id );
	
	if( $order === 'RAND' ) {
		$orderby = 'none';
	}
	
	// get the attachments
	if( !empty( $include ) ) {
		
		$_attachments = get_posts( array(
			'include' => $include,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $order,
			'orderby' => $orderby
		) );
		
		$attachments = array();
		
		foreach( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
		
	} elseif( !empty( $exclude ) ) {
		
		$attachments = get_children( array(
			'post_parent' => $id,
			'exclude' => $exclude,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $order,
			'orderby' => $orderby
		) );
		
	} else {
		
		$attachments = get_children( array( 
			'post_parent' => $id,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $order,
			'orderby' => $orderby
		) );
		
	}
	
	if( empty( $attachments ) ) {
		$attachments = get_posts( $args );
	}
	
	// html markup for gallery
	if( $attachments ) {
	
		// RESPONSIVE GALLERY
			
		// load our gallery javascripts and css
		wp_enqueue_script( 'jquery-scrollpane', get_stylesheet_directory_uri() . '/js/jquery.scrollpane.js', array(), '1.0', true );
		wp_enqueue_script( 'jquery-mousewheel', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.js', array(), '1.0', true );
		wp_enqueue_style( 'jquery-scrollpane-css', get_stylesheet_directory_uri() . '/css/jquery.scrollpane.css' );
		wp_enqueue_script( 'jquery-cycle2', get_stylesheet_directory_uri() . '/js/jquery.cycle2.js' );
		wp_enqueue_script( 'jquery-cycle2-center', get_stylesheet_directory_uri() . '/js/jquery.cycle2.center.js' );
		wp_enqueue_script( 'jquery-cycle2-swipe', get_stylesheet_directory_uri() . '/js/jquery.cycle2.swipe.js' );
		wp_enqueue_script( 'gallery', get_stylesheet_directory_uri() . '/js/gallery.js', array(), '1.0', true );
		
		$output .= '<div class="cycle-slideshow" 
			data-cycle-fx="fade" 
			data-cycle-pager=".cycle-pager" 
			data-cycle-slides="> div" 
			data-cycle-swipe=true
			data-cycle-timeout="0" 
			>';
		
		foreach( $attachments as $attachment ) {
			
			// get image data
		   	$image_array = image_downsize( $attachment->ID, 'article-gallery' );
		   	$image = $image_array[0];
			$image_width = $image_array[1];
			$image_height = $image_array[2];
			
			// markup for each gallery item
			$output .= '    	
		    	<div class="new-gallery-item">
		    		<div class="new-gallery-image">
		    			<div class="cycle-image"><img src="' . $image . '" img-height="' . $image_height .'"></div>
		    			<div class="cycle-pager"></div>
	    			</div>
		    		<div class="new-gallery-text">
		    			<div class="scroll-pane">
		    				<div class="new-gallery-title">' . $attachment->post_excerpt . '</div>
		    				<div class="new-gallery-content">' . $attachment->post_content . '</div>
		    			</div>
		    		</div>
		    		<div class="clear"></div>
		    	</div><!--/.new-gallery-item-->
		    ';
		}
		
	    $output .= '</div><!--/.cycle-slideshow-->';
		
	}
	
	return $output;

}
add_shortcode( 'gallery', 'wrny_gallery_shortcode' );

// similar stories
function wrny_similar_stories(){

	if( !get_post_meta( get_the_ID(), 'hide_similar_stories', true ) ) {

		// get prev and next post ids to exclude
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		
		$orig_post = $post;
		global $post;
		
		$categories = get_the_category( $post->ID );
		
		if( $categories ) {
			
			// get categories
			$category_ids = array();				
			foreach( $categories as $individual_category ) {
				$category_ids[] = $individual_category->term_id;
			}
			
			$args = array(
				'orderby' => 'rand',
				'category__in' => $category_ids,
				'post__not_in' => array( $post->ID, $prev_post->ID, $next_post->ID ),
				'posts_per_page' => 3,
			);
			
			$similar_posts = new WP_Query( $args );
			
			if( $similar_posts->have_posts() ) {
			
				echo '<div id="similar-stories">';
				echo '	<h3>Similar Stories</h3>';
				echo '		<ul>';

				while( $similar_posts->have_posts() ) {
					
					$similar_posts->the_post();
					
					// get image
					$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $similar_posts->ID ), 'medium' );
					$image = $image_array[0];
					
					?>
					<li>
						<div class="similar-image"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>"></a></div>
						<div class="similar-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
					</li>
					<?php
					
				}
				
				echo '		</ul>';
				echo '	</div>';
			
			}
		
		}
		
		// reset post
		$post = $orig_post;
		wp_reset_query();			

	}
	
}

// share buttons
function wrny_share_buttons() {
	
	if( !get_post_meta( get_the_ID(), 'hide_share_buttons', true ) ) {
	
		if( function_exists( do_sociable() ) ) {
			echo '<div id="share-buttons">';
			do_sociable();
			echo '</div><!--/#share-buttons-->';
		}
		
	}
	
}

// display the author info
function wrny_author_info() {
	
	if( !get_post_meta( get_the_ID(), 'hide_author_info', true ) ) {
	
		echo '<div id="author-info">';
		
		if( function_exists( 'coauthors' ) ) {
			$coauthors = get_coauthors();
			
			foreach( $coauthors as $coauthor ) {
			
				// set some vars
				$name = $coauthor->display_name;
				$bio = $coauthor->description;
				$url = get_home_url() . '/author/' . $coauthor->user_nicename;
				
				if( $coauthor->type == 'guest-author' ) {
					// guest author
					$author_id = $coauthor->ID;
				} else {
					// wp user
					$author_id = get_the_author_meta( 'ID', $coauthor->ID );
				}
				
				// author box
				echo '	<div class="author-info-box">';
				echo '		<a href="' . $url . '">';

				userphoto_the_author_thumbnail();				
				
				/*
				if( has_post_thumbnail( $author_id ) ) {
					echo get_the_post_thumbnail( $author_id, 'author-thumb' );
				} else {
					userphoto_the_author_thumbnail();				
				}
				*/
				
				echo '		</a>';				
				echo '		<h3><a href="' . $url . '">' . $name . '</a></h3>';
				echo '		<p>' . $bio . '</p>';
				echo '		<div class="clear"></div>';
				echo '	</div><!--.author-info-box-->';
				
			}
		
		}
		
		echo '</div><!--#author-info-->';
		
	}
	
}

// category link
function wrny_category_link() {
	
	$category = get_the_category(); 
	
	if( $category[0] ) {
		
		echo '<div class="category-link">';
		echo 'Click Here For More ';
		
		$c = 0;
		
		foreach( $category as $cat ) {
			
			// ignore Uncategorized
			if( $cat->cat_name == 'Uncategorized' ) continue;
			
			// output
			if( $c > 0 ) echo ' / ';
			echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a>';
			$c++;
			
		}
		
		echo '</div>';
		
	}
		
}

###########
# ARCHIVE #
###########

function wrny_the_excerpt( $excerpt ) {
	
	// set character limit on archive pages
	if( is_archive() || is_search() ) {
		
		$char_limit = 60;
		
		if( strlen( $excerpt ) > $char_limit ) {
			$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
			$excerpt = strip_shortcodes($excerpt);
			$excerpt = strip_tags($excerpt);
			$excerpt = substr($excerpt, 0, $char_limit);
			$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
			$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
			$excerpt = $excerpt.'...';
			//$excerpt = '<a href="'.$permalink.'">more</a>';
		}
		
	}
		
	return $excerpt;
}
add_filter( 'the_excerpt', 'wrny_the_excerpt' );


##########
# SEARCH #
##########

/**
 * Include posts from authors in the search results where
 * either their display name or user login matches the query string
 *
 * @author danielbachhuber
 */
function wrny_db_filter_authors_search( $posts_search ) {

	// Don't modify the query at all if we're not on the search template
	// or if the LIKE is empty
	if ( !is_search() || empty( $posts_search ) )
		return $posts_search;

	global $wpdb;
	// Get all of the users of the blog and see if the search query matches either
	// the display name or the user login
	add_filter( 'pre_user_query', 'wrny_db_filter_user_query' );
	$search = sanitize_text_field( get_query_var( 's' ) );
	$args = array(
		'count_total' => false,
		'search' => sprintf( '*%s*', $search ),
		'search_fields' => array(
			'display_name',
			'user_login',
		),
		'fields' => 'ID',
	);
	$matching_users = get_users( $args );
	remove_filter( 'pre_user_query', 'wrny_db_filter_user_query' );
	// Don't modify the query if there aren't any matching users
	if ( empty( $matching_users ) )
		return $posts_search;
	// Take a slightly different approach than core where we want all of the posts from these authors
	$posts_search = str_replace( ')))', ")) OR ( {$wpdb->posts}.post_author IN (" . implode( ',', array_map( 'absint', $matching_users ) ) . ")))", $posts_search );
	return $posts_search;
}
add_filter( 'posts_search', 'wrny_db_filter_authors_search' );

/**
 * Modify get_users() to search display_name instead of user_nicename
 */
function wrny_db_filter_user_query( &$user_query ) {

	if ( is_object( $user_query ) )
		$user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
	return $user_query;
}


############
# COMMENTS #
############

// override twentytwelve function
function twentytwelve_comment( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				
				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->
				
				<header class="comment-meta comment-author vcard">
					<?php
						printf( '<time datetime="%1$s">%2$s</time>',
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s', 'twentytwelve' ), get_comment_date( 'F j, Y' ) )
						);
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
						);
						
					?>
				</header><!-- .comment-meta -->
	
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
				<?php endif; ?>
				
			</article><!-- #comment-## -->
			<?php
		break;
	endswitch; // end comment_type check
}

// remove the url field from comments
function wrny_remove_website_field( $fields ) {
	if( isset( $fields['url'] ) )
	unset( $fields['url'] );
	return $fields;
}
#add_filter( 'comment_form_default_fields', 'wrny_remove_website_field' );

// get commenter name and email address
function wrny_get_commenter_info( $comment ) {
	
	if( !isset( $comment ) )
		return;
	
	$name = $comment->comment_author;
	$email = $comment->comment_author_email;
	$commenter = $name . ' &mdash; ' . $email;
	
	return $commenter;
}


function wrny_get_recent_authors_ids() {
	global $wpdb;

	$recent_authors = $wpdb->get_col("
		SELECT
			u.ID
		FROM {$wpdb->posts} as p
		INNER JOIN {$wpdb->users} as u ON u.ID = p.post_author
		WHERE
			TIMESTAMPDIFF(YEAR, p.post_date_gmt, UTC_TIMESTAMP()) < 1
			AND p.post_status = 'publish'
		GROUP BY u.ID
	");

	return !empty($recent_authors) ? $recent_authors : array(-1);
}

// extract JetPack pageviews
// courtesy of Topher: http://wpgr.org/2013/03/02/rendering-jetpack-stats/
function get_page_views($post_id) {
 
	if (function_exists('stats_get_csv')) {
	
		$args = array('days'=>-1, 'limit'=>-1, 'post_id'=>$post_id);
		$result = stats_get_csv('postviews', $args);
		$views = $result[0]['views'];
 
	} else {
 
		$views = 0;
 
	}
	return number_format_i18n($views);
}