<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="header-top">
   <a class="user-btn" title="User"><!-- <img src="<?php //echo esc_url( home_url( '/wp-content/uploads/user-icon.png') ); ?>" class="fa ffa-user"/> -->
   <i class="fa ffa-user fa-user" aria-hidden="true"></i>
     
   </a>
    <div class="user-profile">
   		<?php //echo do_shortcode('[woocommerce_my_account current_user]'); 
       if(is_user_logged_in()){
       	?>
          <div class="user-logged user-header">
         	<div class="partition">
         	<?php
         		$current_user = wp_get_current_user();
         	?>
         	<p><?php echo $current_user->display_name; ?></p>
         	<p><?php echo $current_user->display_email; ?></p>
         	</div>
         	<div class="partition">
         		<p><a href="<?php echo esc_url( home_url( '/my-account/orders/') ); ?>" title="Order">Orders</a></p>
         		<p><a href="<?php echo esc_url( home_url( '/wishlist/') ); ?>" title="Wishlist">Wishlist</a></p>
         		<p><a href="<?php echo esc_url( home_url( '/my-account/edit-address/') ); ?>" title="Addresses">Saved Addresses</a></p>
         		<p><a href="<?php echo esc_url( home_url( '/order-track/') ); ?>" title="Track Your Orders">Track Your Orders</a></p>
         	</div>
         	<div class="partition">
         		<p><a href="<?php echo esc_url( home_url( '/my-account/edit-account/') ); ?>" title="Edit Profile">Edit Profile</a></p>
         		<p><a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a></p>
         	</div>
         </div>
         <?php
       } else{ ?>
		<div class="user-login user-header">
		    <p>Your Account</p>
          <p><a href="<?php echo esc_url( home_url( '/sign-up/') ); ?>" class="feature-btn" title="Sign Up">Sign Up</a></p>
         	<p><a href="<?php echo esc_url( home_url( '/login/') ); ?>" class="feature-btn" title="Login">Log In</a></p>
         </div>         
       <?php
       }
   		?>
   </div>
   <a class="cart-customlocation" href="<?php echo esc_url( home_url( '/cart/') ); ?>">
   <!-- <img src="<?php //echo esc_url( home_url( '/wp-content/uploads/shopping-cart.png') ); ?>" class="fa ffa-shopping-cart"/> -->
   <i class="fa ffa-shopping-cart fa-shopping-cart" aria-hidden="true"></i>
   </a>
    <span class="shopping"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
  
</div><!-- .custom-header -->
