<?php

/*
 * Generate a product gallery for a given product provided in url
 */

/* Gallery Output */

                                    $placeholder_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), array(400,400) );
                                    echo '<img src="' . $placeholder_image[0] . '">';

?>
                                      <p>hello world</p>
<?php
                                      // if( has_post_thumbnail( $product->ID ) ) echo get_the_post_thumbnail( $product->ID, array(800,800) ); else echo '<img class="placeholder">';

?>