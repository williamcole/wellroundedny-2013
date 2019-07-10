<?php

##############
# NEWSLETTER #
##############

// newsletter overlay
function wrny_get_newsletter_overlay() {
	
	// logo image
	echo '<img class="logo" src="' . get_stylesheet_directory_uri() . '/images/newsletter-logo.png">';

	// mailchimp form
	wrny_mailchimp_form();
	
}

// UPDATED Aug 31 2018
// utility function to display html markup for the mailchimp newsletter signup form
function wrny_mailchimp_form() {
	
	$content = '';
	$mailchimp = get_post(36923); // newsletter page id
	if( $mailchimp ) $content = $mailchimp->post_content;
	
	?>
	<!-- Begin MailChimp Signup Form -->
	<div id="mc_embed_signup">
		<form action="//wellroundedny.us7.list-manage.com/subscribe/post?u=df8b192ae5d9a5d1ff7f26265&amp;id=5fffe747ff" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		
		    <div id="mc_embed_signup_scroll">
			
				<div class="newsletter-intro"><?php echo $content; ?></div>
								
				<div class="mc-field-group email">
					<!-- <label for="mce-EMAIL">Email Address</label> -->
					<input type="email" value="" placeholder="EMAIL" name="EMAIL" class="required email" id="mce-EMAIL">
				</div>
				<div class="mc-field-group half full-name">
					<!-- <label for="mce-MMERGE2">Full Name </label> -->
					<input type="text" value="" placeholder="FULL NAME" name="MMERGE2" class="required helper-text" id="mce-MMERGE2">
				</div>
				<div class="mc-field-group half zip-code">
					<!-- <label for="mce-MMERGE3">Zip Code </label> -->
					<input type="text" value="" placeholder="ZIP CODE" name="MMERGE3" class="required" id="mce-MMERGE3">
				</div>
				<div class="mc-field-group half due-date">
					<div class="datefield">
						<span class="subfield monthfield"><input class="datepart required" type="text" pattern="[0-9]*" value="" placeholder="MM" size="2" maxlength="2" name="MMERGE1[month]" id="mce-MMERGE1-month"></span> / 
						<span class="subfield dayfield"><input class="datepart required" type="text" pattern="[0-9]*" value="" placeholder="DD" size="2" maxlength="2" name="MMERGE1[day]" id="mce-MMERGE1-day"></span> / 
						<span class="subfield yearfield"><input class="datepart required" type="text" pattern="[0-9]*" value="" placeholder="YYYY" size="4" maxlength="4" name="MMERGE1[year]" id="mce-MMERGE1-year"></span>
				    </div>
					<label for="mce-MMERGE1-month">Due Date Or Youngest Baby's Birthdate </label>
				</div>
				<div class="submit-box">
			    	<input type="submit" value="Join Now" name="subscribe" id="mc-embedded-subscribe" class="button">
			   </div>
				<div id="mce-responses">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
				</div>
				<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_df8b192ae5d9a5d1ff7f26265_5fffe747ff" tabindex="-1" value=""></div>
			</div>
		</form>
	</div>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[4]='FNAME';ftypes[4]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='zip';fnames[1]='MMERGE1';ftypes[1]='date';fnames[5]='MMERGE5';ftypes[5]='text';fnames[6]='MMERGE6';ftypes[6]='text';fnames[7]='MMERGE7';ftypes[7]='text';fnames[8]='MMERGE8';ftypes[8]='text';fnames[9]='MMERGE9';ftypes[9]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
	<!--End mc_embed_signup-->

	<?php
}