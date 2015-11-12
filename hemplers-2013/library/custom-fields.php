<?php
/* Custom Fields for use with Bones template
I put this in a separate file so as to keep it organized.

Uses 'Custom Metaboxes and Fields for Wordpress', found at:
https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress

Developed by: Philip Tillsley
URL: philustration.com
*/



/* ADD ADDITIONAL FIELD TYPES ******************/

/** 
 * text_url
 * - Adds the http:// to the beginning of the url if it is not present
 * 
 * @author Philip Tillsley
 * forked from original by Justin Tallant
 */
// text_url markup
add_action( 'cmb_render_text_url', 'pt_cmb_render_text_url', 10, 2 );
function pt_cmb_render_text_url( $field, $meta ) {
    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" style="width:97%" />','<p class="cmb_metabox_description">', $field['desc'], '</p>';
}
// text_url validation
add_filter( 'cmb_validate_text_url', 'pt_cmb_validate_text_url' );
function pt_cmb_validate_text_url( $new ) {
  if ( '' == $new ) { return; } // ignore empty

  $pos = stripos ( $new, 'http:\/\/' ); // case insensitive search

  if ( $pos === false || $pos > 0 ) { // not in string or not at start (eg. possible url parameter)
    $new = 'http://' . $new;
  }
  return $new;
}


/* ADD ADDITIONAL FIELDS ******************/

// let's create the function to add our metabox to the array
  function hemplers_metaboxes( $meta_boxes ) {
    if( !is_admin() ) return; // don't bother if we're not loading an admin page

    $prefix = '_hemplers_'; // Prefix for all fields

    // get the post id
    $this_id = false;
    $this_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

    $restrict_from = array( 4 ); // 4 -> home ** this is not a perfect solution for hempler's, but will do.
    $restrict_to = false;

    // Restrict from...
    if ( $this_id && $restrict_from && !in_array( $this_id, $restrict_from ) ) {
      /* Page Block Video */
      $meta_boxes[] = array(
        'id' => 'blockvideo',
        'title' => 'Page Block Video',
        'pages' => array('page'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => false, // Show field names on the left
        'fields' => array(
          array(
            'name' => 'YouTube Video ID',
            'desc' => 'YouTube ID of video, eg. "SRWRKMJUwi8" if video URL is "http://www.youtube.com/watch?v=SRWRKMJUwi8".',
            'id' => $prefix . 'blockvideo_id',
            'type' => 'text_small'
            )
          )
        );
    }

    /* Page Block */
    $meta_boxes[] = array(
      'id' => 'block',
      'title' => 'Page Block',
      'pages' => array('page'), // post types to display on
      'context' => 'side',    // 'normal', 'advanced', or 'side'
      'priority' => 'high',     // 'high', 'core', 'default' or 'low'
      'show_names' => false,    // show field names on the left?
      'fields' => array(
        array(
          'name' => 'Page Block Selector',
          'desc' => 'Check this box if this is to be shown as an internal block of the parent page, rather than as a separate page.',
          'id' => $prefix . 'page-block',
          'type' => 'checkbox'
        ),
      )
    );
    /* END NEEDS REPLACE *******************************************************************************************/

    /* Gallery Files */
    $meta_boxes[] = array(
      'id' => 'gallery_video',
      'title' => 'Gallery Video',
      'pages' => array('product'), // post types to display on
      'context' => 'normal',    // 'normal', 'advanced', or 'side'
      'priority' => 'high',     // 'high', 'core', 'default' or 'low'
      'show_names' => false,    // show field names on the left?
      'fields' => array(
        array(
          'name' => 'oEmbed 1',
          'desc' => 'Paste the YouTube URL of the video.',
          'id' => $prefix . 'embed_1',
          'type' => 'oembed',
        ),
      ),
    );

        // array(
        //   'name' => 'Images and Product PDF',
        //   'desc' => 'Add image files and a product PDF to the popup gallery.',
        //   'id' => $prefix . 'gallery_files',
        //   'type' => 'file_list',
        // ),
/*    $meta_boxes[] = array(
      'id' => 'gallery',
      'title' => 'Gallery Files',
      'pages' => array('product'), // post types to display on
      'context' => 'normal',    // 'normal', 'advanced', or 'side'
      'priority' => 'high',     // 'high', 'core', 'default' or 'low'
      'show_names' => false,    // show field names on the left?
      'fields' => array(
        // array(
        //   'name' => 'Images and Product PDF',
        //   'desc' => 'Add image files and a product PDF to the popup gallery.',
        //   'id' => $prefix . 'gallery_files',
        //   'type' => 'file_list',
        // ),
        array(
          'name' => 'File Upload Option 1',
          'desc' => 'Upload an image/PDF or enter a URL.',
          'id' => $prefix . 'gallery_file_test_1',
          'type' => 'file',
          'save_id' => true, // save ID using true as id (set above) + '_id', eg. test_file_id if you set the field id to be test_file
          'allow' => array( 'attachment' ) // limit to just attachments with array( 'attachment' )
        ),
        array(
          'name' => 'File Upload Option 2',
          'desc' => 'Upload an image/PDF or enter a URL.',
          'id' => $prefix . 'gallery_file_test_2',
          'type' => 'file',
          'save_id' => true, // save ID using true as id (set above) + '_id', eg. test_file_id if you set the field id to be test_file
          'allow' => array( 'url' ) // limit to just attachments with array( 'attachment' )
        ),
      )
    );*/


    return $meta_boxes;
  }

  // adding the metabox
  add_filter( 'cmb_meta_boxes', 'hemplers_metaboxes' );
?>