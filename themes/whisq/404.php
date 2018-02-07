<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
  <div class="error-image">
  	<img src="<?php echo esc_url( home_url('/wp-content/uploads/404-image.png') ); ?>" alt="not found">
  </div>
	<p>Sorry, the page you are looking for could not be found</p>
	<a href="<?php echo esc_url( home_url() ); ?>" class="btn">back to homepage</a>
</div><!-- .wrap -->

<?php get_footer();
