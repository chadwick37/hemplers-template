<div class="wrap_blog clearfix">
  <div class="kestin-pic clearfix"></div>
    <div class="blogcontent clearfix">
      <div id="blog_selector" class="clearfix">
        <ul class="menu_blog clearfix">
          <li><a rel="all" href="/our-story/kestins-korner/">View All</a></li>
              <?php
            wp_list_categories( array(
                'include'           => 'ID',    
                'exclude'           => '',
                'exclude_tree'      => '',
                'child_of'          => 0,
                'hide_empty'        => 1,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'use_desc_for_title'=> 1,
                'number'            => NULL,
                'hierarchical'      => true,    
                'show_count'        => 0,    
                'pad_counts'        => 0,
                'style'             => 'list',
                /* 'style' set to list "creates list items for an unordered list" */
                'show_option_all'   => '',
                'show_option_none'  => __('No categories'),
                'show_last_update'  => 0,
                'feed'              => '',
                'feed_type'         => '',
                'feed_image'        => '',
                'current_category'  => 0,
                'taxonomy'          => 'category',
                'title_li'          => __( '' ),
                /* 'title_li' set to '' for menus from the default 'Categories' */
                'echo'              => 1,
                'depth'             => 0,
                'walker'            => 'Walker_Category'   
                ) );
            ?>
        </ul>
      </div>
        <div class="wptiles clearfix">
            <?php
            if ( function_exists ( 'the_wp_tiles' ) ) {
              echo do_shortcode('[wp-tiles full_width post_type="post" orderby="date" order="DESC" grids="News"]');
            }
            else {
              echo "Please Activated WP Tiles Plugin";
            }
            ?>
        </div>
    </div>
</div>