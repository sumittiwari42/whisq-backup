<?php 
/*
* Template Name: Account Template
*/
get_header();
?>
<?php if(is_user_logged_in()) {
header("location:http://www.togglehead.net/whisq/my-account/");

} else { ?>
<div class="whisqtitle">
    <h2><?php the_title(); ?></h2>
</div>
<?php
	wp_reset_query(); 
 ?>
<div class="container">
	<div class="wrap-content">
    	<?php echo the_content(); ?>
    </div>
</div>
<?php } ?>
<?php
get_footer();
?>

