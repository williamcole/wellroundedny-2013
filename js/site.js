/* Site JS
-------------------------------------------------------------- */
//ajax load more
(function($){
	$(function(){
		$('.more-link a').each(function(){
			var moreLink = $(this),
				holder = $('#contributors');

			moreLink.on('click', function (e) {
				e.preventDefault();
				moreLink.addClass('ajax-loading');
				holder.addClass('ajax-loading');

				$.ajax({
					url: moreLink.attr('href'),
					success: function(rawResponse){
						var response = $('<div>' + rawResponse + '</div>');
						response
							.find('#contributors .contributor-item')
							.appendTo(holder)
						;

						var newMoreLink = response.find('.more-link a');
						if (newMoreLink.length) {
							moreLink.attr('href', newMoreLink.eq(0).attr('href'));
						} else {
							moreLink.hide();
						}
					},
					complete: function() {
						moreLink.removeClass('ajax-loading');
						holder.removeClass('ajax-loading');
					}
				});
			});
		});
	});
})(jQuery);

jQuery(function() {
	initMobileNav();
});

jQuery(window).on('load resize', function(){
    initSocial();
});

jQuery(window).scroll(function() {
    initSocial();
});

function initSocial() {
    var winHeight = $objWindow.height(),
        post = jQuery(".post");
    if(post.length > 0) {
    	var postOffset = post.offset(),
	        postTop = postOffset.top,
	        postBottom = (postOffset.top + post.height() - (winHeight / 2)),
	        winTop = $objWindow.scrollTop();
	    if(winTop > postTop && winTop < postBottom) {
	    	jQuery("body").addClass("socialShow");
	    }else {
	    	jQuery("body").removeClass("socialShow");
	    }
    }
}

var $objWindow = jQuery(window);
// mobile menu init
function initMobileNav() {
	jQuery('body').mobileNav({
		menuActiveClass: 'nav-active',
		menuOpener: '.nav-opener',
		hideOnClickOutside: true,
		menuDrop: '#nav-desktop, #nav-mobile'
	});
	jQuery('body').mobileNav({
		menuActiveClass: 'chat-active',
		menuOpener: '.btn-chat',
		hideOnClickOutside: true,
		menuDrop: '.chat-holder'
	});
}

jQuery(document).ready(function($) {
	
	// open footer social media links in new window
	$('#footer-nav').find("a:contains('Facebook')").attr('target','_blank');
	$('#footer-nav').find("a:contains('Twitter')").attr('target','_blank');
	$('#footer-nav').find("a:contains('Instagram')").attr('target','_blank');
	$('#footer-nav').find("a:contains('Pinterest')").attr('target','_blank');

	// change infinite scroll text
	function update_infinite_text() {
		if( $('#infinite-handle').length ) {
			$('#infinite-handle span').text('Load More');
		}
	}

	waitForKeyElementsSite( '#infinite-handle', update_infinite_text );


	/*--- waitForKeyElements():  A utility function, for Greasemonkey scripts,
	    that detects and handles AJAXed content.
	 
	    Usage example:
	 
	        waitForKeyElements (
	            "div.comments"
	            , commentCallbackFunction
	        );
	 
	        //--- Page-specific function to do what we want when the node is found.
	        function commentCallbackFunction (jNode) {
	            jNode.text ("This comment changed by waitForKeyElements().");
	        }
	 
	    IMPORTANT: This function requires your script to have loaded jQuery.
	*/
	function waitForKeyElementsSite (
	    selectorTxt,    /* Required: The jQuery selector string that
	                        specifies the desired element(s).
	                    */
	    actionFunction, /* Required: The code to run when elements are
	                        found. It is passed a jNode to the matched
	                        element.
	                    */
	    bWaitOnce,      /* Optional: If false, will continue to scan for
	                        new elements even after the first match is
	                        found.
	                    */
	    iframeSelector  /* Optional: If set, identifies the iframe to
	                        search.
	                    */
	) {
	    var targetNodes, btargetsFound;
	 
	    if (typeof iframeSelector == "undefined")
	        targetNodes     = $(selectorTxt);
	    else
	        targetNodes     = $(iframeSelector).contents ()
	                                           .find (selectorTxt);
	 
	    if (targetNodes  &&  targetNodes.length > 0) {
	        btargetsFound   = true;
	        /*--- Found target node(s).  Go through each and act if they
	            are new.
	        */
	        targetNodes.each ( function () {
	            var jThis        = $(this);
	            var alreadyFound = jThis.data ('alreadyFound')  ||  false;
	 
	            if (!alreadyFound) {
	                //--- Call the payload function.
	                var cancelFound     = actionFunction (jThis);
	                if (cancelFound)
	                    btargetsFound   = false;
	                else
	                    jThis.data ('alreadyFound', true);
	            }
	        } );
	    }
	    else {
	        btargetsFound   = false;
	    }
	 
	    //--- Get the timer-control variable for this selector.
	    var controlObj      = waitForKeyElementsSite.controlObj  ||  {};
	    var controlKey      = selectorTxt.replace (/[^\w]/g, "_");
	    var timeControl     = controlObj [controlKey];
	 
	    //--- Now set or clear the timer as appropriate.
	    if (btargetsFound  &&  bWaitOnce  &&  timeControl) {
	        //--- The only condition where we need to clear the timer.
	        clearInterval (timeControl);
	        delete controlObj [controlKey]
	    }
	    else {
	        //--- Set a timer, if needed.
	        if ( ! timeControl) {
	            timeControl = setInterval ( function () {
	                    waitForKeyElementsSite (    selectorTxt,
	                                            actionFunction,
	                                            bWaitOnce,
	                                            iframeSelector
	                                        );
	                },
	                300
	            );
	            controlObj [controlKey] = timeControl;
	        }
	    }
	    waitForKeyElementsSite.controlObj   = controlObj;
	}

});

/*
 * Simple Mobile Navigation
 */
;(function($) {
	function MobileNav(options) {
		this.options = $.extend({
			container: null,
			hideOnClickOutside: false,
			menuActiveClass: 'nav-active',
			menuOpener: '.nav-opener',
			menuDrop: '.nav-drop',
			toggleEvent: 'click',
			outsideClickEvent: 'click touchstart pointerdown MSPointerDown'
		}, options);
		this.initStructure();
		this.attachEvents();
	}
	MobileNav.prototype = {
		initStructure: function() {
			this.page = $('html');
			this.container = $(this.options.container);
			this.opener = this.container.find(this.options.menuOpener);
			this.drop = this.container.find(this.options.menuDrop);
		},
		attachEvents: function() {
			var self = this;

			if(activateResizeHandler) {
				activateResizeHandler();
				activateResizeHandler = null;
			}

			this.outsideClickHandler = function(e) {
				if(self.isOpened()) {
					var target = $(e.target);
					if(!target.closest(self.opener).length && !target.closest(self.drop).length) {
						self.hide();
					}
				}
			};

			this.openerClickHandler = function(e) {
				e.preventDefault();
				self.toggle();
			};

			this.opener.on(this.options.toggleEvent, this.openerClickHandler);
		},
		isOpened: function() {
			return this.container.hasClass(this.options.menuActiveClass);
		},
		show: function() {
			this.container.addClass(this.options.menuActiveClass);
			if(this.options.hideOnClickOutside) {
				this.page.on(this.options.outsideClickEvent, this.outsideClickHandler);
			}
		},
		hide: function() {
			this.container.removeClass(this.options.menuActiveClass);
			if(this.options.hideOnClickOutside) {
				this.page.off(this.options.outsideClickEvent, this.outsideClickHandler);
			}
		},
		toggle: function() {
			if(this.isOpened()) {
				this.hide();
			} else {
				this.show();
			}
		},
		destroy: function() {
			this.container.removeClass(this.options.menuActiveClass);
			this.opener.off(this.options.toggleEvent, this.clickHandler);
			this.page.off(this.options.outsideClickEvent, this.outsideClickHandler);
		}
	};

	var activateResizeHandler = function() {
		var win = $(window),
			doc = $('html'),
			resizeClass = 'resize-active',
			flag, timer;
		var removeClassHandler = function() {
			flag = false;
			doc.removeClass(resizeClass);
		};
		var resizeHandler = function() {
			if(!flag) {
				flag = true;
				doc.addClass(resizeClass);
			}
			clearTimeout(timer);
			timer = setTimeout(removeClassHandler, 500);
		};
		win.on('resize orientationchange', resizeHandler);
	};

	$.fn.mobileNav = function(opt) {
		var args = Array.prototype.slice.call(arguments);
		var method = args[0];

		return this.each(function() {
			var $container = jQuery(this);
			var instance = $container.data('MobileNav');

			if (typeof opt === 'object' || typeof opt === 'undefined') {
				$container.data('MobileNav', new MobileNav($.extend({
					container: this
				}, opt)));
			} else if (typeof method === 'string' && instance) {
				if (typeof instance[method] === 'function') {
					args.shift();
					instance[method].apply(instance, args);
				}
			}
		});
	};
}(jQuery));