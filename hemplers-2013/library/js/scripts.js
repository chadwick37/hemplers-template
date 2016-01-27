/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        }
        return this;
    }
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it, so be sure to research and find the one
    that works for you best.
    */
    
    /* getting viewport width */
    var responsive_viewport = $(window).width();
    
    /* if is below 481px */
    if (responsive_viewport < 481) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport > 481) {
        
    } /* end larger than 481px */
    
    /* if is above or equal to 768px */
    if (responsive_viewport >= 768) {
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {
        
    }
   
    
	
	/*** Custom Hempler's Scripts ***/ // Note: libraries are enqueued for page load in functions.php if initialized here
    
    // controlling youtube videos in iframes
    /**
     * @author       Rob W <gwnRob@gmail.com>
     * @website      http://stackoverflow.com/a/7513356/938089
     * @version      20120724
     * @description  Executes function on a framed YouTube video (see website link)
     *               For a full list of possible functions, see:
     *               https://developers.google.com/youtube/js_api_reference
     * @param String frame_id The id of (the div containing) the frame
     * @param String func     Desired function to call, eg. "playVideo"
     *        (Function)      Function to call when the player is ready.
     * @param Array  args     (optional) List of arguments to pass to function func*/
    function callPlayer(frame_id, func, args) {
        if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
        var iframe = document.getElementById(frame_id);
        if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
            iframe = iframe.getElementsByTagName('iframe')[0];
        }

        // When the player is not ready yet, add the event to a queue
        // Each frame_id is associated with an own queue.
        // Each queue has three possible states:
        //  undefined = uninitialised / array = queue / 0 = ready
        if (!callPlayer.queue) callPlayer.queue = {};
        var queue = callPlayer.queue[frame_id],
            domReady = document.readyState == 'complete';

        if (domReady && !iframe) {
            // DOM is ready and iframe does not exist. Log a message
            window.console && console.log('callPlayer: Frame not found; id=' + frame_id);
            if (queue) clearInterval(queue.poller);
        } else if (func === 'listening') {
            // Sending the "listener" message to the frame, to request status updates
            if (iframe && iframe.contentWindow) {
                func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
                iframe.contentWindow.postMessage(func, '*');
            }
        } else if (!domReady || iframe && (!iframe.contentWindow || queue && !queue.ready)) {
            if (!queue) queue = callPlayer.queue[frame_id] = [];
            queue.push([func, args]);
            if (!('poller' in queue)) {
                // keep polling until the document and frame is ready
                queue.poller = setInterval(function() {
                    callPlayer(frame_id, 'listening');
                }, 250);
                // Add a global "message" event listener, to catch status updates:
                messageEvent(1, function runOnceReady(e) {
                    var tmp = JSON.parse(e.data);
                    if (tmp && tmp.id == frame_id && tmp.event == 'onReady') {
                        // YT Player says that they're ready, so mark the player as ready
                        clearInterval(queue.poller);
                        queue.ready = true;
                        messageEvent(0, runOnceReady);
                        // .. and release the queue:
                        while (tmp = queue.shift()) {
                            callPlayer(frame_id, tmp[0], tmp[1]);
                        }
                    }
                }, false);
            }
        } else if (iframe && iframe.contentWindow) {
            // When a function is supplied, just call it (like "onYouTubePlayerReady")
            if (func.call) return func();
            // Frame exists, send message
            iframe.contentWindow.postMessage(JSON.stringify({
                "event": "command",
                "func": func,
                "args": args || [],
                "id": frame_id
            }), "*");
        }
        /* IE8 does not support addEventListener... */
        function messageEvent(add, listener) {
            var w3 = add ? window.addEventListener : window.removeEventListener;
            w3 ?
                w3('message', listener, !1)
            :
                (add ? window.attachEvent : window.detachEvent)('onmessage', listener);
        }
    }


    /* add placeholder to address field on store locator */
    $('#address_search .search_item INPUT').attr("placeholder","Address or Zip");


    /**
     * Script to filter products based on categories selected
     * 
     * @author       Philip Tillsley
     * 
     * @param        none
     * 
     * @return       none
     */ 
    // Wrapping, self invoking function prevents globals  
    (function() {  
        // initiliaze
        $nav = $("#product_selector a");    // our filtering links
        $content = $("#product_list > ul > li");   // the content to be filtered
        
        // some constants
        var li_height = "300px";
        var li_width = $content.outerWidth();
        var anim_time = 100;
        var anim_spacing = anim_time * .2;

        // if we have the elements
        if( $nav.length > 0 && $content.length > 0 ) {

            // bind the filter links
            $nav.each(function(i,a) {

                // add disabled class to empty terms
                if( $content.filter( "." + $(this).attr('rel') ).length == 0 && $(this).attr('rel') != 'all' ) $(this).addClass('disabled');

                /* handle click events */
                $(this).click( function(e) {

                    // prevent link clickthrough
                    e.preventDefault();

                    // finish any current animations immediately // .each(function(i) { $(this).finish(); });
                    $content.filter(':animated').stop(true, true);
                    if( $content.filter(':animated').length > 0 ) $.fx.off = !($.fx.off = true);

                    // get link info
                    var $link = $(e.target);
                    var term =  $link.attr('rel');
                    var termclass = "." + term;
                    var numprods = $content.filter( termclass ).length;

                    // skip if link disabled or no products to show
                    if( $link.hasClass('disabled') || ( term != "all" && numprods == 0 ) ) return false;

                    // view all was clicked, show everything
                    if( term == "all" ) {

                        // reset links
                        $nav.removeClass('selected');

                        // show all hidden
                        var $showall = $content.filter( ".hidden" ).removeClass('hidden');
                        if( $showall.length > 0 ) {
                            (function shownext(jq){
                                if( typeof i == "undefined" ) var i = 0; else i++;
                                jq.eq(0).animate({ opacity: 1, height: li_height, width: li_width }, anim_time );
                                setTimeout( function(){ jq.length > 1 && shownext(jq.slice(1)); }, i*anim_time + anim_spacing );
                            })( $showall )
                        }

                        // change header image to default
                        var $headerimg_in = $('#snapshot-in');
                        var $headerimg_out = $('#snapshot');
                        var hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-snapshot.png';

                        // change the header image
                        $headerimg_in.find('img').attr('src',hdrimg);
                        $headerimg_in.fadeIn(function() {
                            $headerimg_out.find('img').attr('src',hdrimg);
                            $headerimg_in.hide();
                        });
                    } else {

                        // don't do anything if we're already filtering to this
                        if( $nav.filter( "[rel='" + term + "']" ).hasClass('selected') ) return;

                        // reset links, highlight selected link
                        $nav.removeClass('selected').filter( "[rel='" + term + "']" ).addClass('selected');

                        // prep elements to show and hide
                        var $show = $content.filter( termclass ).filter( ".hidden" ).switchClass('hidden', 'showthis');
                        var $hide = $content.not( termclass ).not( ".hidden" ).switchClass('hidden', 'hidethis');
                        
                        // show elements needing to be shown
                        if( $show.length > 0 ) {
                            (function shownext(jq){
                                if( typeof i == "undefined" ) var i = 0; else i++;
                                jq.eq(0).animate({ opacity: 1, height: li_height, width: li_width }, anim_time ).removeClass('showthis');
                                setTimeout( function(){ jq.length > 1 && shownext(jq.slice(1)); }, i*anim_time + anim_spacing );
                            })( $show )
                        }
                        
                        // change header image based on product type
                        var $headerimg_in = $('#snapshot-in');
                        var $headerimg_out = $('#snapshot');
                        
                        // most cases use an image name the same as the term and a gif format
                        var hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-' + term + '.gif';
                        
                        // a few don't match this pattern, handle them
                        switch( term ) {
                            case 'smoked-turkeychicken':
                                hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-turkey.gif';
                                break;
                            case 'ground-sausage':
                            case 'fresh-sausage':
                                hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-sausage.gif';
                                break;
                            case 'misc':
                            	hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-misc.gif';
                                break;
                            case 'deli-hams-half-hams':
                            case 'gourmet-hams':
                                hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-snapshot.png';
                                break;
                        }

                        // change the header image
                        $headerimg_in.find('img').attr('src',hdrimg);
                        $headerimg_in.fadeIn(function() {
                            $headerimg_out.find('img').attr('src',hdrimg);
                            $headerimg_in.hide();
                        });

                        // hide elements that need to be hidden
                        if( $hide.length > 0 ) {
                            (function hidenext(jq) {
                                if( typeof i == "undefined" ) var i = 0; else i++;
                                jq.eq(0).animate({ opacity: 0, height: 0, width: 0}, anim_time ).switchClass('hidethis', 'hidden');
                                setTimeout( function(){ jq.length > 1 && hidenext(jq.slice(1)); }, i*anim_time + anim_spacing );
                            })( $hide )
                        }
                    }

                    // prevent link clickthrough
                    return false;
                } );
            });
        }
    })();  


    /**
     * Initialize colorbox on product thumbnails and embedded videos
     * 
     * @author       Philip Tillsley
     * 
     * @param        none
     * 
     * @return       none
     */ 
    $('.thumb > a').on('click', function(e) {

        // prevent default behaviour
        e.preventDefault();

        // retrieve the product id
        var prod_id = this.href.substring( this.href.lastIndexOf('?') + 1 );

        // make an ajax call to get the gallery html (calls mm_load_gallery() defined in functions.php)
        var data = {
                action: 'load_gallery',
                id: prod_id
            };
            console.log(data);
        jQuery.post( ajaxurl, data, function(response) {

            // success, load colorbox and feed it the response html
            $.colorbox({
                    transition: 'fade',
                    scrolling: false,
                    loop: false,
                    html: response,
                    opacity: .6,
                    onComplete: function() {
                        $(function() {
                            $( "#tabs" ).tabs({
                                create: function( event, ui ) {

                                    // resize to fit tabified content
                                    $.colorbox.resize();

                                    // move the nav to the bottom
                                    $( ".tabs-bottom .ui-tabs-nav" ).appendTo( ".tabs-bottom" );
                                },
                                activate: function( event, ui ) {

                                    // pause youtube video if switching tabs
                                    if( $(event.currentTarget.hash).find('iframe').length > 0 ) callPlayer("gallery_video", "playVideo");
                                    else  callPlayer("gallery_video", "pauseVideo");

                                    // resize in case tab changed size
                                    // $.colorbox.resize();
                                }
                            });
                        });
                    },
                    onClosed: function() {
                        $(function() {
                            $( "#tabs" ).tabs( "destroy" );
                        });
                    }
                });
            });

        // nothing else
        return false;
    });

    /* Home Page Videos */
    $('a.iframe').css('position','relative').colorbox({
        iframe:      true,
        innerWidth:  854,
        innerHeight: 485,
        transition:  'fade',
        opacity: .6,
        onComplete: function () { 
            $("#colorbox iframe").css({ 
                'width': '854px', 
                'height': '485px'
                });
        }});

    // image popup
    $('a.popup').colorbox({
            transition: 'fade',
            scrolling: false,
            loop: false,
            opacity: .6
        });

    /* init localScroll for smooth in-page link navigation */
//    $('#nav').localScroll(800);

    /* init Parallax effects */

    //.parallax(xPosition, speedFactor, outerHeight) options:
    //xPosition - Horizontal position of the element
    //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
    //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
/*    $('#intro').parallax("50%", 0.1);
    $('#second').parallax("50%", 0.1);
    $('.bg').parallax("50%", 0.4);
    $('#third').parallax("50%", 0.3);
TBD */

    /* init Waypoints */

/*    $.waypoints.settings.scrollThrottle = 30;
    $('#inner-nav').waypoint(function(event, direction) {
        $(this).parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
    });
TBD */


// Adding Script readmore
// Hide the extra content initially, using JS so that if JS is disabled, no problemo:
$('.read-more-content').addClass('hide')

// Set up a link to expand the hidden content:
.before('<br /><a class="read-more-show" href="#">Read more...</a>')
  
// Set up a link to hide the expanded content.
.append('<br /><a class="read-more-hide" href="#">Show less</a>');

// Set up the toggle effect:
$('.read-more-show').on('click', function(e) {
  $(this).next('.read-more-content').slideDown()
  $(this).addClass('hide');
  e.preventDefault();
});


$('.read-more-hide').on('click', function(e) {
  $(this).parent('.read-more-content').slideUp().parent().children('.read-more-show').removeClass('hide');
  e.preventDefault();
});
// End Script readmore

// Adding Script for arrow left
$('div.arrow').on('click', function(e){
    window.history.back();
});
// End Script



}); /* end of as page load scripts */




/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );


// Menu Blog
// (function($) {  
//         // initiliaze
//         $nav_wptiles = $("#blog_selector a");    // our filtering links
//         $contents = $(".wp-tiles-container > div.wp-tiles-grid > div.wp-tiles-tile");   // the content to be filtered

//          // // some constants
//         var li_height = $contents.outerHeight();
//         var li_width = $contents.outerWidth();
//         var anim_time = 100;
//         var anim_spacing = anim_time * .2;

//         if ( $nav_wptiles.length > 0 && $contents.length > 0 ) {
//             $nav_wptiles.each(function(i, a){
//                 if( $contents.filter( "." + $(this).attr('rel') ).length == 0 && $(this).attr('rel') != 'all' ) $(this).addClass('disabled');
//                 $(this).click( function(e){
//                     console.log(e.target.href);
//                     e.preventDefault();

//                     var $link_wptiles = $(e.target);
//                     var term_wptiles =  $link_wptiles.attr('rel');
//                     var termclass = "." + term_wptiles;
//                     var numprods = $contents.filter( termclass ).length;

//                     // skip if link disabled or no products to show
//                     if( $link_wptiles.hasClass('disabled') || ( term_wptiles != "all" && numprods == 0 ) ) return false;
//                 // view all was clicked, show everything
//                     if( term_wptiles == "all" ) {

//                         // reset links
//                         $nav_wptiles.removeClass('selected');

//                         // show all hidden
//                         var $showall_post_wptiles = $contents.filter( ".hidden" ).removeClass('hidden');
//                         if( $showall_post_wptiles.length > 0 ) {
//                             (function shownext(jq){
//                                 if( typeof i == "undefined" ) var i = 0; else i++;
//                                 jq.eq(0).animate({ opacity: 1, height: li_height, width: li_width }, anim_time );
//                                 setTimeout( function(){ jq.length > 1 && shownext(jq.slice(1)); }, i*anim_time + anim_spacing );

//                             })( $showall_post_wptiles )
//                         }
//                     } else {

//                         // don't do anything if we're already filtering to this
//                         if( $nav_wptiles.filter( "[rel='" + term_wptiles + "']" ).hasClass('selected') ) return;

//                          // reset links, highlight selected link
//                         $nav_wptiles.removeClass('selected').filter( "[rel='" + term_wptiles + "']" ).addClass('selected');

//                         // prep elements to show and hide
//                         var $show_wptiles = $contents.filter( termclass ).filter( ".hidden" ).switchClass('hidden', 'showthis');
//                         var $hide_wptiles = $contents.not( termclass ).not( ".hidden" ).switchClass('hidden', 'hidethis');
                        
//                          // show elements needing to be shown
//                         if( $show_wptiles.length > 0 ) {
//                             (function shownext(jq){
//                                 if( typeof i == "undefined" ) var i = 0; else i++;
//                                 jq.eq(0).animate({ opacity: 1, height: li_height, width: li_width}, anim_time ).removeClass('showthis');
//                                 setTimeout( function(){ jq.length > 1 && shownext(jq.slice(1)); }, i*anim_time + anim_spacing );
//                                 $('.wp-tiles-container').trigger('resize');
//                                 $('#wp_tiles_1').resize();
//                             })( $show_wptiles )
//                         }

//                          // hide elements that need to be hidden
//                         if( $hide_wptiles.length > 0 ) {
//                             (function hidenext(jq) {
//                                 if( typeof i == "undefined" ) var i = 0; else i++;
//                                 jq.eq(0).animate({ opacity: 0, height: 0, width: 0}, anim_time ).switchClass('hidethis', 'hidden');
//                                 setTimeout( function(){ jq.length > 1 && hidenext(jq.slice(1)); }, i*anim_time + anim_spacing );
//                             })( $hide_wptiles )
//                         }

//                     }
//                 });
//             });
//         } else {
//             console.log("Error");
//         };
        
        // // some constants
        // var li_height = "300px";
        // var li_width = $content.outerWidth();
        // var anim_time = 100;
        // var anim_spacing = anim_time * .2;

        // // if we have the elements
        // if( $nav.length > 0 && $content.length > 0 ) {

        //     // bind the filter links
        //     $nav.each(function(i,a) {

        //         // add disabled class to empty terms
        //         if( $content.filter( "." + $(this).attr('rel') ).length == 0 && $(this).attr('rel') != 'all' ) $(this).addClass('disabled');

        //         /* handle click events */
        //         $(this).click( function(e) {

        //             // prevent link clickthrough
        //             e.preventDefault();

        //             // finish any current animations immediately // .each(function(i) { $(this).finish(); });
        //             $content.filter(':animated').stop(true, true);
        //             if( $content.filter(':animated').length > 0 ) $.fx.off = !($.fx.off = true);

        //             // get link info
        //             var $link = $(e.target);
        //             var term =  $link.attr('rel');
        //             var termclass = "." + term;
        //             var numprods = $content.filter( termclass ).length;

        //             // skip if link disabled or no products to show
        //             if( $link.hasClass('disabled') || ( term != "all" && numprods == 0 ) ) return false;

        //             // view all was clicked, show everything
        //             if( term == "all" ) {

        //                 // reset links
        //                 $nav.removeClass('selected');

        //                 // show all hidden
        //                 var $showall = $content.filter( ".hidden" ).removeClass('hidden');
        //                 if( $showall.length > 0 ) {
        //                     (function shownext(jq){
        //                         if( typeof i == "undefined" ) var i = 0; else i++;
        //                         jq.eq(0).animate({ opacity: 1, height: li_height, width: li_width }, anim_time );
        //                         setTimeout( function(){ jq.length > 1 && shownext(jq.slice(1)); }, i*anim_time + anim_spacing );
        //                     })( $showall )
        //                 }

        //                 // change header image to default
        //                 var $headerimg_in = $('#snapshot-in');
        //                 var $headerimg_out = $('#snapshot');
        //                 var hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-snapshot.png';

        //                 // change the header image
        //                 $headerimg_in.find('img').attr('src',hdrimg);
        //                 $headerimg_in.fadeIn(function() {
        //                     $headerimg_out.find('img').attr('src',hdrimg);
        //                     $headerimg_in.hide();
        //                 });
        //             } else {

        //                 // don't do anything if we're already filtering to this
        //                 if( $nav.filter( "[rel='" + term + "']" ).hasClass('selected') ) return;

        //                 // reset links, highlight selected link
        //                 $nav.removeClass('selected').filter( "[rel='" + term + "']" ).addClass('selected');

        //                 // prep elements to show and hide
        //                 var $show = $content.filter( termclass ).filter( ".hidden" ).switchClass('hidden', 'showthis');
        //                 var $hide = $content.not( termclass ).not( ".hidden" ).switchClass('hidden', 'hidethis');
                        
        //                 // show elements needing to be shown
        //                 if( $show.length > 0 ) {
        //                     (function shownext(jq){
        //                         if( typeof i == "undefined" ) var i = 0; else i++;
        //                         jq.eq(0).animate({ opacity: 1, height: li_height, width: li_width }, anim_time ).removeClass('showthis');
        //                         setTimeout( function(){ jq.length > 1 && shownext(jq.slice(1)); }, i*anim_time + anim_spacing );
        //                     })( $show )
        //                 }
                        
        //                 // change header image based on product type
        //                 var $headerimg_in = $('#snapshot-in');
        //                 var $headerimg_out = $('#snapshot');
                        
        //                 // most cases use an image name the same as the term and a gif format
        //                 var hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-' + term + '.gif';
                        
        //                 // a few don't match this pattern, handle them
        //                 switch( term ) {
        //                     case 'smoked-turkeychicken':
        //                         hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-turkey.gif';
        //                         break;
        //                     case 'ground-sausage':
        //                     case 'fresh-sausage':
        //                         hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-sausage.gif';
        //                         break;
        //                     case 'misc':
        //                         hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-misc.gif';
        //                         break;
        //                     case 'deli-hams-half-hams':
        //                     case 'gourmet-hams':
        //                         hdrimg = '/wp-content/themes/hemplers-2013/library/images/products-header-snapshot.png';
        //                         break;
        //                 }

        //                 // change the header image
        //                 $headerimg_in.find('img').attr('src',hdrimg);
        //                 $headerimg_in.fadeIn(function() {
        //                     $headerimg_out.find('img').attr('src',hdrimg);
        //                     $headerimg_in.hide();
        //                 });

        //                 // hide elements that need to be hidden
        //                 if( $hide.length > 0 ) {
        //                     (function hidenext(jq) {
        //                         if( typeof i == "undefined" ) var i = 0; else i++;
        //                         jq.eq(0).animate({ opacity: 0, height: 0, width: 0}, anim_time ).switchClass('hidethis', 'hidden');
        //                         setTimeout( function(){ jq.length > 1 && hidenext(jq.slice(1)); }, i*anim_time + anim_spacing );
        //                     })( $hide )
        //                 }
        //             }

        //             // prevent link clickthrough
        //             return false;
        //         } );
        //     });
        // }
    // })(jQuery);
// End Scripts Menu Blog

// Adding script to added active class on blog menu
(function($) {
     var pgurl = window.location.pathname;
     $("#blog_selector ul li a").each(function(){
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).addClass("active");
     })
})(jQuery);
// End Adding script to added active class on blog menu

// Randomly Video
(function($){
    $(document).ready(function() {
        var array_video = new Array("/wp-content/themes/hemplers-2013/library/images/video/ham.mp4","/wp-content/themes/hemplers-2013/library/images/video/Bacon.mp4",
                            "/wp-content/themes/hemplers-2013/library/images/video/CanadianBacon.mp4","/wp-content/themes/hemplers-2013/library/images/video/HamSandwich2.mp4",
                            "/wp-content/themes/hemplers-2013/library/images/video/Hotdog.mp4","/wp-content/themes/hemplers-2013/library/images/video/Sausage.mp4");
        var random_number = Math.floor(Math.random()*array_video.length);
        var video = document.getElementById('video-background');
        if (video === null) {
            console.log("element not found");
        } else {
            console.log("element is found");
            var source = document.createElement('source');

            source.setAttribute('src', array_video[random_number]);
            source.setAttribute('type','video/mp4');

            video.appendChild(source);
            video.play();
        }
        
    });
})(jQuery);


// change the show/hide on the "read more.." on Kestin's Korner to a slideup/slidedown
(function($){
    $(document).ready(function() {
        var on_show = 0;
        var height_tiles_container = 0;
        var height_tiles_container_on_show = 0;
        var data_pagination = [];

    setTimeout(function () {
        height_tiles_container = $('.wp-tiles-container').height(); //Get height before show more
    }, 1000);

    $('.wp-tiles-pagination.wp-tiles-pagination-ajax a').text("Show");   
    $('.wp-tiles-pagination.wp-tiles-pagination-ajax a').css('text-decoration','none');
    $wp_tiles_pagination_get_a_value = $('.wp-tiles-pagination.wp-tiles-pagination-ajax a');
    $wp_tiles_pagination_get_a_value.each(function(i, a){
        
        $(this).click(function(e){
            if (!$('.wp-tiles-pagination.wp-tiles-pagination-ajax').hasClass('show') || $('.wp-tiles-pagination.wp-tiles-pagination-ajax').hasClass('hide')) {
            e.preventDefault();

            $.ajax({
               url:e.target.href, // Get url from pagination
               type:'GET',
               success: function(data){
                   $(data).find('.wp-tiles-tile').each(function(i,a){
                     data_pagination[i] = $($(data).find('.wp-tiles-tile')[i]).attr('id');
                   })
               }
            });
        
            setTimeout(function () {
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax a').text("Hide"); 
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax').removeClass('hide');
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax').addClass('show');
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax').show();  
                height_tiles_container_on_show = $('.wp-tiles-container').height();
            }, 1500);

            $('.wp-tiles-tile').each(function(i,a){
                for (var j = 0; j < data_pagination.length; j++) { //take a value equal to pagination
                   if ($($('.wp-tiles-tile')[i]).attr('id') === data_pagination[j]) {
                    $('.wp-tiles-container').slideDown(500).animate({height:height_tiles_container_on_show+'px'},250); // Change speed to 1 second
                    $($('.wp-tiles-tile')[i]).slideDown("slow"); 
                    };
                };
            });
        } 
        else if ($('.wp-tiles-pagination.wp-tiles-pagination-ajax').hasClass('show')) {
            e.preventDefault();  

            setTimeout(function () {
                $('.wp-tiles-container').animate({height:height_tiles_container+'px'},250); // Change speed to 1 second
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax a').text("Show");
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax').removeClass('show');
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax').addClass('hide');
                $('.wp-tiles-pagination.wp-tiles-pagination-ajax').show();  
            }, 1000);

            $('.wp-tiles-tile').each(function(i,a){
                for (var j = 0; j < data_pagination.length; j++) {
                   if ($($('.wp-tiles-tile')[i]).attr('id') === data_pagination[j]) {
                    $($('.wp-tiles-tile')[i]).slideUp("slow");
                    };
                };
            });
        } 
        });
    });
    
});
    

// Override pagination speed on wp tiles
if ($('body').hasClass('page-id-511')) {
	setTimeout(function(){
	    $.wptiles.resizeParent = function($el,padding) {
	    var tiles=$el.children(".wp-tiles-tile"), tileOffsetTop=parseInt($el.offset().top), max=0, newHeight;
	            tiles.each(function() {
	                var $e=$(this), bottom=$e.height()+$e.offset().top;
	                if(bottom>max)max=bottom
	            }
	            );
	        newHeight=max-tileOffsetTop+parseInt(padding)+"px";
	        $el.parent(".wp-tiles-container").slideDown().animate({height:newHeight}, 250) // Change speed pagination wptiles to 1 second
	        }
	}, 2000);
}

})(jQuery)

