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
	<div class="whisqtitle">
		<h2>recipes</h2>
		<p class="wrapper breadcrumb-url"><a class="backlink" href="<?php echo esc_url( home_url( '/recipes/' ) ); ?>" title="Recipes">Back</a><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Home</a> > <a href="<?php echo esc_url( home_url( '/recipes/' ) ); ?>" class="res-url" rel="home">Recipes</a> > <span><?php the_title(); ?></span></p>
	</div>
<div class="header-post">
<?php the_post_thumbnail(); ?>
</div>	
<div class="wrapper">
	<h2 class="post-title"><?php the_title(); ?></h2>
	<div class="list">
		<?php if(get_field('servings')) : ?>
		<span><img src="<?php echo esc_url( home_url( '/wp-content/uploads/restaurant.png') ); ?>" class="fa ffa-shopping-cart">
			Servings - <?php the_field('servings'); ?></span>
		<?php endif; ?>
		<?php if(get_field('preparation')) : ?>
		<span><img src="<?php echo esc_url( home_url( '/wp-content/uploads/clock.png') ); ?>" class="fa ffa-shopping-cart">
			Preparation - <?php the_field('preparation'); ?></span>
		<?php endif; ?>
		<?php if(get_field('baking')) : ?>
		<span><img src="<?php echo esc_url( home_url( '/wp-content/uploads/baking.png') ); ?>" class="fa ffa-shopping-cart">
			Baking - <?php the_field('baking'); ?></span>
		<?php endif; ?>
		<?php if(get_field('email_recipes')) : ?>
		<span class="a2a_kit recipe-email-rtain a2a_kit_size_32 a2a_default_style"><img src="<?php echo esc_url( home_url( '/wp-content/uploads/email.png') ); ?>" class="fa ffa-shopping-cart">
<a class="a2a_button_google_gmail"><?php the_field('email_recipes'); ?></a>
</span></a>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
		<?php endif; ?>
	</div>
	<div class="recipepara">
	<p><?php the_excerpt(); ?></p>
	</div>
	<div class="recipe-detail cf">
	  <?php if(get_field('integedien')) : ?>	  
		<div class="ingrediean">
			<img src="<?php echo esc_url( home_url( '/wp-content/uploads/bowl.png') ); ?>" class="rcimg"><h4>Ingredients</h4>
			<div class="ingrediean-content">
				<?php the_field('integedien'); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(get_field('method')) : ?>
		<div class="method">
			<img src="<?php echo esc_url( home_url( '/wp-content/uploads/cook.png') ); ?>" class="rcimg"><h4>method</h4>
			<div class="method-content">
			  <?php the_field('method'); ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
  <div class="share-rec">
				  <span class="">share</span>
				   <div class="share-perma-icon"><?php echo do_shortcode('[addtoany]'); ?></div>
				  </div>
  <div class="tag">
  	<?php if(get_field('tags')) : ?>
			<p><img src="<?php echo esc_url( home_url( '/wp-content/uploads/price-tag.png') ); ?>" class="rcimg">tags</p><?php the_field('tags'); ?>
		<?php endif; ?>
  </div>
  <div class="post-change">
	  <span><?php previous_post_link('%link','<span class="prev">Previous</span>'); ?></span>
	  <span><?php next_post_link('%link','<span class="next">Next</span>'); ?></span>     
  </div>
</div>
<div class="extra-wrapper">
  <ul class="select-extra cf">
  	<li class="youmaylike active"><p>Products in use</p></li>
  	<li class="accessoriesused"><p>More Recipes</p></li>
  </ul>
	<div class="recipe recipelisthide cf">
  <?php
		$recipe = array( 'post_type' => 'recipes', 'posts_per_page' => 3, 'orderby' => 'rand' );
		$recipe_list = new WP_Query( $recipe );
		while ( $recipe_list->have_posts() ) : $recipe_list->the_post();
		?>
			<div class="recipes-page-list">
			  <div class="recipe-page-img">
			  	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			  		<?php the_post_thumbnail(); ?>
			  	</a>
			  </div>
			  <div class="recipes-page-content">
			  <h3>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				    <?php the_title(); ?>
				  </a>
				</h3>
				<p><?php the_excerpt(); ?></p>
				<a class="recipe-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			  <div class="share-rec">
				  <span class="shareact"><img src="<?php echo esc_url( home_url( '/wp-content/uploads/allshare.png') ); ?>"><i class="sharehide">share</i></span>
				   <div class="share-icon"><?php echo do_shortcode('[addtoany]'); ?></div>
				  </div>
       </div>
	   </div>
			
		<?php

		endwhile;
		wp_reset_query(); 
  ?>
  </div>
  </div>
  <div class="related-accesories cf">
  			<?php
		  $product_name_first = strtolower(get_field('use_in_first_product'));
		  $product_name_second = strtolower(get_field('use_in_second_product'));
		  $product_name_third = strtolower(get_field('use_in_third_product'));
			$bandproduct_args = array(
				'post_type'           => 'product',
				'product_cat'         =>  '',
				'post_status'         => 'publish',
				'posts_per_page'      => -1,
				'order'               => 'ASC',
			);
			?>
			</br>
			<?php
			$loop = new WP_Query( $bandproduct_args );
			    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			      <?php $product_name = strtolower(get_the_title($loop->post->ID)); 
             if( $product_name == $product_name_first || $product_name == $product_name_second || $product_name == $product_name_third  ) {
			      ?>
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
	    	}
			    endwhile;
			    wp_reset_query(); 
			?>
  </div>
</div>
	    