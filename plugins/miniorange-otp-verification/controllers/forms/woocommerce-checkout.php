<?php

//wc checkout
$wc_checkout 			  = get_option('mo_customer_validation_wc_checkout_enable') ? "checked" : "";
$wc_checkout_hidden		  = $wc_checkout=="checked" ? "" : "hidden";
$wc_checkout_enable_type  = get_option('mo_customer_validation_wc_checkout_type');
$guest_checkout 		  = get_option('mo_customer_validation_wc_checkout_guest')  ? "checked" : "";
$checkout_button 		  = get_option('mo_customer_validation_wc_checkout_button') ? "checked" : "";
$checkout_popup 		  = get_option('mo_customer_validation_wc_checkout_popup')  ? "checked" : "";
$checkout_payment_plans   = maybe_unserialize(get_option('mo_customer_validation_wc_checkout_payment_type'));

$wc_type_phone 			  = WooCommerceCheckOutForm::TYPE_PHONE;
$wc_type_email 			  = WooCommerceCheckOutForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/woocommerce-checkout.php';