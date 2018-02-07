<?php
/* Template Name:  Recipes Page*/

get_header();

?>	
		<div class="whisqtitle">
			<h2><?php the_title(); ?></h2>
			<p class="wrapper breadcrumb-url"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Home</a> > <span><?php the_title(); ?></span></p>
		</div>
		<?php
		    $category = $_COOKIE['category_name'];
		    if($category == 'All') {
		    	$category = str_replace($category ,'','');
		    }
		    $offset = $_COOKIE['whisq_offset'];
		    ?>
		<div class="recipes-page">
			<div class="recipes-content">
	<div class="recipe cf">
  <?php
		$recipe = array( 'post_type' => 'recipes', 'posts_per_page' => 9,'offset' =>  $offset, 'recipes_categories' => $category);
		$recipe_list = new WP_Query( $recipe );
		while ( $recipe_list->have_posts() ) : $recipe_list->the_post();
		$count;
		$count++;
		?>
			<div class="recipes-page-list">
			  <div class="recipe-page-img">
			  	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			  		<?php the_post_thumbnail(); ?>
			  	</a>
			  </div>
			  <div class="recipe-page-content">			  
				  <h3>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				      <?php the_title(); ?>
				    </a>
				  </h3>
				  <p><?php the_excerpt(); ?></p>
				  <a class="recipe-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			  <div class="share-rec">
				  <span class="shareact"><img src="http://www.togglehead.net/whisq/wp-content/uploads/allshare.png"><i class="sharehide">share</i></span>
				   <div class="share-icon"><?php echo do_shortcode('[addtoany]'); ?></div>
				  </div>
			  </div>
			</div>
		<?php
		if($count == 3) {
			?>
   <div class="recipe-tip">
		<div class="tip2 item">
			<p>"A party without a cake is just a meeting" </p>
			<p>- Julia Child</p>
    </div>
   </div>
   <?php
		}
		endwhile;
		wp_reset_query(); 
  ?>
	</div>	
	</div>
<div class="recipe-sidebar">
   <div class="recipe-tip">
   <h3>tips</h3>
     <?php
		$tips = array( 'post_type' => 'tips', 'posts_per_page' => 1 );
		$tips_list = new WP_Query( $tips );
		while ( $tips_list->have_posts() ) : $tips_list->the_post();
		?>
		  <div class="side-tips"><?php the_content(); ?></div>
		<?php
		endwhile;
		wp_reset_query(); 
  ?>
   </div>
<div class="category">
<?php
$taxonomy = 'recipes_categories';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy
?>
   <h3>category</h3>
   <ul>
      <li class="all res-category <?php if($category == '') {echo 'active';} ?>">All</li>
      <?php foreach ( $terms as $term ) { ?>
        <li class="<?php echo $term->name; ?> res-category <?php if($category == $term->name) {echo 'active';} ?>"><?php echo $term->name; ?></li>
      <?php } ?>
    </ul>
<?php ?>
</div>
<div class="feature-recipes">
<h3>featured recipes</h3>
<?php
		$recipe = array( 'post_type' => 'recipes', 'recipes_categories' => 'featured', 'posts_per_page' => 5, 'orderby' => 'rand' );
		$recipe_list = new WP_Query( $recipe );
		while ( $recipe_list->have_posts() ) : $recipe_list->the_post();
		?>
			<div class="recipes-page-list">
			  <div class="recipe-page-img">
			  <a href="<?php the_permalink(); ?>">
			  	<?php the_post_thumbnail(); ?>
				</a>
			  </div>
			  <div class="recipe-page-content">
			  <a href="<?php the_permalink(); ?>">
				  <h3><?php the_title(); ?></h3>
				  </a>
        <li class="<?php //echo $term->name; ?>"><a class="" href="<?php the_permalink(); ?>">know more</a></li> 
			  </div>
			</div>
		<?php
		endwhile;
		wp_reset_query(); 
  ?>
</div>
</div>
</div>

<?php
		$recipe = array( 'post_type' => 'recipes', 'posts_per_page' => -1, 'orderby' => 'rand', 'recipes_categories' => $category );
		$recipe_list = new WP_Query( $recipe );
		while ( $recipe_list->have_posts() ) : $recipe_list->the_post();

      $number_product++;
	
		endwhile;
		wp_reset_query(); 
  ?>
      <?php 
          $a = $number_product/9;
				  $c = round($a,0,PHP_ROUND_HALF_DOWN);
				  $b = $c * 9;
      if( $number_product >= 9) { ?>
			<div id="pagination" class="pagination">
				<ul>
				<li id="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></li>
				<?php
	        for($i = 0; $i < $number_product; $i = $i + 9 ) { 
	        	$pagination;
	        	?>
	        	<li id="<?php if($i == $offset) {echo "active";} ?>" class="<?php if($i == $b - 9) {echo "hide-next";} ?>" value="<?php echo $i; ?>"><?php echo $pagination = $pagination + 1; ?></li>
	        	<?php
				}
				?>
				<li id="next"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				</ul>
			</div>
			<?php } ?>
<?php
get_footer();
?>