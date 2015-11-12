/*  Script for the Meteor Slides 1.5.1 slideshow

	

	Copy "slideshow.js" from "/meteor-slides/js/" to your theme's directory to replace

	the plugin's default slideshow script.

	

	Learn more about customizing the slideshow script for Meteor Slides: 

	http://www.jleuze.com/plugins/meteor-slides/customizing-the-slideshow-script/

*/



// Set custom shortcut to avoid conflicts

var $j = jQuery.noConflict();



$j(document).ready(function() {



	// Get the slideshow options

	var $slidespeed      = parseInt( meteorslidessettings.meteorslideshowspeed );

	var $slidetimeout    = parseInt( meteorslidessettings.meteorslideshowduration );

	var $slideheight     = parseInt( meteorslidessettings.meteorslideshowheight );

	var $slidewidth      = parseInt( meteorslidessettings.meteorslideshowwidth );

	var $slidetransition = meteorslidessettings.meteorslideshowtransition;



	// Setup jQuery Cycle

    $j('.meteor-slides').cycle({

		cleartypeNoBg: true,

		fit:           1,

		fx:            $slidetransition,

		height:        $slideheight,

		next:          '#meteor-next',

		pager:         '#meteor-buttons',

		pagerEvent:    'click',

		pause:         1,

		prev:          '#meteor-prev',

		slideExpr:     '.mslide',

		speed:         $slidespeed,

		timeout:       $slidetimeout,

		width:         $slidewidth

	});

	

	// Setup jQuery TouchWipe

    $j('.meteor-slides').touchwipe({

        wipeLeft: function() {

            $j('.meteor-slides').cycle('next');

        },

        wipeRight: function() {

            $j('.meteor-slides').cycle('prev');

        },

		preventDefaultEvents: false

    });

	

	// Add class to hide and show prev/next nav on hover

    $j('.meteor-slides').hover(function () {

		$j(this).addClass('navhover');

    }, function () {

		$j(this).removeClass('navhover');

    });

	

	// Set a fixed height for prev/next nav in IE6

	if(typeof document.body.style.maxWidth === 'undefined') {

		$j('.meteor-nav a').height($slideheight);

	}

	

	// Add align class if set in metadata

	$j('.meteor-slides').each(function () {

		meteormetadata = $j(this).metadata();

		if (meteormetadata.align == 'left') {

			$j(this).addClass('meteor-left');

		} else if (meteormetadata.align == 'right') {

			$j(this).addClass('meteor-right');

		} else if (meteormetadata.align == 'center') {

			$j(this).addClass('meteor-center');

		}

	});


 /**
  * Custom addition to show/hide prev/next when first/last slide is visible
  * @author	Mossyrock
  */
	function checkSlides( direction ) {

		var $slideshows = $j(".meteor-slides");

		// check each of our slideshows
		$slideshows.each( function(i, el) {

			// make sure we have more than one slide, otherwise the nav will be hidden anyway
			var $slides = $j(el).find(".mslide");
			var numslides = $slides.length;

			if( numslides > 1 ) {
				
				var $prev  = $j(el).find(".meteor-nav a").first();
				var $next  = $j(el).find(".meteor-nav a").last();
				
				// first run is on page load, just hide the previous since we're at first slide
				if( typeof( direction ) === "undefined" ) {
					$prev.css( 'display', 'none' );
				} else {

					// the current slide will be block so we have to check the one before it
					var dispfirst = $slides.eq(1).css('display');
					var displast = $slides.eq($slides.length-2).css('display');

					// if we're moving to the first slide (second is block, direction is prev) hide the prev
					// if we're moving to the last slide (second is block, direction is next) hide the next
					if( dispfirst == 'block' && direction == 'prev' ) {
						$prev.css( 'display', 'none' );
					} else if( displast == 'block' && direction == 'next' ) {
						$next.css( 'display', 'none' );
					} else {
						$prev.css( 'display', 'block' );
						$next.css( 'display', 'block' );
					}
				}
			}
		});
	}
	// initial pass
	checkSlides();

	// check again on updates
	$j(".meteor-slides .meteor-nav a").on( "click", function(e) {
		checkSlides( e.target.href.split("#")[1] );
	});

});