<?php

$url = MoConstants::HOSTNAME.'/moas/login'.'?redirectUrl='.MoConstants::HOSTNAME.'/moas/viewlicensekeys';

if(get_option('mo_customer_validation_registration_status') == 'MO_OTP_DELIVERED_SUCCESS'
		|| get_option('mo_customer_validation_registration_status')  == 'MO_OTP_VALIDATION_FAILURE'
		|| get_option('mo_customer_validation_registration_status')  == 'MO_OTP_DELIVERED_FAILURE')
{
	$admin_phone = get_option('mo_customer_validation_admin_phone') ? get_option('mo_customer_validation_admin_phone') : "";
	include MOV_DIR . 'views/account/verify.php';
}
else if (get_option ( 'mo_customer_validation_verify_customer' ) == 'true' || (get_option('mo_customer_validation_admin_email') && !get_option('mo_customer_validation_admin_customer_key')))
{
	$admin_email = get_option('mo_customer_validation_admin_email') ? get_option('mo_customer_validation_admin_email') : "";
	include MOV_DIR . 'views/account/login.php';
}
else if (! MoUtility::micr())
{
	delete_option ( 'password_mismatch' );
	update_option ( 'mo_customer_validation_new_registration', 'true' );
	$current_user = wp_get_current_user();
	$admin_phone  = get_option('mo_customer_validation_admin_phone') ? get_option('mo_customer_validation_admin_phone') : "";
	include MOV_DIR . 'views/account/register.php';
}
else
{
	$customer_id = get_option('mo_customer_validation_admin_customer_key');
	$api_key     = get_option('mo_customer_validation_admin_api_key');
	$token 		 = get_option('mo_customer_validation_customer_token');
	$plan_type 	 = MoUtility::micv() ? 'otp_recharge_plan' : 'wp_otp_verification_basic_plan';

	include MOV_DIR . 'views/account/profile.php';
}