<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

*/

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');     // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// removing plugin dashboard boxes
	//remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}

/*
Now let's talk about adding your own custom Dashboard widget.
Sometimes you want to show clients feeds relative to their
site's content. For example, the NBA.com feed for a sports
site. Here is an example Dashboard Widget that displays recent
entries from an RSS Feed.

For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// RSS Dashboard Widget
/*function bones_rss_dashboard_widget() {
	if(function_exists('fetch_feed')) {
		include_once(ABSPATH . WPINC . '/feed.php');               // include the required file
		$feed = fetch_feed('http://themble.com/feed/rss/');        // specify the source feed
		$limit = $feed->get_item_quantity(7);                      // specify number of items
		$items = $feed->get_items(0, $limit);                      // create an array of items
	}
	if ($limit == 0) echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date(__('j F Y @ g:i a', 'bonestheme'), $item->get_date('Y-m-d H:i:s')); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php }
}*/

// calling all custom dashboard widgets
//function bones_custom_dashboard_widgets() {
//	wp_add_dashboard_widget('bones_rss_dashboard_widget', __('Recently on Themble (Customize on admin.php)', 'bonestheme'), 'bones_rss_dashboard_widget');
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
//}


// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
//add_action('wp_dashboard_setup', 'bones_custom_dashboard_widgets');


/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function bones_login_css() {
	wp_enqueue_style( 'bones_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function bones_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function bones_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'bones_login_css', 10 );
add_filter('login_headerurl', 'bones_login_url');
add_filter('login_headertitle', 'bones_login_title');


/************* CUSTOMIZE ADMIN *******************/

/*
I don't really recommend editing the admin too much
as things may get funky if WordPress updates. Here
are a few funtions which you can choose to use if
you like.
*/

// Custom Backend Footer
function bones_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="http://mossyrock.us" target="_blank">MossyRock</a> Media.</span>', 'bonestheme');
}

// adding it to the admin area
add_filter('admin_footer_text', 'bones_custom_admin_footer');

// Remove Unused Menu and Submenu Pages
add_action('admin_menu', 'update_admin_menu');
function update_admin_menu() {
	global $current_user;
	global $menu;
	global $submenu;

	// Get user for per-user settings
  get_currentuserinfo();

/* ALL USERS ***********************/
	// Remove Menu Pages
/*
	remove_menu_page('link-manager.php');		// Remove Links
*/
/*	remove_menu_page('themes.php');					// Remove Appearance
	remove_menu_page('edit-comments.php');	// Remove Comments
	remove_menu_page('edit.php');						// Remove Posts
*/
	// Change menu order
/*	if ( $menu['10'][0] == 'Media' && !isset( $menu['30'] ) ) {
		$menu['30'] = $menu['10']; // move media to after pages (20)
		unset( $menu['10'] );
	}
*/
	// Remove Submenu Pages
	remove_submenu_page( 'plugins.php', 'plugin-editor.php' ); // Remove Plugin Editor

	// Change Appearance Items
/*	if ( !isset( $menu['10'] ) ) {
		add_menu_page('Menus', 'Menus', 'switch_themes', 'nav-menus.php', null, null, 10);	// Add Menus
		add_menu_page('Footer', 'Footer', 'edit_theme_options', 'widgets.php', null, null, 25);	// Add Widgets
		remove_submenu_page( 'themes.php', 'nav-menus.php' ); // Remove Menus
		remove_submenu_page( 'themes.php', 'widgets.php' ); // Remove Widgets
//		d( $menu );
	} else {
		add_menu_page('Menus', 'Menus', 'switch_themes', 'nav-menus.php', null, null, 11);	// Add Menus
		add_menu_page('Footer', 'Footer', 'edit_theme_options', 'widgets.php', null, null, 25);	// Add Widgets
		remove_submenu_page( 'themes.php', 'nav-menus.php' ); // Remove Menus
		remove_submenu_page( 'themes.php', 'widgets.php' ); // Remove Widgets
	}
*/
	// Add Submenu Pages
	//	add_submenu_page( 'tools.php', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' ); 

	// Tweaks
//	$menu[26][0] = "Online Forms"; // Change Contact Forms 7 label

/* CLIENT ONLY ********************/
/*  if( substr( $current_user->user_login, 0, 3) != 'jag' ) {
  }
*/
/* EVERYONE EXCEPT 'jag' USERNAME */
/*  if( $current_user->user_login != 'jag' ) {
		remove_menu_page('plugins.php');	// Remove Plugins
  }
*/
	// Debug
	//d($menu);
	//d($submenu);
}

  /* Channge the Columns shown on the admin list */
/*  function change_page_columns($columns) {
    $holder = $columns['author'];
    
    $columns['author'] = array('block' => __('Page Block?') );
    return array_merge($columns, 
           array('publisher' => __('Publisher'), 
                 'book_author' =>__( 'Book Author')));
  }
  add_filter('manage_page_columns', 'change_page_columns');*/
//array_splice( $original, 3, 0, $inserted ); // splice in at position 3


/** Add a Page Block Column **/

	/* Display column */
	function display_page_is_block( $column, $post_id ) {
		
		// page blocks (if multiple add a check for $column = 'block')
		$is_block = false;
		$block_meta = get_post_meta( $post_id, '_hemplers_page-block' );

	  if( $block_meta[0] == 'on' ) echo 'Yes ';
	}
	add_action( 'manage_pages_custom_column' , 'display_page_is_block', 10, 2 );

	/* Add column to page list */
	function hemplers_pages_columns( $columns ) {
		$new = array();

	  foreach( $columns as $key => $title ) {
	    // if author then insert our columns before it
	    if( $key == 'author' ) $new['block'] = __( 'Page Block?' );
	    
	    // now the actual column, whatever it may be
	    $new[$key] = $title;
	  }
	  return $new;
	}
	add_filter( 'manage_pages_columns', 'hemplers_pages_columns' );

?>
