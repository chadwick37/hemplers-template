<?php

/*
 * Generate the product list block for the products page
 */

/* Page functions */

// for checking if this is an icon type, since we only display icons for a few types
if( !function_exists( "isicon" ) ) {
  function isicon($type) {

    // slugs that correspond to an icon
    return in_array( $type->slug, array(
        'prepared',
        'no-nitrites',
        'watch-how',
      ) );
  }
}
if( !function_exists( "isfilter" ) ) {
  function isfilter($type) {

    // slugs that aren't an icon are filters
    return !isicon( $type );
  }
}

/* Page output */

?>
                        <div id="product_block" class="clearfix">
                          <div id="product_selector" class="clearfix">
                            <ul class="clearfix">
                              <li><a rel="all" href="/our-products">View All</a></li>
<?php
                              $cat_args = array(
                                'hide_empty'      => false,
                                );

                              $cats = array_filter( get_terms( 'product_types', $cat_args ), "isfilter" );

                              foreach( $cats as $cat ) {


                                echo '<li><a rel="' . $cat->slug . '" href="/product-type/' . $cat->slug . '" title="' . sprintf(__('Filter to only %s'), $cat->name) . '">' . str_replace( '(ICON) ', '', $cat->name ) . '</a></li>';
                              }
?>
                            </ul>
                          </div>

                          <div id="product_list" class="clearfix">
                            <ul class="clearfix">
<?php                       /* List of Products */

                              $prod_args = array(
                                'posts_per_page'  => -1,
                                'numberposts'     => -1,
                               // 'category'        => '',
                                'orderby'         => 'post_date',
                                'order'           => 'ASC',
                                'post_type'       => 'product',
                                'post_status'     => 'publish',
                                'suppress_filters' => true );
                              $products = get_posts( $prod_args );

                              foreach( $products as $product ) {
                                setup_postdata( $product );
                                $cats = get_the_terms( $product->ID, 'product_types' );

?>
                              <li class="<?php
                                if( $cats ) {
                                  foreach( $cats as $cat ) {
                                    echo $cat->slug . " ";
                                  }
                                } ?>">
                                <figure>
                                  <div class="clearfix thumb">
<?php
                                    // by default we'll grab a big version of the product image
                                    // but we'll use javascript to change this behaviour to build a gallery instead
                                    $full = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), array(800,800) );
                                    // $gallery = get_stylesheet_directory_uri('') . '/productgallery.php';
?>
                                    <a class="ajax" href="<?php echo $full[0] . '?' . $product->ID; ?>">
<?php
                                      if( has_post_thumbnail( $product->ID ) ) echo get_the_post_thumbnail( $product->ID, array(220,220) ); else echo '<img class="placeholder">';

                                      // get/filter the list of product types this product belongs to
                                      $prod_cats = array_filter( wp_get_post_terms( $product->ID, 'product_types' ), "isicon" );

?>                                  </a>
<?php
                                      // output the list
                                      if( $prod_cats && (count($prod_cats) > 0) ) {
                                        echo '<ul class="product-types">';
                                        foreach( $prod_cats as $prod_cat ) {
// no link for these atm                                          echo '<li><!-- <a href="#" class="' . $prod_cat->slug . '"> -->' . $prod_cat->name . '<!-- </a> --></li>';
                                          echo '<li><span class="' . $prod_cat->slug . '">' . $prod_cat->name . '</span></li>';
                                        }
                                        echo '</ul>';
                                      }
?>
                                  </div>
                                  <figcaption><?php echo get_the_title( $product->ID ); ?></figcaption>
                                </figure>
                              </li>
<?php //the_content();
                              }

                            /* End Product List */ ?>
                            </ul>
                          </div>
                        </div>
<?php  ?>

<!-- preload header images -->
<div style="display: none;">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-bacon.gif">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-pepperoni.gif">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-franks.gif">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-turkey.gif">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-sausage.gif">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-smoked-sausage.gif">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-snapshot.png">
<img src="/wp-content/themes/hemplers-2013/library/images/products-header-summer-sausage.gif">
</div>

	                 