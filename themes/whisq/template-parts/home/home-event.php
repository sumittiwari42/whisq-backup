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

<?php 
global $post;
$get_posts = tribe_get_events(array('posts_per_page'=>1, 'eventDisplay'=>'upcoming') );
if ( count( $get_posts ) == 0 ) { ?>
<div class="event" style="background-image: url('<?php echo esc_url( home_url( '/wp-content/uploads/event-home-page-1-1.jpg') ); ?>'); background-size: 100% auto; padding: 6% 0;">
	<div class="event-content">
		<h3>Stay tuned for our upcoming events!</h3>
		<div class="event-link">
      <a href="<?php echo esc_url( home_url( '/events/') ); ?>" class="btn">know more</a>
    </div>
	</div>
</div>
<?php }
foreach($get_posts as $post) { setup_postdata($post);
 $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
 ?>
<p class="event-date" >
    <span><?php echo tribe_get_start_date( $post->ID, false, 'M' ); ?></span>
    <span><?php echo tribe_get_start_date( $post->ID, false, 'd' ); ?></span>
</p>
<div class="event" style="background-image: url('<?php echo $thumb['0'];?>'); background-size: 100% auto;">
	<div class="event-content">
		<h3><?php the_title(); ?></h3>
		<div class="time-address">
			<p class="event-time"> <span><?php echo tribe_get_start_date( $post->ID, false, 'g a' ); ?> - <?php echo tribe_get_end_date( $post->ID, false, 'g a' ); ?></span></p>
			<address class="event-address">
        <p><?php echo tribe_get_full_address ($post->ID, false); ?> <p>
			</address>
		</div>
		<div class="event-link">
        <a href="<?php the_permalink(); ?>" class="btn">know more</a>
         <script type="text/javascript">
		 (function () {
            if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
            if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                var h = d[g]('body')[0];h.appendChild(s); }})();
    </script>

    <!-- 3. Place event data -->
    <span class="addtocalendar atc-style-blue">
        <var class="atc_event">
            <var class="atc_date_start"><?php echo tribe_get_start_date( $post->ID, false, 'Y-m-j g:i' ); ?></var>
            <var class="atc_date_end"><?php echo tribe_get_start_date( $post->ID, false, 'Y-m-j g:i' ); ?></var>
            <var class="atc_timezone">Europe/London</var>
            <var class="atc_title"><?php echo the_title(); ?></var>
            <var class="atc_description"><?php echo the_excerpt(); ?></var>
            <var class="atc_location"><?php echo tribe_get_venue($post->ID, false); ?></var>
            <var class="atc_organizer"><?php echo tribe_get_organizer($post->ID, false); ?></var>
            <var class="atc_organizer_email"><?php echo tribe_get_organizer_email($post->ID, false); ?></var>
        </var>
		</div>
	</div>
</div>
        
 <?php }
?>
