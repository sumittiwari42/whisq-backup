<?php
/* Template Name: Home Front Page*/

get_header();

//feature product section start here
?>
<?php get_template_part( 'template-parts/slider/slider', 'banner' ); ?>

<?php get_template_part( 'template-parts/home/home', 'feature' ); ?>

<?php 
//Recipes section start from here
?>
<div class="wrapper cf">
	<div class="recipe cf">
	<h2 class="heading">recipes</h2>
	<p class="para">No matter what you like… sweet, savoury, decadent or plain ‘ol healthy, we have a recipe for you that will satisfy your sweet tooth. </p>
  <?php
		$recipe = array( 'post_type' => 'recipes', 'posts_per_page' => 2 );
		$recipe_list = new WP_Query( $recipe );
		while ( $recipe_list->have_posts() ) : $recipe_list->the_post();
		?>
			<div class="recipes-list">
			  <div class="recipe-img">
			    <a href="<?php the_permalink(); ?>">
			  	<?php the_post_thumbnail(); ?>
			  	</a>
			  </div>
			  <div class="recipe-content">
				  <a href="<?php the_permalink(); ?>" style="display: block;" title="<?php the_title(); ?>">
				   <h3><?php the_title(); ?></h3>
				  </a>
				  <p><?php the_excerpt(); ?></p>
				  <a class="recipe-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			  </div>
			</div>
		<?php
		endwhile;
		wp_reset_query(); 
  ?>
	</div>
</div>

<?php
//Event and Tips section start from here
?>
<div class="wrapper cf">
	<div class="events">
	  <!-- <img src="../wp-content/uploads/event.png" alt="event"> -->
	  <?php get_template_part( 'template-parts/home/home', 'event' ); ?>
	</div>
	<div class="tips">
		<?php get_template_part( 'template-parts/home/home', 'tips' ); ?>
	</div>
</div>

<?php
//About Us section start from here
?>
<div class="wrapper">
	<div class="about-section">
		<?php if( get_field('about_section_title') ): ?>
		  <h4 class="heading"><?php the_field('about_section_title'); ?></h4>
	  <?php endif; ?>
	  <?php if( get_field('about_section_text') ): ?>
		  <?php the_field('about_section_text'); ?>
	  <?php endif; ?>
	  <?php if( get_field('about_section_button_text') && get_field('about_section_button_url') ): ?>
		  <a class="btn" href="<?php the_field('about_section_button_url'); ?>" title="<?php the_field('about_section_button_text'); ?>"><?php the_field('about_section_button_text'); ?></a>
	  <?php endif; ?>
	</div>
</div>

<?php
//Find Us Store section start from here
?>
<div class="wrapper store-section cf">
	<div class="store cf">
	  <h4 class="heading">find us at</h4>
	  <?php
			$store = array( 'post_type' => 'store', 'posts_per_page' => 4, 'order' => 'ASC' );
			$store_list = new WP_Query( $store );
			while ( $store_list->have_posts() ) : $store_list->the_post();
			$title = get_the_title(); 
			?>
				<div class="store-list">
				  <div class="img-outer">
            <div class="store-img">
              <a href="<?php the_field('url_link'); ?>" target="<?php if($title == 'Amazon') {echo "_target";}  ?>">
          	  <?php the_post_thumbnail(); ?>
          	  </a>
            </div>
          </div>
          <h4 class="store-title"><?php the_title(); ?></h4>
				</div>
			<?php
			endwhile;
			wp_reset_query(); 
			?>
	</div>
			<?php if( get_field('find_us_at_button_text') && get_field('find_us_at_button_url') ): ?>
				<div class="button-wrapper">
		      <a class="btn" href="<?php the_field('find_us_at_button_url'); ?>" title="<?php the_field('find_us_at_button_text'); ?>"><?php the_field('find_us_at_button_text'); ?></a>
		  </div>
	   <?php endif; ?>	
</div>

<?php
//Instagram Feed section start from here
?>
<div class="insta-wrapper">
  <div class="insta-content">
    <h2 class="heading">instagram</h2>
    <p class="para">Desserts need not be shared, but we hope you will share your pictures with us!</p>
  </div>
  <?php echo do_shortcode('[instagram-feed showheader=false showbutton=false showfollow=true followtext="Follow Us On Instagram"]'); ?>
</div>
<?php
get_footer();
?>