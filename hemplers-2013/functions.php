<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2a. library/custom-post-type.php and library/custom-fields.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-types.php'); // you can disable this if you like
/*
2b. library/custom-fields.php & library/metabox
    - added by Philip Tillsley for custom fields and metaboxes
*/
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
  if ( !class_exists( 'cmb_Meta_Box' ) ) {
    require_once('library/metabox/init.php');
  }
}
require_once('library/custom-fields.php');
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
require_once('library/admin.php');
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-gallery-thumb', 150, 100, true );
add_image_size( 'bones-gallery-full', 600, 400, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
/*    register_sidebar(array(
    	'id' => 'footer',
    	'name' => __('Footer', 'bonestheme'),
    	'description' => __('The customizable footer area. The footer menu can be edited under "Menus."', 'bonestheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
*/    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => __('Sidebar 2', 'bonestheme'),
    	'description' => __('The second (secondary) sidebar.', 'bonestheme'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {

return; // not using comments, remove if comments will be used

   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!



/******* CUSTOM FUNCTIONS FOR HEMPLER'S THEME ***********/


/* Enqueue additional libraries and scripts */

/* in future best to do this in bones.php where the other scripts and libs are enqueued */

/* Google Fonts */
add_action('wp_print_styles', 'load_fonts');
function load_fonts() {
    
    // Lobster, 'Germania One', Rye 
    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lobster|Germania+One|Rye');
    wp_enqueue_style( 'googleFonts');
}
// Adding css bigvideo
wp_register_style('bigvideostyle', get_stylesheet_directory_uri() . '/library/css/bigvideo.css');
wp_enqueue_style( 'bigvideostyle');

/* jQuery Parallax Plugin ==> http://johnpolacek.github.com/scrolldeck.js/decks/parallax/ */
wp_register_script( 'jquery-parallax', get_stylesheet_directory_uri() . '/library/js/libs/jquery.parallax-1.1.3.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'jquery-parallax' );

    // uses jQuery Local Scroll Plugin ==> http://johnpolacek.github.com/scrolldeck.js/decks/parallax/
    wp_register_script( 'jquery-parallax', get_stylesheet_directory_uri() . '/library/js/libs/jquery.localscroll-1.2.7-min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'jquery-parallax' );

    // uses jQuery Scroll To Plugin ==> http://johnpolacek.github.com/scrolldeck.js/decks/parallax/
    wp_register_script( 'jquery-parallax', get_stylesheet_directory_uri() . '/library/js/libs/jquery.scrollTo-1.4.2-min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'jquery-parallax' );

/* Enqueue Big Video ==> http://dfcb.github.com/BigVideo.js/ */
wp_register_script( 'bigvideo', get_stylesheet_directory_uri() . '/library/js/libs/bigvideo.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'bigvideo' );

    // Enqueue jQuery UI
   // wp_register_script( 'jquery-ui', get_stylesheet_directory_uri() . '/library/js/libs/jquery-ui-1.8.22.custom.min.js', array( 'jquery' ), '', true );
   // wp_enqueue_script( 'jquery-ui' );

   /* jQuery UI ==> http://jqueryui.com/ */
    wp_register_script( 'jquery-ui', get_stylesheet_directory_uri() . '/library/js/libs/jquery-ui-1.10.2.custom.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'jquery-ui' );

    // Enqueue jQuery images loaded
    wp_register_script( 'imagesloaded', get_stylesheet_directory_uri() . '/library/js/libs/jquery.imagesloaded.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'imagesloaded' );

    // Enqueue Video.js
    wp_register_script( 'video', 'http://vjs.zencdn.net/c/video.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'video' );





/* Other custom functions */

/**
 * Gallery Metabox Plugin - Limit post types to display one
 * @author Bill Erickson
 * @link http://www.wordpress.org/extend/plugins/gallery-metabox
 * @link http://www.billerickson.net/code/gallery-metabox-custom-post-types
 * @since 1.0
 *
 * @param array $post_types
 * @return array
 */
add_action( 'be_gallery_metabox_post_types', 'mossy_gallery_limit_display' );
function mossy_gallery_limit_display( $post_types ) {
  return array( 'product' );
}

/**
 * Change Gallery Metabox Intro
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/gallery-metabox-change-intro-text
 *
 * @param string $intro
 * @return string
 */
/*function mossy_change_gallery_metabox_intro( $intro ) {
  // add, change, or replace the default intro piece (by default this is the link buttons that manage the )
  $intro = '<p>hello world</p>' . $intro;
  echo $intro;
}
add_filter( 'be_gallery_metabox_intro', 'mossy_change_gallery_metabox_intro' );
*/

/**
 * Only show images marked as Include in Rotator
 * @author Bill Erickson
 * @link http://www.wordpress.org/extend/plugins/gallery-metabox
 * @since 1.0
 *
 * @param array query $args
 * @return array query $args
 */
add_filter( 'be_gallery_metabox_args', 'mossy_gallery_custom_args' );
function mossy_gallery_custom_args( $args ) {

// default arguments:
// array(7) {
//   ["post_type"]=> string(10) "attachment" 
//   ["post_status"]=> string(7) "inherit" 
//   ["post_parent"]=> string(3) "301" 
//   ["post_mime_type"]=> string(5) "image" 
//   ["posts_per_page"]=> int(-1) 
//   ["order"]=> string(3) "ASC" 
//   ["orderby"]=> string(10) "menu_order" 
// }

  // allow pdfs, not sure how that will render
  $args["post_mime_type"] = "image,application/pdf";

  // get the featured image
  $featured = get_post_thumbnail_id( $post->ID );

  // exclude the featured image, it's handled elsewhere, note it still counts as an attachment though
  // so will need to exclude on the output side also.
  if( !is_null($featured) ) $args["exclude"] = $featured;

  return $args;
}


/**
 * Only show images marked as Include in Rotator
 * @author Bill Erickson
 * @link http://www.wordpress.org/extend/plugins/gallery-metabox
 * @since 1.0
 *
 * @param array query $args
 * @return array query $args
 */
add_filter( 'be_gallery_metabox_output', 'mossy_gallery_customize_output' );
function mossy_gallery_customize_output( $html ) {

  // prep to check for PDF
  $doc = new DOMDocument();
  $doc->loadHTML( $html );
  $imageTags = $doc->getElementsByTagName('img');
  foreach($imageTags as $tag) {
    $src = $tag->getAttribute('src');
    $alt = $tag->getAttribute('alt');
    $rel = $tag->getAttribute('rel');
    break; // there'll only be the one
  }

  // if this is a PDF (src will be empty string), output new html including some identifying information (using alt attr for the moment)
  if( $src == "" ) {
    $pdf_placeholder = get_stylesheet_directory_uri() . "/library/images/pdf-placeholder.gif"; // placeholder image
    $html = '<div style="position: relative; display: inline-block; valign: bottom;"><div
                class="pdf-thumb"
                style="
                  display: block;
                  width: 128px;
                  background-color: rgba(255,255,255,.90);
                  color: #000;
                  border-top: solid 1px #ccc;
                  border-bottom: solid 1px #ccc;
                  position: absolute;
                  top: -65px;
                  z-index: 1;
                  padding: 10px;
                ">' . $alt . '</div></div>';

    // add the placeholder image last or it will break the plugin
    $html .= '<img src="' . $pdf_placeholder . '" alt="' . $alt . '" rel="' . $rel . '" title="PDF">';
  }

  return $html;
}


/*
Plugin Name: File Un-Attach Helper Functions
Plugin URI: http://www.xparkmedia.com
Description: This function must be used to retrieve attachments added to multiple posts by File Un-Attach.
Author: Sébastien Méric
Version: 0.1
Author URI: http://www.sebastien-meric.com
Requires at least: 3.1.0
Tested up to: 3.2

Copyright 2010-2011 by Sébastien Méric http://www.sebastien-meric.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License,or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not,write to the Free Software
Foundation,Inc.,51 Franklin St,Fifth Floor,Boston,MA 02110-1301 USA
*/ 

// Stop direct access of the file
if(preg_match('#'.basename(__FILE__).'#',$_SERVER['PHP_SELF'])) die();

function mossy_get_attachments( $args = array() ) {
  global $post;

  $defaults = array(
    'post_parent' => 0,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'numberposts' => -1,
    'meta_key' => '',
    'meta_value' => '',
  );

  $args = wp_parse_args( $args, $defaults );

  if ( !$args['post_parent'] )
    $args['post_parent'] = $post->ID;

  if ( !$args['post_parent'] )
    return array();

  // usual way to get pdf attached to this post
  $legal_attachments = get_children( $args );

  // FileUnattach way to get attachments
  if ( class_exists( 'FileUnattach' ) ) {
    $args['meta_key'] = '_fun-parent';
    $args['meta_value'] = $args['post_parent'];
    $args['post_parent'] = '';

    $fun_attachments = get_posts( $args );
  }

  $attachments = array_merge( $legal_attachments, $fun_attachments );

  // if there are elts in both arrays, then there must be some duplicates.
  // remove those duplicates !
  if ( !empty( $legal_attachments ) && !empty( $fun_attachments ) ) {
    foreach ( $attachments as &$attachment ) {
      $attachment = serialize( $attachment );
    }

    $attachments = array_unique( $attachments );

    foreach ( $attachments as &$attachment ) {
      $attachment = unserialize( $attachment );
    }
  }

  if ( !$attachments ) {
    return array();
  }

  return $attachments;
}

/**
 * Generates the gallery html for a product on AJAX call when thumbnail is clicked on
 * 
 * @author       Philip Tillsley
 * 
 * @param        TBD
 * 
 * @return       none
 */ 
add_action('wp_ajax_load_gallery', 'mossy_ajax_load_gallery');
add_action('wp_ajax_nopriv_load_gallery', 'mossy_ajax_load_gallery');
function mossy_ajax_load_gallery() {

  // init
  global $wpdb;
  $prod_id = $_POST['id'];

  // get gallery tabs
  $qry = "SELECT post_title
          FROM $wpdb->posts
          WHERE ID = " . $prod_id . "
          ";
  $prods = $wpdb->get_results( $wpdb->prepare( $qry ) );

  // Try to get video url from custom field
  $vid = get_post_meta( $prod_id, '_hemplers_embed_1', true );

  // If there is one then setup the data for a tab
  if( $vid != "" ) {

    // Each YouTube video has 4 generated images. They are predictably formatted as follows:
    // http://img.youtube.com/vi/<insert-youtube-video-id-here>/0.jpg --> full
    // http://img.youtube.com/vi/<insert-youtube-video-id-here>/1.jpg
    // http://img.youtube.com/vi/<insert-youtube-video-id-here>/2.jpg
    // http://img.youtube.com/vi/<insert-youtube-video-id-here>/3.jpg
    // There are also a couple of ways to get hold of video titles and descriptions, here's one:
    // $video_info = simplexml_load_file( 'http://gdata.youtube.com/feeds/api/videos/&#8217;' . $vid . '?v=1' ); // process feed into object
    // $vid_title = $video_info->title; // title
    // $vid_desc = $video_info->content; // description

    $video_info = simplexml_load_file( 'http://gdata.youtube.com/feeds/api/videos/&#8217;' . $vid . '?v=1' );
    $vid_title = $video_info->title;

    $tabs[] = array(
    // add the thumbnail image
      '<img width="150" height="100" src="http://img.youtube.com/vi/' . ltrim ( strstr ( $vid, '=' ), '=' ) . '/1.jpg" class="attachment-bones-gallery-thumb wp-post-image video-thumb" alt="' . $vid_title . '">',

    // add the panel contents
      '<iframe frameborder="0" src="http://youtube.com/embed/' . ltrim ( strstr ( $vid, '=' ), '=' ) . '?wmode=opaque&amp;modestbranding=1&amp;autohide=1&amp;autoplay=1" name="1364850131166" id="gallery_video" class="cboxIframe" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" style="display: block; width: 600px; height: 400px;"></iframe>'
      );
  }

  $gallery_media = mossy_get_attachments(array(
    'numberposts' => -1,
    'post_parent' => $prod_id,
    'post_type' => 'attachment',
    'post_mime_type' => 'image,application/pdf',
    'order' => 'DESC',
    // 'exclude' => array( get_post_thumbnail_id() ),
    'orderby' => 'post_mime_type menu_order ID'
  ));

  foreach( $gallery_media as $gallery_file ) {
    if( $gallery_file->post_mime_type == "application/pdf" ) {

      $pdfs[] = array(
        '<a href="' . wp_get_attachment_url( $gallery_file->ID ) . '" target="_blank" style="position: relative; display: block;"><div
                class="pdf-thumb"
                style="
                  display: block;
                  width: 150px;
                  background-color: rgba(255,255,255,.85);
                  color: #000;
                  border-top: solid 1px #ccc;
                  border-bottom: solid 1px #ccc;
                  position: absolute;
                  top: 50px;
                  z-index: 1;
                  padding: 10px;
                  font-size: 12px;
                ">' . $gallery_file->post_title . '</div>
        <img width="150" height="100" src="' . get_stylesheet_directory_uri() . "/library/images/pdf-placeholder.jpg" . '" class="attachment-bones-gallery-thumb wp-post-image pdf-thumb" alt="' . $gallery_file->post_title . '"></a>',
        // wp_get_attachment_image( $gallery_file->ID, 'bones-gallery-thumb', true ),  // thumbnail
        '<a href="' . wp_get_attachment_url( $gallery_file->ID ) . '" target="_blank">' . wp_get_attachment_image( $gallery_file->ID, 'bones-gallery-full', true ) . '</a>'   // contents
        );
    } else {
      if( count($tabs) < 4 ) {
        $tabs[] = array(
          wp_get_attachment_image( $gallery_file->ID, 'bones-gallery-thumb' ),  // thumbnail
          wp_get_attachment_image( $gallery_file->ID, 'bones-gallery-full' )    // contents
          );
      }
    }
  }

  // add pdfs at end
  if( count($pdfs) > 0 ) {
    $free = 4 - count($tabs);

    // no free slots, replace last with first pdf so that we don't miss it out
    if( $free == 0 ) {
      $tabs[3] = $pdfs[0];

    // fill up the free slots with pdfs
    } else {
      for( $i=0; $i < $free; $i++ ) {
        if( isset($pdfs[$i]) ) $tabs[3 - $i] = $pdfs[count($pdfs) - 1 - $i];
      }
    }
  }

  // output the gallery
  echo '<div class="gallery">';
  echo '  <div id="tabs" class="tabs-bottom clearfix">
            <ul class="clearfix">';
  
  // thumbnails
  $i = 0;
  foreach( $tabs as $tab ) {
    echo '    <li><a href="#tabs-' . ++$i . '">' . $tab[0] . '</a></li>';
  }
  echo '    </ul>';

  // panels
  $i = 0;
  foreach( $tabs as $tab ) {
    echo '  <div id="tabs-' . ++$i . '">' . $tab[1] . '</div>';
  }

  // closeout
  echo '  </div>';
  echo '</div>';

  die(); // stop execution (or the rest of this file will be processed!)
}


/**
 * Loads the attached media given a post ID
 * 
 * @author       Philip Tillsley
 * 
 * @param        $id         the post ID that has the media
 * 
 * @return       array(
 *                 'video'   false | html to embed video
 *                 'image'   false | html to display image
 *               )
 */ 
function hemplers_load_media( $id, $width = 586, $height = 327 ) {

  // initialize
  $video_id      = false;
  $hdr_image     = false;
  $hdr_image_alt = false;

  // keep count for id
  global $vidcounter;
  if( !isset( $vidcounter) ) $vidcounter = 1;

  // grab video id
  $video_id      = get_post_meta( $id, '_hemplers_blockvideo_id', true );

  //d( $video_id );

  // grab featured image url
  $hdr_image     = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), array($width, $height) );
  $full_image    = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
  $hdr_image_alt = get_post_meta( get_post_thumbnail_id( $id ), '_wp_attachment_image_alt', true );
  if( is_array ( $hdr_image ) ) {
    $hdr_image = $hdr_image[0];
    $width = $hdr_image[1];
    $height = $hdr_image[2];
  };
  if( is_array ( $full_image ) ) {
    $full_image = $full_image[0];
  };

  // if we have a featured image, create the image html to display
  if( $hdr_image ) {
    $media['image'] = '<figure><a class="popup" href="' . $full_image . '"><img src="' . $hdr_image . '" alt="' . $hdr_image_alt . '" width="' . $width . '" height="' . $height . '"></a></figure>';

  } else {
    $media['image'] = false;
  }

  // if we have a video, create the html to display
  if( $video_id ) {
    global $wp_embed;
    // $video_code = '<a href=" ' . $video_id . ' "></a>';
    // ** works for embed **  $video_code = '<iframe src="http://youtube.com/embed/' . $video_id . '?modestbranding=1&autohide=1" type="text/html" frameborder="0" width="350" height="286">Video</iframe>';
    $video_code = '<a class="iframe" href="http://youtube.com/embed/' . $video_id . '?modestbranding=1&autohide=1&autoplay=1&rel=0">&nbsp; </a>';
    $video_code = '<figure>' . $video_code . '</figure>';
// d( $video_code );
    // $video_code = '<iframe id="ytplayer-' . $vidcounter . '" type="text/html" width="350" height="286"
    //   src="http://www.youtube.com/embed/' . $video_id . '?autoplay=0"
    //   frameborder="0">';
    // $video_code = '<figure>' . $video_code . '</figure>';

    // if we have a featured image use it as the placeholder background for the video
    if( $hdr_image ) {
      $replace = 'iframe style="background:url(' . $hdr_image . ');"';
      $video_code = str_replace( 'iframe', $replace, $video_code );
    }

    $media['video'] = $video_code;
  } else {
    $media['video'] = false;
  }

  return $media;
} /* END hemplers_load_media() */


/**
 * Functions to retrieve (and output) the page slug
 * based on http://www.tcbarrett.com/2011/09/wordpress-the_slug-get-post-slug-function/
 * 
 * @author       Philip Tillsley
 * 
 * @param        $id         the post ID that has the media
 * 
 * @return       post_id   defaults to current post
 *               echo      defaults to true
 */ 
function the_slug( $post_id = -1, $echo = true ) {
  if( $post_id == -1 ) {
    $slug = basename( get_permalink() );
  } else {
    $slug = basename( get_permalink( $post_id ) );
  }

  do_action( 'before_slug', $slug );
  
  $slug = apply_filters( 'slug_filter', $slug );
  if( $echo ) echo $slug;

  do_action( 'after_slug', $slug );

  return $slug;
}
function get_the_slug( $post_id = -1 ) {
    return the_slug( $post_id, false );
}


/************* SHORTCODES *************************/

/**
 * Insert the product list block
 * 
 * @author       Philip Tillsley
 * 
 * @param        none
 * 
 * @return       none
 */ 
// add_shortcode( 'productlist', 'hemplers_productlist' );
// function hemplers_productlist( $atts ) {

  // get attributes or use defaults
  // extract( shortcode_atts( array(
  //   'height' => '400px',
  //   'width' => '100%',
  // ), $atts ) );

//   $list_html = '<div id="map_canvas" style="height: ' . $height . '; width: ' . $width . ';">Mainly Mozart event location map.</div>';

//   return $list_html;
// } // END mm_googlemap()



// get_template_part( 'productlist' );


/* Change default WP functionality */

// Allow shortcodes to process in sidebar widgets
//add_filter('widget_text', 'do_shortcode');

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function my_theme_register_required_plugins() {
  /*
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
  $plugins = array(

    // Adding require WP Tiles Plugin
    array(
      'name'               => 'WP Tiles', 
      'slug'               => 'wp-tiles', 
      'source'             => 'https://downloads.wordpress.org/plugin/wp-tiles.1.1.1.zip',
    ),

  );

  /*
   * Array of configuration settings. Amend each line as needed.
   *
   * TGMPA will start providing localized text strings soon. If you already have translations of our standard
   * strings available, please help us make TGMPA even better by giving us access to these translations or by
   * sending in a pull-request with .po file(s) with the translations.
   *
   * Only uncomment the strings in the config array if you want to customize the strings.
   */
  $config = array(
    'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.

  );

  tgmpa( $plugins, $config );
}
?>
