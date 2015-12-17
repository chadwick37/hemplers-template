<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="clearfix">
		<div id="main" class="clearfix" role="main">
			<section class="entry-content clearfix primary">
                <div class="fill clearfix">
                <?php
                $args = array (
                		'post_type' => 'page',
                		);
                $contents = new WP_Query($args);
                	while($contents->have_posts()):$contents->the_post();
		                if ($post->ID == 511) {
		                	echo '<div class="descriptions_blog" >';
		                	echo "<img class='aligncenter' src='".get_stylesheet_directory_uri()."/library/images/kestins-korner-1.png' alt='kestins-korner-1' width='400' height='130' />";
		                	the_content(); 
		                	echo '</div>';
		                }
					endwhile;
                   ?>
                     <div class="wrap_blog clearfix">
  						<div class="kestin-pic clearfix"></div>
    						<div class="blogcontent clearfix">
      							<div id="blog_selector" class="clearfix">
        							<ul class="menu_blog clearfix">
          								<li><a rel="all" href="/our-story/kestins-korner-2/">View All</a></li>
								             <?php
								            $cat_args = array(
								                            'hide_empty' => true,
								                        );

								            $cats = get_terms( 'category', $cat_args );
									            foreach ($cats as $cat) {
									              echo '<li><a rel="'.$cat->slug.'" href="/category/'.$cat->slug.'/">'.$cat->name.'</a></li>';
									            }
								            ?>
        							</ul>
      							</div>
        							<div class="wptiles_cat clearfix">
										<?php
										if ( have_posts() ) {
											if ( function_exists ( 'the_wp_tiles' ) ) {
												the_loop_wp_tiles();
											}
											else {
												echo "Please activated WP Tiles Plugin";
											}
										}
										else {
											echo "Empty Post on this category";
										}
										?>
        							</div> <!-- end wptiles_cat -->
    						</div> <!-- end blogcontent -->
					</div> <!-- end wrap_blog -->

				</div> <!-- end fill -->
			</section>
		</div> <!-- end main -->
	</div> <!-- end inner content -->
</div> <!-- end content -->

<?php get_footer(); ?>