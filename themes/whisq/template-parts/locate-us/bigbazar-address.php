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
<!--<h2>bigbazar</h2>-->
      <?php
    	global $wpdb;
			$tags = get_terms('post_tag');
			?> 
				<?php
				  $selected_val = 'city';
				  if(isset($_POST['select-city'])){
						$selected_val = $_POST['select-city'];  
						echo "You have selected city:" .$selected_val;  
				  }
				?>

      <?php	
			foreach ($tags as $tag){ 
				?> 
				  <?php
						$store = array( 
							'post_type' => 'address',
							'category_name' => 'bigbazar', 
							'posts_per_page' => -1,
							'tag' => $tag->slug
							);
						$store_list = new WP_Query( $store );
						if ( $store_list->have_posts() ) {?>
						<div class="wrapper citywrap <?php echo $tag->slug; ?>">
						<div class="city-name"><?php echo $tag->name; ?></div>
				 
				<?php
						while ( $store_list->have_posts() ) : $store_list->the_post();
						?><div class="cities-wrapper">
						
							<div class="city-address">
			          <h4 class="store-title"><?php the_title(); ?></h4>
			          <?php the_content(); ?>
					  <div class="cityhoverwrap">
					  <div class="cityphone">
					  <?php if(get_field('contact_number')): ?>
						<a href="tel:<?php the_field('contact_number'); ?>"><i class="fa fa-phone phoneico" aria-hidden="true"></i> <?php the_field('contact_number'); ?></a>
						<?php endif; ?>
					<?php if(get_field('contact_number1')): ?>	
						<a href="tel:<?php the_field('contact_number1'); ?>"><i class="fa fa-phone phoneico" aria-hidden="true"></i> <?php the_field('contact_number1'); ?></a>
					<?php endif; ?>
						</div>
						<?php if(get_field('city_map')): ?>
						<div class="citymap">
						<a href="<?php the_field('city_map_url'); ?>" title="<?php the_field('city_map'); ?>" target="_blank"><p> <?php the_field('city_map'); ?></p></a>
						</div>
						<?php endif; ?>
					</div>
			         </div>
					 </div>
						<?php
						endwhile; 
						?>
						</div>
						<?php 
					}
						wp_reset_query(); 
					
				}
	 ?>  
	    