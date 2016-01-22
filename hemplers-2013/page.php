<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="clearfix">
			
				    <div id="main" class="clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post();
					      $slug = get_the_slug(); ?>

					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

<?php /*                  <div class="clearfix bg-primary">
    						    <header class="article-header">
                      <div class="wrap clearfix">
      							    <h1 class="page-title" itemprop="headline">
                          <?php is_front_page() ? bloginfo('description') : the_title(); ?>
                        </h1>
                      </div>
    						    </header> */?>
    					
    						    <section class="entry-content clearfix <?php echo is_front_page() ? 'home' : $slug; ?>-primary primary " itemprop="articleBody">
                      <div class="fill clearfix">
                        
<?php
                          // font is behaving weird, trying this out to circumvent problems
                          if( $slug == "our-story" ) { 
                          	echo '<div class="wrap clearfix">';
                          	echo '<h2>Then...</h2>';
                          	the_content(); 
                          	echo '</div>';

                          }

                          // product list
                          elseif( $post->ID == 26 ) {
                          	echo '<div class="wrap clearfix">';
                          	the_content(); 
                            get_template_part( 'productlist' );
                            echo '</div>';
                          }

                          //Kestin's Blog
                          elseif( $post->ID == 511 ) {
                          	echo '<div class="descriptions_blog" >';
                            echo "<img class='aligncenter' src='".get_stylesheet_directory_uri()."/library/images/kestins-kornerpsd_1_.png' alt='kestins-korner-1'/>";
                        	the_content();
                        	echo '</div>';
                          	get_template_part( 'blogcontent' );
                          }

                          // Other Page
                          else {
                          	echo '<div class="wrap clearfix">';
                          	the_content(); 
                            echo '</div>';
                          }
?>
                      </div>
    						  	</section>
<?php           // </div>

                /* Page Blocks */

                // get child pages flagged as blocks
                $mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc', 'meta_key' => '_hemplers_page-block', 'meta_value' => 'on' ) );
                $processing_dropdowns = false;

                foreach( $mypages as $page ) {
                  $content = $page->post_content;

                  // skip empty pages
                  if ( ! $content ) continue;

                  $content = apply_filters( 'the_content', $content );
                  $title = '<h2>' . $page->post_title . '</h2>';
                  $page_id = $page->ID;

                  // if this one of the dropdown blocks or the contact block then add an ID ?>
                    <section <?php echo ( $page->post_parent != $post->ID ) ? 'id="' . get_the_slug( $page_id ) . '" ' : ''; ?><?php echo ( $slug . '-' . get_the_slug( $page_id ) == 'about-contact' ) ? 'id="contact-info" ' : ''; ?>
                        class="entry-content page-block <?php echo ( $page->post_parent != $post->ID ) ? 'panel ' : ''; ?>clearfix <?php echo ( is_front_page() ) ? 'home' : $slug; echo '-' . get_the_slug( $page_id ); ?>" itemprop="articleBody">
                      <div class="fill clearfix">
                        <div class="wrap clearfix">
                          <?php  echo is_front_page() ? '' : $title; ?>
                          <?php echo $content; ?>
                          <?php
                            // display video (if there)
                            $media = hemplers_load_media( $page_id );

                            if( $media['video'] ) {
                              echo $media['video']; // see bottom of functions.php for function that grabs this info, may wish to change output html here or there
                            } elseif( $media['image'] )  {
                              echo $media['image']; // no video, try image...
                            }
                          ?>
                        </div>
                      </div>
                    </section> <?php

                } // next child page

                /* End Page Blocks */ ?>
                
					    </article> <!-- end article -->
					
					    <?php endwhile; else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oops, Page Not Found!", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="entry-content">
    					    		<p><?php _e("Uh Oh. Something is missing. Try double checking things, or contact our website administrator for help.", "bonestheme"); ?></p>
    					    	</section>
    					    	<!--<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
    					    	</footer>-->
    					    </article>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
