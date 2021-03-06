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
<form action="#" method="post" name="form" class="" >
			<h4>Sort by</h4>
			<ul name="orderby" class="sort-cat" onchange="this.form.submit()">
			<li value="popularity">Best Selling</li>
			<li value="title">title</li>
			<li value="rating">average rating</li>
			<li value="date">Date. New to Old</li>
			<li value="price">Price. Low to High</li>
			<li value="price-desc">Price. High to Low</li>
			</ul>
			</form>
		<?php
 				  if(isset($_POST['orderby'])){
 						$selected_val = $_POST['orderby'];  
 				  }
 				?>
	</div>
        <div class="left-side-bar">
		<?php
			$args = array(
			    'number'     => $number,
			    'orderby'    => $orderby,
			    'order'      => $order,
			    'hide_empty' => $hide_empty,
			    'include'    => $ids
			);
			$product_categories = get_terms( 'product_cat', $args );
			
			$category1 = $_COOKIE['cat_name'];
			 $cat_name1 = str_replace( ' ','',$category1);
			  $active = $cat_name1.'-active';
			?>
			<h4>category</h4>
			<ul id="product_cats">
			<li class="all-product <?php echo $active ?>">all</li>
			<?php
			$count = count($product_categories);
			if ( $count > 0 ){
			    foreach ( $product_categories as $product_category ) {
			    	$cat = $product_category->name;
            $cat_name = str_replace( ' ','',$cat);
			    	?>

			        <li class="<?php echo $cat_name.' '.$active ?>"> <?php echo $product_category->name ?> </li>
			      <?php
			    }
			}
			?> 
			</ul>
			</div>
		</div>
			<div class="main-content">
			<?php
				$bandproduct_args = array(
				'post_type'           => 'product',
				'product_cat'         =>  $category,
				'post_status'         => 'publish',
				'posts_per_page'      => '-1',

			);
			$loop = new WP_Query( $bandproduct_args );
			    while ( $loop->have_posts() ) : $loop->the_post(); global $product; 
			    $number_product;
			    $number_product = $number_product + 1;
			    endwhile;
			    wp_reset_query(); ?>
			
            <?php			
			
			 //fetching category value from cookies for category filter
		    $category = $_COOKIE['cat_name'];
		    if($category == 'all') {
		    	$category = str_replace($category ,'','');
		    	echo $category;
		    }

      //fetching offset value from cookies for offset pagination
		  $offset = $_COOKIE['whisq_offset'];
		  
			$bandproduct_args = array(
				'post_type'           => 'product',
				'offset'              =>  $offset,
				'product_cat'         =>  $category,
				'post_status'         => 'publish',
				'posts_per_page'      => '10',
				'orderby'             =>  $selected_val,
				'order'               => 'ASC',
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
			                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />'; 
			            ?>
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
			<div id="pagination" class="pagination">
				<ul>
				<li id="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></li>
				<?php
	        for($i = 0; $i < $number_product; $i = $i + 10 ) { 
	        	$pagination;
	        	?>
	        	<li id="<?php if($i == $offset) {echo "active";} ?>" value="<?php echo $i; ?>"><?php echo $pagination = $pagination + 1; ?></li>
	        	<?php
				}
				?>
				<li id="next"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				</ul>
			</div>
	    