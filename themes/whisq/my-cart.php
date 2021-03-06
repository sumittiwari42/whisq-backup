<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */
/* Template Name:  Cart Page*/

get_header();

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); 
?>
<div class="my-cart-outer">
<?php
if( WC()->cart->get_cart_contents_count() > 0){ ?>
	  <?php  
	 if( WC()->cart->subtotal > 0){ ?>
	<?php $total_price = sprintf ( _n( '%d', '%d', WC()->cart->subtotal ), WC()->cart->subtotal ); ?> 

	  <?php } ?>
	</div>
    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>
        <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
            <div class="cart-content">
             	<div class="cart-item-wrapper">
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                <?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
                    <div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <div class="thumbnail-item" class="product-thumbnail">
                            <?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								}
							?>
                        </div>
                        <div class="item-detail">
                            <h2 class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
								<?php
									if ( ! $product_permalink ) {
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
									} else {
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
									}

									// Meta data
									echo WC()->cart->get_item_data( $cart_item );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
									}
								?>
							</h2>
                            <div class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                <?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
                            </div>
                            <div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                <span>Quantity</span>
                                <?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->get_max_purchase_quantity(),
										'min_value'   => '0',
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
							?>
                            </div>
                            <div class="remove-wishlist">
                                <div class="product-remove">
                                    <?php
																			echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
																				'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash-o" aria-hidden="true"></i></a>',
																				esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
																				__( 'Remove this item', 'woocommerce' ),
																				esc_attr( $product_id ),
																				esc_attr( $_product->get_sku() )
																			), $cart_item_key );
																		?>
                                </div>
                            </div>
                        </div>
                        <!-- 						<div class="product-price" data-title="<?php //esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								//echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</div> -->
                    </div>
            
            <?php
				}
			}
			?>
			</div>
            <?php do_action( 'woocommerce_cart_contents' ); ?>
            <div class="cart-wrapper-custom">
	            <div class="cart-side">
	                <div class="actions">
	                    <?php if ( wc_coupons_enabled() ) { ?>
	                    <div class="coupon">
	                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter Discount Code', 'woocommerce' ); ?>" />
	                        <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />
	                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
	                    </div>
	                    <?php } ?>
	                    <input type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" />
	                    <?php do_action( 'woocommerce_cart_actions' ); ?>
	                    <?php wp_nonce_field( 'woocommerce-cart' ); ?>
	                </div>
	            </div>
	            <div class="cart-collaterals">
			        <?php
					/**
					 * woocommerce_cart_collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
				 	do_action( 'woocommerce_cart_collaterals' );
				?>
			    </div>
		    </div>
           
            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </div>
        </div>
    </form>
  
    <?php } else { ?>
    </div>
                    <div class="no-wishlist">
									<p class="no-wish-head">shopping cart</p>
									<p class="p-second">Your cart is currently empty</p>
									<p>Add now, <span style="float: none;">buy latter</span></p>
									<img style="height: 80px" src="<?php echo esc_url( home_url( '/wp-content/uploads/wishlist-empty.png' ) ); ?>" alt="no_wishlist" />
									<div>
									<!-- <a href="<?php //echo esc_url( home_url( '/bakeware/' ) ); ?>" class="feature-btn button" title="Continue Shopping">continue shopping</a> -->
									</div>
								</div>
    <?php } ?>
    <div class="cart-footer">
        <div class="cart-footer-left">
            <a href="<?php echo esc_url( home_url( '/wishlist/') ); ?>" class="btn-cart">add more from wishlist</a>
            <a href="<?php echo esc_url( home_url( '/bakeware/') ); ?>" class="btn-cart">continue shopping</a>
        </div>
        <div class="cart-footer-right">
            <a href="<?php echo esc_url( home_url( '/contact-us/') ); ?>">need help? contact us</a>
        </div>
    </div>
    <?php do_action( 'woocommerce_after_cart' ); 

get_footer();

?>