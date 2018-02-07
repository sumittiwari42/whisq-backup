<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

/**
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
     <div class="no-wishlist">
		    <p class="no-wish-head">shopping cart</p>
				<p class="p-second">Your cart is currently empty</p>
				<p>Add now, <span style="float: none;">buy latter</span></p>
					<img style="height: 80px" src="<?php echo esc_url( home_url( '/wp-content/uploads/wishlist-empty.png' ) ); ?>" alt="no_wishlist" />
     </div>
    <div class="cart-footer">
        <div class="cart-footer-left">
            <a href="<?php echo esc_url( home_url( '/wishlist/') ); ?>" class="btn-cart">add more from wishlist</a>
            <a href="<?php echo esc_url( home_url( '/bakeware/') ); ?>" class="btn-cart">continue shopping</a>
        </div>
        <div class="cart-footer-right">
            <a href="<?php echo esc_url( home_url( '/contact-us/') ); ?>">need help? contact us</a>
        </div>
    </div>     
<?php endif; ?>
