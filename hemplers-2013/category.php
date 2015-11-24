<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="clearfix">
		<div id="main" class="clearfix" role="main">
			<section class="entry-content clearfix primary">
                <div class="fill clearfix">
                <?php
                echo '<div class="descriptions_blog" >';
                    ?>
                    <p><a href="http://wp.app/our-story/kestins-korner/kestins-korner-1/" rel="attachment wp-att-767">
						<img class="aligncenter size-full wp-image-767" src="http://wp.app/wp-content/uploads/kestins-korner-1.png" alt="kestins-korner-1" width="300" height="100" /></a><br />
						Hempler’s isn’t just a brand, it’s a family- and not just any family, it’s my family.<span class="read-more-content">
						There are living, breathing people who interact daily to make the ham, bacon, and sausages that many have grown up with over the past nearly 80 years. Times have changed, it’s no longer my Grandfather, Father and me hand twisting the sausages- true! However my father and I are involved each and every day. And I am more passionate about our humble family than perhaps ever before. Food in general is a passion of mine. Combine food with family- or any person, for that matter, and I have all I need! I love to connect with people over food, reminisce about favorite memories with them (which, let’s face it, usually involve food), and dream about the future (again, food is always in there). C’mon, you have to admit you have already thought about a favorite meal you can’t wait to make or order sometime this week and have made plans with family or friends, right? That’s what I’m talking about! In this time, when a million different options are available to us for any one thing we could possibly need, don’t you go with the familiar option? The one you know and trust? I do!
						That said, I’m so glad you’re here! Let’s connect! About food. About family. About life. I want to share with you what the Hempler family is all about. I want to share my story, my memories, and my hopes for the future with you. And I’d love to hear from you too!</span></p>
                    <?php
                        	echo '</div>';
                   ?>
                     <div class="wrap_blog clearfix">
  						<div class="kestin-pic clearfix"></div>
    						<div class="blogcontent clearfix">
      							<div id="blog_selector" class="clearfix">
        							<ul class="menu_blog clearfix">
          								<li><a rel="all" href="/our-story/kestins-korner/">View All</a></li>
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
										if ( function_exists ( 'the_wp_tiles' ) ) {
											the_loop_wp_tiles();
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