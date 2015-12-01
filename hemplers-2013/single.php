<!-- <noscript> -->
<?php  get_header(); ?>
<!-- </noscript> -->

<!-- <link rel='stylesheet' id='googleFonts-css'  href='http://fonts.googleapis.com/css?family=Lobster%7CGermania+One%7CRye' type='text/css' media='all' /> -->

<style>

/* post */

/*div#cboxLoadedContent {
	max-height: 600px !important;
	overflow: auto;
}

div#inner-content  {
	background: #fff;
	padding: 40px;
	font-size: 18px;
}

.eightcol  {
	width: 100%;
}

p.byline  {
	display: none;
}

.hentry {
	background: none;
}

h1 {
	font-size: 40px;
	color: #333;
	padding-bottom: 10px;
	margin-bottom: 10px;
}

h1 {
	font-family: "rye";
	text-align: center;
	text-transform: uppercase;
}

h3 {
	font-family: "Germania One";
}

section.entry-content {
	font-size: 18px;
}

div#cboxTitle {
	display: none;
}

.alignleft, img.alignleft,
.alignright, img.alignright {
	margin-bottom: 20px;
}

.alignleft, img.alignleft {
	float: left;
	padding-right: 20px;
}

.alignright, img.alignright {
	float: right;
	padding-left: 20px;
}


body.page-id-511 div#subscribe {
	font-size: 17px;
	color: #333;
	margin-top: 90px;
}

body.page-id-511 div#subscribe label {
	display: none;
}

article.post {
	font-family: arial;
}

article.post a,
article.post a:visited,
article.post a:link {
	color: #53380C;
}

h3#comments {
	color: #333;
}

div.comment-meta a {
	font-size: 12px;
	color: #666;
	text-decoration: none;
	font-style: italic;
}

div.comment-body {
	font-size: 14px;
	color: #666;
	margin: 
}

article.post cite a.url {
	text-decoration: none;
	font-weight: bold;
}

article.post a.comment-reply-link {
	background: #333;
	color: #fff;
	border-radius: 4px;
	padding: 5px;
	text-decoration: none;
	font-size: 12px;
	
	display: none;
}

article.post a.comment-reply-link:hover {
	background: #666;
}

ol {
	margin: 0;
	padding: 0;
}

li.comment {
	border: 1px dashed #333;
	padding: 15px;
	margin: 20px 0;
	list-style: none;
}

form#commentform {
	font-size: 12px;
	color: #333;
}

textarea#comment {
	width: 100%;
}

/* social for blog */

/*#ssba {
	margin-bottom: 40px;
}

a.ssba_tooptip{outline:none;text-decoration:none !important;color:inherit !important;}
a.ssba_tooptip strong{line-height:12px;}
a.ssba_tooptip:hover{text-decoration:none;color:inherit !important;} 
a.ssba_tooptip span{z-index:10;display:none;padding:10px;margin-top:-30px;margin-left:28px;line-height:16px;}
a.ssba_tooptip:hover span{font-family: arial;font-size: 12px;display:inline;position:absolute;color:#555e58;border:1px solid #e0dddd;background:#f5f5f5;}
.callout{z-index:20;position:absolute;top:30px;border:0;left:-12px;}
a.ssba_tooptip span{border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;-khtml-border-radius:4px;-o-border-radius:4px;}

#ssba img	{ 	
	width: 50px !important;
	padding: 6px;
	border:  0;
	box-shadow: none !important;
	display: inline;
	vertical-align: middle;
}*/

</style>



			
			<div id="content" class="blog-post">

			  <!-- Adding Tape -->
			  <div class="tape-single-post"></div>
			  <div class="tape-single-post-1"></div>

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
								<header class="article-header">
							
									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
                  <p class="byline vcard"><?php
                    printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&amp;</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F js, Y', 'bonestheme')), bones_get_the_author_posts_link(), get_the_category_list(', '));
                  ?></p>
						
								</header> <!-- end article header -->
					
								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
									
									<div id="ssba"><a id="ssba_twitter_share" href="http://twitter.com/share?url=<?php the_permalink() ?>/&text=<?php the_title(); ?>" target="_blank"><img title="Twitter" class="ssba" alt="Twitter" src="/wp-content/themes/hemplers-2013/library/images/social/twitter.png" /></a><a id="ssba_facebook_share" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" target="_blank"><img title="Facebook" class="ssba" alt="Facebook" src="/wp-content/themes/hemplers-2013/library/images/social/facebook.png" /></a><a id="ssba_linkedin_share" class="ssba_share_link" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>" target="_blank"><img title="Linkedin" class="ssba" alt="LinkedIn" src="/wp-content/themes/hemplers-2013/library/images/social/linkedin.png" /></a><a id="ssba_google_share" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank"><img title="Google+" class="ssba" alt="Google+" src="/wp-content/themes/hemplers-2013/library/images/social/google.png" /></a><a id="ssba_tumblr_share" href="http://www.tumblr.com/share/link?url=<?php the_permalink() ?>&name=<?php the_title(); ?>" target="_blank"><img title="tumblr" class="ssba" alt="tumblr" src="/wp-content/themes/hemplers-2013/library/images/social/tumblr.png" /></a><a id='ssba_pinterest_share' href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;https://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img title="Pinterest" class="ssba" alt="Pinterest" src="/wp-content/themes/hemplers-2013/library/images/social/pinterest.png" /></a><a id="ssba_email_share" href="mailto:?Subject=<?php the_title(); ?>&Body= <?php the_permalink() ?>"><img title="Email" class="ssba" alt="Email" src="/wp-content/themes/hemplers-2013/library/images/social/email.png" /></a></div>	
									
								</section> <!-- end article section -->
						
								<footer class="article-footer">
									<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags:', 'bonestheme') . '</span> ', ', ', '</p>'); ?>
							
								</footer> <!-- end article footer -->
					
								<?php comments_template(); ?>
					
							</article> <!-- end article -->
					
						<?php endwhile; ?>			
					
						<?php else : ?>
					
							<article id="post-not-found" class="hentry clearfix">
					    		<header class="article-header">
					    			<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
					    		</header>
					    		<section class="entry-content">
					    			<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
					    		</section>
					    		<footer class="article-footer">
					    		    <p><?php _e("This is the error message in the single.php template.", "bonestheme"); ?></p>
					    		</footer>
							</article>
					
						<?php endif; ?>
			
					</div> <!-- end #main -->
    
					<?php # get_sidebar(); ?>

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->
			
<!-- <noscript> -->
<?php get_footer(); ?>
<!-- </noscript> -->
