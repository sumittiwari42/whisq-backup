<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Whisq
 * @since 1.0
 * @version 1.0
 */

?>

<div class="wrapper">
	<div class="feature">
		<h2 class="heading">featured products</h2>
		<p class="para">Beautiful, innovative products, designed in-house just for you.</p>
		<div class="owl-carousel owl-theme" id="carousel01">
			<?php
			$meta_query  = WC()->query->get_meta_query();
			$tax_query   = WC()->query->get_tax_query();
			$tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
				);

			$bandproduct_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'posts_per_page'      => '10',
				'orderby'             => 'modified',
				'order'               => 'DESC',
				'meta_query'          => $meta_query,
				'tax_query'           => $tax_query,
			);
			$loop = new WP_Query( $bandproduct_args );
			    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			    
			       <div class="feature-item">  
			          <div class="img-box"> 
			          <a href="<?php the_permalink(); ?>"> 
			            <?php 
			                if ( has_post_thumbnail( $loop->post->ID ) )
			                    echo get_the_post_thumbnail( $loop->post->ID, 'shop_catalog' ); 
			                else 
			                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />'; 
			            ?>
			            </a>
			            <a>
			            <div class="wishlist-add">
                    <?php
                    echo do_shortcode('[yith_wcwl_add_to_wishlist]');
			            ?>
			            </div>
			            </a>
			            </div>
			            <a href="<?php the_permalink(); ?>"> 
			            <h3 class="feature-title"><?php the_title(); ?></h3>
                  </a>
			            <?php 
			                echo $product->get_price_html(); 
			                woocommerce_template_loop_add_to_cart( $loop->post, $product );
			            ?>    
			        </div>

			<?php 
			    endwhile;
			    wp_reset_query(); 
			?>
		</div>
	</div>
</div>
