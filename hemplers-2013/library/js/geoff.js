jQuery(document).ready(function( $ ) {

	//console.log('loaded');
	
	/*
$('article.post-32 div.wrap').html('');
	
	if($("article.post-32").length > 0) {
    		$("#contact-wrapper").fadeIn('slow');//.css("display","block");
			$("#contact").fadeIn('slow');
    }
*/

	/*
	 * UTILITY
	 */

	/*
	 * Prevent Scrolling (used in popover)
	 */
	// left: 37, up: 38, right: 39, down: 40,
	// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
	var keys = [37, 38, 39, 40];
	function preventDefault(e) {
	  e = e || window.event;
	  if (e.preventDefault)
	      e.preventDefault();
	  e.returnValue = false;  
	}
	function keydown(e) {
    for (var i = keys.length; i--;) {
      if (e.keyCode === keys[i]) {
        preventDefault(e);
        return;
      }
    }
	}
	function wheel(e) {
	  preventDefault(e);
	}
	function disable_scroll() {
	  if (window.addEventListener) {
	      window.addEventListener('DOMMouseScroll', wheel, false);
	  }
	  window.onmousewheel = document.onmousewheel = wheel;
	  document.onkeydown = keydown;
	}
	function enable_scroll() {
	    if (window.removeEventListener) {
	        window.removeEventListener('DOMMouseScroll', wheel, false);
	    }
	    window.onmousewheel = document.onmousewheel = document.onkeydown = null;  
	}
	
	/*
	 * CONTACT US POPOVER
	 */
	 
	 /* geoff */

	/*
	 * Show
	 */
	$("li#menu-item-565 a").click( function(e) {
			e.preventDefault();
			//disable_scroll();
			$("#contact-wrapper").fadeIn('slow');
			$("#contact").fadeIn('slow');
			return false;
		});

	$("#contact-modal").click( function(e) {
			e.preventDefault();
			//disable_scroll();
			$("#contact-wrapper").fadeIn('slow');
			$("#contact").fadeIn('slow');
			return false;
		});

	// Remove last child version, replaced above with ID.
	// $("#footer-links ul li:last-child a").click( function(e) {
	// 		e.preventDefault();
	// 		//disable_scroll();
	// 		$("#contact-wrapper").fadeIn('slow');
	// 		$("#contact").fadeIn('slow');
	// 		return false;
	// 	});

	/*
	 * Hide
	 */
	 
	 $("#close").click( function() {
				$("#contact-wrapper").fadeOut('fast');
				$("#container").css('overflow', '');
				$('html').unbind('touchmove');
				return false;
			});




	/*
	 * HOME PAGE ANIMATIONS
	 */
	if( $('body').hasClass('home') ) {

		/*
		 * init shake capability for sausage images
		 */
		$('#sausage-1 img').jrumble({
				x: 1,
				y: 2,
				rotation: .5,
				speed: 100
			});
		$('#sausage-2 img').jrumble({
				x: 1,
				y: 2,
				rotation: .5,
				speed: 100
			});

		// random number generator
		var randomNumber = function(numLow, numHigh) {
      var adjustedHigh = (parseFloat(numHigh) - parseFloat(numLow)) + 1;
      var numRand = Math.floor(Math.random()*adjustedHigh) + parseFloat(numLow);

      // verify and return
      if ((jQuery.isNumeric(numLow)) && (jQuery.isNumeric(numHigh)) && (parseFloat(numLow) <= parseFloat(numHigh) && (numLow != '') && (numHigh != ''))) {
				return numRand;
      }

      // values passed were wrong, return a default
      console.log( 'Random number parameter error, returning 1000.' )
      return 1000;
		}

		// pulsing on/off
		function pulseStart(el){
			var runfor = randomNumber(50, 300);
			$(el).find('img').trigger('startRumble');
			setTimeout(pulseStop, runfor, el);
		};
		function pulseStop(el){
			var pausefor = randomNumber(400, 2000);
			$(el).find('img').trigger('stopRumble');
			setTimeout(pulseStart, pausefor, el);
		};

		/*
		 * Animate Sign in nav
		 */
	 	$('#logo').delay(100).animate({
	    	top: '+=300'
	    }, 800, function() {
		});
		
		/*
		 * Animate Tagline and Arrow
		 */
		$('#tagline').delay(2000).fadeIn(1000);
		$('#tag-arrow').delay(2300).animate({
	    		top: '+=20',
	    		opacity: 1
		    }, 1000
	    );
	
		/*
		 * Animate Sausages
		 */
		$('#sausage-1').delay(1000).animate({
	    		top: '+=450'
		    }, 700, function() {

					// Declare parallax on layers
					// $('#pig').parallax({
					// 	mouseport: $(".home-farms-block")
					// });

	    		// var that = this;
			    // setTimeout( function(){
			    //   $(that).css('position','fixed');
			    // },1000);
		    	pulseStart( this );
				});
		$('#sausage-2').delay(1300).animate({
	    		top: '+=650'
		    }, 800, function() {
	    		// var that = this;
			    // setTimeout( function(){
			    //   $(that).css('position','fixed');
			    // },1000);
		    	pulseStart( this );
				});


		/*
		 * HP Parallax
		 */
   	// console.log( $('#pig').parallax( { yparallax:.5 } ) );


	} /* end home page animations */
	


	
/*
$("#contact-wrapper").click( function(e) {
			console.log('clicked button');
			e.preventDefault();
			enable_scroll();
			$(this).fadeOut('fast');
			$("#contact-wrapper").fadeOut('fast');
			$("#container").css('overflow', '');//.css("display","block");
			$('html').unbind('touchmove');
			return false;

		});
*/

/* alternate classes on blog posts for kestin's korner */

    $('div.listing-item:odd').addClass('left');
    $('div.listing-item:even').addClass('right');
    
/* clickjack the "read more" to open modal post */

$('span.excerpt a').colorbox({iframe:true, width:"900", height:"600"});
$('div.listing-item h3 a').colorbox({iframe:true, width:"900", height:"600"});
$('div.listing-item a.image').colorbox({iframe:true, width:"900", height:"600"});

/* $('form#commentform input#submit').colorbox(); */

	//$('span.excerpt a').click(function(){
	//	$('body').append('<div class="frame-wrap" id="frame-wrap-507"></div>');
	//	$('div#frame-wrap-507').addClass('show');
	//		$('div#frame-wrap-507').click(function(){
	//			console.log('can has click?');
	//			$('div#frame-wrap-507').removeClass('show');
	//			$('div#frame-507').removeClass('show');
	//		});
	//	$('div#frame-507').addClass('show');
	//	return false;
	//});
	
	
		
	
});