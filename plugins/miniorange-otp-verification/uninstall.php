<?php
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

	delete_option('mo_customer_validation_admin_email');
	delete_option('mo_customer_validation_company_name');
	delete_option('mo_customer_validation_first_name');
	delete_option('mo_customer_validation_last_name');
	delete_option('mo_customer_validation_wp_default_enable');
	delete_option('mo_customer_validation_wp_default_enable_type');
	delete_option('mo_customer_validation_wc_default_enable');
	delete_option('mo_customer_validation_wc_enable_type');
	delete_option('mo_customer_validation_wc_social_login_enable');
	delete_option('mo_customer_validation_pb_default_enable');
	delete_option('mo_customer_validation_um_default_enable');
	delete_option('mo_customer_validation_simplr_default_enable');
	delete_option('mo_customer_validation_simplr_enable_type');
	delete_option('mo_customer_validation_simplr_field_key');
	delete_option('mo_customer_validation_um_enable_type');
	delete_option('mo_customer_validation_event_default_enable');
	delete_option('mo_customer_validation_event_enable_type');
	delete_option('mo_customer_validation_bbp_default_enable');
	delete_option('mo_customer_validation_bbp_disable_activation');
	delete_option('mo_customer_validation_crf_default_enable');
	delete_option('mo_customer_validation_crf_enable_type');
	delete_option('mo_customer_validation_crf_phone_key');
	delete_option('mo_customer_validation_crf_email_key');
	delete_option('mo_customer_validation_uultra_default_enable');
	delete_option('mo_customer_validation_uultra_enable_type');
	delete_option('mo_customer_validation_uultra_phone_key');
	delete_option('mo_customer_validation_bbp_enable_type');
	delete_option('mo_customer_validation_bbp_phone_key');
	delete_option('mo_customer_validation_wc_checkout_enable');
	delete_option('mo_customer_validation_wc_checkout_type');	
	delete_option('mo_customer_validation_upme_default_enable');
	delete_option('mo_customer_validation_upme_enable_type');
	delete_option('mo_customer_validation_upme_phone_key');
	delete_option('mo_customer_validation_wc_redirect');
	delete_option('mo_customer_validation_wc_checkout_button');
	delete_option('mo_customer_validation_wc_checkout_guest');
	delete_option('mo_customer_validation_pie_default_enable');
	delete_option('mo_customer_validation_pie_enable_type');
	delete_option('mo_customer_validation_pie_phone_key');
	delete_option('mo_customer_check_ln');
	delete_option('mo_customer_validation_transaction_message');
	delete_option('mo_customer_validation_cf7_contact_enable');
	delete_option('mo_customer_validation_cf7_contact_type');
	delete_option('mo_customer_validation_cf7_email_key');
	delete_option('mo_customer_validation_ninja_form_otp_enabled');
	delete_option('mo_customer_validation_ninja_form_enable');
	delete_option('mo_customer_validation_ninja_form_enable_type');
	delete_option('mo_customer_validation_tml_enable');
	delete_option('mo_customer_validation_tml_enable_type');
	delete_option('mo_customer_validation_userpro_default_enable');
	delete_option('mo_customer_validation_userpro_enable_type');
	delete_option('mo_customer_validation_gf_otp_enabled');
	delete_option('mo_customer_validation_gf_contact_enable');
	delete_option('mo_customer_validation_gf_contact_type');
	delete_option('mo_customer_validation_wp_login_enable');
	delete_option('mo_customer_validation_wp_login_register_phone');
	delete_option('mo_customer_validation_wp_login_bypass_admin');
	delete_option('mo_customer_validation_wp_login_key');
	delete_option('mo_customer_validation_wp_member_reg_enable');
	delete_option('mo_customer_validation_wp_member_reg_enable_type');
	delete_option('mo_customer_validation_default_country_code');
	delete_option('mo_customer_validation_ultipro_enable');
	delete_option('mo_customer_validation_ultipro_type');
	delete_option('mo_customer_validation_classify_enable');
	delete_option('mo_customer_validation_classify_type');		
	delete_option('mo_customer_validation_reales_enable');
	delete_option('mo_customer_validation_reales_enable_type');
	delete_option('mo_otp_success_email_message');
	delete_option('mo_otp_success_phone_message');
	delete_option('mo_otp_error_phone_message');
	delete_option('mo_otp_error_email_message');
	delete_option('mo_otp_invalid_phone_message');
	delete_option('mo_customer_validation_wc_checkout_popup');
	delete_option('mo_customer_validation_wp_login_allow_phone_login');
	delete_option('mo_customer_validation_wp_login_restrict_duplicates');
	delete_option('mo_customer_validation_blocked_domains');
	delete_option('mo_customer_validation_blocked_phone_numbers');
	delete_option('mo_customer_validation_wp_reg_restrict_duplicates');
	delete_option('mo_customer_validation_show_remaining_trans');
	delete_option('mo_customer_validation_show_dropdown_on_form');
	delete_option('mo_customer_validation_emember_default_enable');
	delete_option('mo_customer_validation_emember_enable_type');
	delete_option('email_verification_lk');
	delete_option('site_email_ckl');
	delete_option('mo_customer_validation_formcraft_enable');
	delete_option('mo_customer_validation_formcraft_otp_enabled' );
	delete_option('mo_customer_validation_formcraft_enable_type' );
	delete_option('mo_customer_validation_formcraft_premium_enable' );
	delete_option('mo_customer_validation_formcraft_premium_enable_type' );
	delete_option('mo_customer_validation_fcpremium_otp_enabled' );
	delete_option('mo_customer_validation_wpcomment_enable' );
	delete_option('mo_customer_validation_wpcomment_enable_type' );
	delete_option('mo_customer_validation_wpcomment_enable_for_loggedin_users' );
	delete_option('mo_customer_validation_wc_checkout_payment_type' );
	delete_option('mo_customer_validation_otp_length');
	delete_option('mo_customer_validation_otp_validity');
?>