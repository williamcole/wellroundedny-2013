<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9608618904055688",
    enable_page_level_ads: true
  });
</script>
section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="p:domain_verify" content="b365879402c8ca0f86e5bc9f5d675fc7"/>
<meta name="viewport" content="width=device-width" />
<meta property="fb:pages" content="165619990247657" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<?php

// load newsletter scripts
#wp_enqueue_style( 'newsletter-css', get_stylesheet_directory_uri() . '/css/newsletter.css' );
wp_enqueue_script( 'newsletter', get_stylesheet_directory_uri() . '/js/newsletter.js', array(), '1.0', true );

// load colorbox and cookie scripts to check if a user is visiting site for the first time
// don't load on newsletter pages
if( !is_page_template( 'page-newsletter.php' ) ) {
	wp_enqueue_style( 'jquery-colorbox-css', get_stylesheet_directory_uri() . '/css/jquery.colorbox.css' );
	wp_enqueue_script( 'jquery-colorbox', get_stylesheet_directory_uri() . '/js/jquery.colorbox.js', array(), '1.0', true );
	wp_enqueue_script( 'jquery-cookie', get_stylesheet_directory_uri() . '/js/jquery.cookie.js', array(), '1.0', true );
	wp_enqueue_script( 'cookie-check', get_stylesheet_directory_uri() . '/js/cookie-check.js', array(), '1.0', true );	
}

?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8472816537536944",
        enable_page_level_ads: true
    });
</script>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=914645485268877";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page" class="hfeed site">
	<?php if( function_exists( 'wrny_banner_ad' ) ) wrny_banner_ad(); ?>
	<header id="masthead" class="site-header" role="banner">
		<a href="#" class="nav-opener"><span></span></a>
		<hgroup>
			<div id="header-boxes">				
				<div class="header-da"><?php if( function_exists( 'wrny_ads' ) ) wrny_ads(); ?></div>
				<div class="header-social">
					<div><?php if( function_exists( 'wrny_social_media' ) ) wrny_social_media(); ?></div>
				</div>
				<div style="float:right;">
                    <!-- Begin MailChimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
					<div id="mc_embed_signup">
						
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[4]='FNAME';ftypes[4]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='zip';fnames[1]='MMERGE1';ftypes[1]='date';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
					<!--End mc_embed_signup-->
                </div>
				<br clear="both" />
			</div>
		
			<?php $header_image = get_header_image();
			if( !empty( $header_image ) ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a></h1>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>
			
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			
			<div class="mobile-social-media"><?php if( function_exists( 'wrny_social_media' ) ) wrny_social_media(); ?></div>
			
			<div class="clear"></div>
		</hgroup>

		<div id="search-form-header" class="search-form"><?php get_search_form(); ?></div>
		
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<div id="nav-desktop"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?></div>
			<div id="nav-mobile">
				<div id="search-form-header" class="search-form"><?php get_search_form(); ?></div>
				<?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'menu_class' => 'nav-menu' ) ); ?>
				<div><?php if( function_exists( 'wrny_social_media' ) ) wrny_social_media(); ?></div>
			</div>
		</nav>
		
		<div class="clear"></div>
	</header>

	<div id="main" class="wrapper">