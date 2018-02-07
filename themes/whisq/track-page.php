<?php
/*
* Template Name: Order Track
*/

get_header();


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>

<div class="">
<?php
do_action( 'woocommerce_before_account_navigation' );
if(is_user_logged_in()) {
?>

<div class="order-track cf">
	<div class="order-track-nav cf woocommerce">
		<nav class="woocommerce-MyAccount-navigation">
			<ul>
				<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
					<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
						<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
						<?php $nav = esc_html( $label ); ?>
					</li>
					<?php if($nav == 'Addresses') {?>
					<li class="is-active-track <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
						<a href="#">track order</a>
					</li>
				<?php } endforeach; ?>
			</ul>
			<span class="cross"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
		</nav>
		<div class="order-track-form woocommerce-MyAccount-content">
		<?php echo do_shortcode('[tracking-form]'); ?>
		</div>
	</div>
</div>
<?php }
else {
	header("location:http://www.togglehead.net/whisq/login/");
	} ?>
</div>

<?php
get_footer();
?>