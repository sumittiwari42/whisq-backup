<?php
/*
*Template Name: Media Article
*/

get_header();
?>

	<div class="whisqtitle">
		<h2><?php the_title(); ?></h2>
		<p class="wrapper breadcrumb-url"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Home</a> > <span><?php the_title(); ?></span></p>
	</div>
	<?php
		 wp_reset_query(); 
	?>
	<div class="wrapper">
		<div class="media-para">
			<?php the_content(); ?>
		</div>
		<div class="cf media-filter-list">
		<div class="eventsort-by media-short-year">
	  <h4>Year</h4>
      <ul name="orderby" class="event-catagory-year">
      <li class="" value="2017">2017</li>
      <li class="" value="2018">2018</li>  
      </ul>
    </div>
		<div class="eventsort-by media-short">
	  <h4>Month</h4>
      <ul name="orderby" class="event-catagory">
      <li class="" value="January">January</li>
      <li class="" value="February">February</li>
      <li class="" value="March">March</li>
      <li class="" value="April">April</li>
      <li class="" value="May">May</li>
      <li class="" value="June">June</li>
      <li class="" value="July">July</li>
      <li class="" value="August">August</li>
      <li class="" value="September">September</li>
      <li class="" value="October">October</li>
      <li class="" value="November">November</li>
      <li class="" value="December">December</li>    
      </ul>
    </div>
    </div>
		<div class="media-wrap cf">
		<?php
    $offset = $_COOKIE['whisq_offset'];
		$media = array( 'post_type' => 'media', 'posts_per_page' => 9, 'offset' =>  $offset, 'order' => 'ASC');
		$media_list = new WP_Query( $media );
		while ( $media_list->have_posts() ) : $media_list->the_post();
		?><?php
			$date = get_field('media_date');
			$month_class = explode(' ',trim($date));
		?>
			<div class="media-list <?php echo $month_class[0].' '.$month_class[2]; ?>">
			<div class="media-content">
			  <a target="_blank" href="<?php the_field('publication_url'); ?>">
			    <?php the_post_thumbnail(); ?>
			  </a>
			  <h3 class="media-heading">
			  	<?php the_title(); ?>
			  </h3>
			  <?php if (get_field('publication_url')) { ?>
			  <a class="media-logo" target="_blank" href="<?php the_field('publication_url'); ?>" title="Publication">
			  	<img src="<?php the_field('publication_logo'); ?>" alt="Publication">
			  </a>	
			  <?php } ?> 
			</div>
			<div class="media-content-popup">
				<div class="media-popup-content">
			  <h4><?php the_title(); ?></h4>
			  <div class="media-con"><?php the_content(); ?></div>
			  </div>
			</div>
			<span class="pop-up-close"><i class="fa fa-times" aria-hidden="true"></i></span>
			<?php if (get_field('media_date')) { ?>
			<div class="media-date">
				<?php the_field('media_date'); ?>
			</div> 
			<?php } ?>	
			</div>
   <?php
		endwhile;
		wp_reset_query(); ?>
		<h3 class="no-media">No Media Available</h3>
		</div>
	</div>
	<?php
		$media = array( 'post_type' => 'media', 'posts_per_page' => -1);
		$media_list = new WP_Query( $media );
		while ( $media_list->have_posts() ) : $media_list->the_post();

      $number_product++;
	
		endwhile;
		wp_reset_query(); 
  ?>
      <?php if( $number_product >= 9) { ?>
			<div id="pagination" class="pagination">
				<ul>
				<li id="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></li>
				<?php
	        for($i = 0; $i < $number_product; $i = $i + 9 ) { 
	        	$pagination;
	        	?>
	        	<li id="<?php if($i == $offset) {echo "active";} ?>" value="<?php echo $i; ?>"><?php echo $pagination = $pagination + 1; ?></li>
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