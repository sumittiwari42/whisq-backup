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

<div class="stickyfilters">
<div class="filter short-by">

			<h4>Sort by</h4>
			<ul name="orderby" class="sort-cat">
<!-- 			<li value="title">Featured</li> -->
			<li value="popularity">Best Selling</li>	
<!-- 			<li value="date_desc">Date. Old to New</li>		
			<li value="date">Date. New to Old</li> -->
			<li value="meta_value_num_low">Price. Low to High</li>
			<li value="desc_meta_value_num">Price. High to Low</li>
			</ul>
		<?php
		 //product shorting filter
			$selected_val = $_COOKIE['short_cat'];

			if($selected_val == 'title') {
				$order_val = 'asc';
			} elseif ($selected_val == 'desc_meta_value_num') {
				$selected_val = 'meta_value_num';
				$order_val = 'desc';
			} elseif ($selected_val == 'meta_value_num_low') {
				$selected_val = 'meta_value_num';
				$order_val = 'asc';
			} 
 		?>
	</div>
    <div class="left-side-bar">
		<?php
		 $offset = $_COOKIE['whisq_offset'];
		   //product filter by category
			  if(is_page('pans')) {
			  	if($offset > 9 ){
			  		$offset = 0;
			  	}
			  	$category = 'pans';
			  } elseif (is_page('spatulas and whisks')) {
			  	if($offset > 9 ){
			  		$offset = 0;
			  	}
			  	$category = 'spatulas-and-whisks';
			  } elseif (is_page('mixing bowls')) {
			  	if($offset > 9 ){
			  		$offset = 0;
			  	}			  	
			  	$category = 'mixing-bowls';
			  } elseif (is_page('decorating tools')) {
			  	$category = 'decorating-tools';
			  } elseif (is_page('bakeware')) {
			  	$category = '';
			  	$all_active = 'active';
			  }

			$args = array(
			    'number'     => $number,
			    'orderby'    => $orderby,
			    'order'      => $order,
			    'hide_empty' => $hide_empty,
			    'include'    => $ids
			);
			$product_categories = get_terms( 'product_cat', $args );
			// $category1 = $_COOKIE['cat_name'];
			$category1 = $_COOKIE['cat_name'];
			 $cat_name1 = str_replace( ' ','',$category1);
			  $active = $cat_name1.'-active';
			?>
			<h4>category</h4>
			<ul id="product_cats">
			<li class="all-product <?php echo $all_active; ?>"><a href="<?php echo esc_url( home_url( '/bakeware/') ); ?>">all</a></li>
			<?php
			$count = count($product_categories);
			if ( $count > 0 ){
			    foreach ( $product_categories as $product_category ) { 
           $cat = $product_category->name;
           $cat_url = str_replace( ' ','-',$cat);
			    	?>
			        <li class="<?php echo $cat_url.' '; ?><?php if($cat_url == $category) {echo "active";} ?>"><a href="<?php echo esc_url( home_url( '/bakeware/'.$cat_url.'/') ); ?>" rel="home">  <?php echo  $cat ?></a></li>
			 <?php   }
			}
			?> 
			</ul>
			</div>
		</div>
			<div class="main-content">
			<?php
		    // $category = $_COOKIE['cat_name'];
		    // if($category == 'all') {
		    // 	$category = str_replace($category ,'','');
		     
			$bandproduct_args = array(
				'post_type'           => 'product',
				'offset'              =>  $offset,
				'product_cat'         =>  $category,
				'post_status'         => 'publish',
				'posts_per_page'      => '9',
                'orderby'             => $selected_val,
                'meta_key'            => '_price',
                'order'               => $order_val
			);
			$loop = new WP_Query( $bandproduct_args );
			    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			    
			       <div class="product-list">  
			          <div class="img-box"> 
			          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
			            <?php 
			                if ( has_post_thumbnail( $loop->post->ID ) )
			                    echo get_the_post_thumbnail( $loop->post->ID, 'shop_catalog' ); 
			                else 
			                    echo '<img alt="images" src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />'; 
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
			            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			            	<h3 class="product-title"><?php the_title(); ?></h3>
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
			<?php
			$bandproduct_args = array(
				'post_type'           => 'product',
				'product_cat'         =>  $category,
				'post_status'         => 'publish',
				'posts_per_page'      => -1,
			);
			$loop = new WP_Query( $bandproduct_args );
			    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>


			<?php 
			    $number_product;
			    $number_product = $number_product + 1;
			    endwhile;
			    wp_reset_query(); 
			?>
			<?php
				  $a = $number_product/9;
				  $c = round($a,0,PHP_ROUND_HALF_DOWN);
				  $b = $c * 9;
				  ?>
			<?php if($number_product >= 9) {?>
			<div id="pagination" class="pagination">
				<ul>
				<li id="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></li>
				<?php
	        for($i = 0; $i < $number_product; $i = $i + 9 ) { 
	        	$pagination;
	        	?>
	        	<li id="<?php if($i == $offset) {echo "active";} ?>" class="<?php if($i == $b) {echo "hide-next";} ?>" value="<?php echo $i; ?>"><?php echo $pagination = $pagination + 1; ?></li>
	        	<?php
				}
				?>
				<li id="next"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				</ul>
			</div>
			<?php } ?>