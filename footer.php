<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	</div><!-- #main .wrapper -->
	<?php if (is_single()) : ?>
	<div class="chat-holder">
		<a href="#" class="btn-chat"><span class="fa fa-close"></span></a>
		<b class="title">CONVERSATIONS</b>
		<div class="iframe-box">
			<div class="fb-comments" data-href="<?php echo get_permalink(); ?>" data-width="500" data-numposts="5"></div>
		</div>
	</div>
	<?php endif; ?>

	<footer id="colophon" role="contentinfo">
		<?php

		// get footer nav items
		$nav_items = wp_get_nav_menu_items( 'Footer Menu', $args );
		
		$c = 0;
		$count = count( $nav_items );
		$cols = 4;
		
		echo '<div id="footer-nav">';
		echo '	<div class="footer-col">';
		
		foreach( $nav_items as $item ) {
		
			$c++;
			
			// output link or spacer
			if( $item->title == 'Spacer' ) {
				echo '<a class="spacer">&nbsp;</a>';
			} else {
				echo '<a href="' . $item->url . '">' . $item->title . '</a>';
			}
			
			// column break
			if( ( $c % $cols == 0 ) && ( $c !== $count ) ) {
				echo '</div><!--.footer-col-->';
				echo '<div class="footer-col">';
			}
			
		}
		
		echo '	</div><!--.footer-col-->';
		echo '</div><!--#footer-nav-->';
				
		#wp_nav_menu( array( 'menu' => 'Footer Menu' ) );
		
		?>
		<div class="site-info"><?php wrny_footer_text(); ?></div><!-- .site-info -->		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if( !is_page_template( 'page-newsletter.php' ) && !is_page_template( 'page-mailchimp.php' ) ) { ?>
	<div style="display:none">
		<div id="newsletter-overlay">		
			<div id="newsletter-content"><?php
				echo wrny_get_newsletter_overlay();
			?></div>
		</div>
	</div>
<?php } ?>

<?php wp_footer(); ?>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-63959409-1', 'auto');
    ga('send', 'pageview');

</script>

</body>
</html>