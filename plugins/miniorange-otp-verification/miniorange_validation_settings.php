<?php

/**
* Plugin Name: Email Verification / SMS verification / Mobile Verification
* Plugin URI: http://miniorange.com
* Description: Email verification for all forms Woocommerce, Contact 7 etc. SMS and Mobile Verification for all forms. Enterprise grade. Active Support. 
* Version: 3.2.34
* Author: miniOrange
* Author URI: http://miniorange.com
* Text Domain: wp-otp-verification
* License: GPL2
*/

include '_autoload.php';

class Miniorange_Customer_Validation 
{

	function __construct()
	{
		add_action( 'plugins_loaded'						, array( $this, 'otp_load_textdomain'						 )		  );
		add_action( 'admin_menu'							, array( $this, 'miniorange_customer_validation_menu' 		 ) 		  );
		add_action( 'admin_enqueue_scripts'					, array( $this, 'mo_registration_plugin_settings_style'      ) 		  );
		add_action( 'admin_enqueue_scripts'					, array( $this, 'mo_registration_plugin_settings_script' 	 ) 		  );
		add_action( 'wp_enqueue_scripts'					, array( $this, 'mo_registration_plugin_frontend_scripts' 	 ) 		  );
		add_action( 'mo_registration_show_message'			, array( $this, 'mo_show_otp_message'    		 			 ),1   , 2);
		add_action( 'init'									, array( $this, 'moScheduleTransactionSync'	 			 	 ),1   	  );
		add_action( 'hourlySync'							, array( $this, 'hourlySync'								 ) 		  );
		add_action( 'admin_init'							, array( $this, 'register_ppl_strings'						 ),1	  );
		register_deactivation_hook(__FILE__					, array( $this, 'mo_registration_deactivate'				 ) 		  );
	}

	function miniorange_customer_validation_menu() 
	{
		$menu_slug = 'mosettings';
		add_menu_page (	'OTP Verification' , 'OTP Verification' , 'activate_plugins', $menu_slug , 
			array( $this, 'mo_customer_validation_options'), plugin_dir_url(__FILE__) . 'includes/images/miniorange_icon.png' );
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Forms','administrator',$menu_slug		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'OTP Settings','administrator','otpsettings'
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Account','administrator','otpaccount'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'SMS/EMail Templates','administrator','config'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Messages','administrator','messages'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Send Custom Message','administrator','custom'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Licensing Plans','administrator','pricing'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Troubleshooting','administrator','help'			
			, array( $this, 'mo_customer_validation_options'));
	}

	function  mo_customer_validation_options()
	{
		include 'controllers/main-controller.php';
	}

	function mo_registration_plugin_settings_style()
	{
		wp_enqueue_style( 'mo_customer_validation_admin_settings_style'	 , MOV_CSS_URL);		
	}

	function mo_registration_plugin_settings_script()
	{
		wp_enqueue_script( 'mo_customer_validation_admin_settings_script', MOV_JS_URL , array('jquery'));
		wp_enqueue_script( 'mo_customer_validation_form_validation_script', VALIDATION_JS_URL , array('jquery'));
	}

	function mo_registration_plugin_frontend_scripts()
	{
		if(!get_option('mo_customer_validation_show_dropdown_on_form')) return;
		$selector = apply_filters( 'mo_phone_dropdown_selector', array() );
		if (MoUtility::isBlank($selector)) return;
		$selector = array_unique($selector); // get unique values 
		wp_enqueue_script('mo_customer_validation_inttelinput_script', MO_INTTELINPUT_JS , array('jquery'));
		wp_enqueue_style( 'mo_customer_validation_inttelinput_style', MO_INTTELINPUT_CSS);	
		wp_register_script('mo_customer_validation_dropdown_script', MO_DROPDOWN_JS , array('jquery'));
		wp_localize_script('mo_customer_validation_dropdown_script', 'modropdownvars', array( 'selector' =>  json_encode($selector)));
		wp_enqueue_script('mo_customer_validation_dropdown_script');
	}

	function mo_registration_deactivate()
	{
		wp_clear_scheduled_hook('hourlySync');
		delete_option('mo_customer_validation_transactionId');
		delete_option('mo_customer_validation_admin_password');
		delete_option('mo_customer_validation_registration_status');
		delete_option('mo_customer_validation_admin_phone');
		delete_option('mo_customer_validation_new_registration');
		delete_option('mo_customer_validation_admin_customer_key');
		delete_option('mo_customer_validation_admin_api_key');
		delete_option('mo_customer_validation_customer_token');
		delete_option('mo_customer_validation_verify_customer');
		delete_option('mo_customer_validation_message');
		delete_option('mo_customer_check_ln');
	}

	function mo_show_otp_message($content,$type) 
	{
		new MoDisplayMessages($content,$type);
	}

	function moScheduleTransactionSync()
	{
		if (! wp_next_scheduled('hourlySync') && MoUtility::micr()) wp_schedule_event(time(), 'daily', 'hourlySync');
	}

	function hourlySync()
	{
		$customerKey = get_option('mo_customer_validation_admin_customer_key');
		$apiKey = get_option('mo_customer_validation_admin_api_key');
		if(isset($customerKey) && isset($apiKey)) MoUtility::_handle_mo_check_ln(FALSE, $customerKey, $apiKey);
	}

	function otp_load_textdomain()
	{
		load_plugin_textdomain( 'wp-otp-verification', FALSE, dirname( plugin_basename(__FILE__) ) . '/lang/' );
	}

	function register_ppl_strings()
	{
		global $phoneLogic, $emailLogic;
		if(!MoUtility::_is_polylang_installed()) return;
		pll_register_string('OTP_SENT_PHONE',$phoneLogic->_get_otp_sent_message(),'miniorange-otp-verification');
		pll_register_string('OTP_SENT_EMAIL',$emailLogic->_get_otp_sent_message(),'miniorange-otp-verification');
		pll_register_string('ERROR_OTP_EMAIL',$emailLogic->_get_otp_sent_failed_message(),'miniorange-otp-verification');
		pll_register_string('ERROR_OTP_PHONE',$phoneLogic->_get_otp_sent_failed_message(),'miniorange-otp-verification');
		pll_register_string('ERROR_PHONE_FORMAT',$phoneLogic->_get_otp_invalid_format_message(),'miniorange-otp-verification');
		pll_register_string('CHOOSE_METHOD',MoMessages::showMessage('CHOOSE_METHOD'),'miniorange-otp-verification');
		pll_register_string('PLEASE_VALIDATE',MoMessages::showMessage('PLEASE_VALIDATE'),'miniorange-otp-verification');
		pll_register_string('ERROR_PHONE_BLOCKED',$phoneLogic->_get_is_blocked_message(),'miniorange-otp-verification');
		pll_register_string('ERROR_EMAIL_BLOCKED',$emailLogic->_get_is_blocked_message(),'miniorange-otp-verification');
		pll_register_string('INVALID_OTP',MoUtility::_get_invalid_otp_method(),'miniorange-otp-verification');
		pll_register_string('EMAIL_MISMATCH',MoMessages::showMessage('EMAIL_MISMATCH'),'miniorange-otp-verification');
		pll_register_string('PHONE_MISMATCH',MoMessages::showMessage('PHONE_MISMATCH'),'miniorange-otp-verification');
		pll_register_string('ENTER_PHONE',MoMessages::showMessage('ENTER_PHONE'),'miniorange-otp-verification');
		pll_register_string('ENTER_EMAIL',MoMessages::showMessage('ENTER_EMAIL'),'miniorange-otp-verification');	
		pll_register_string('ENTER_PHONE_CODE',MoMessages::showMessage('ENTER_PHONE_CODE'),'miniorange-otp-verification');	
		pll_register_string('ENTER_EMAIL_CODE',MoMessages::showMessage('ENTER_EMAIL_CODE'),'miniorange-otp-verification');	
		pll_register_string('ENTER_VERIFY_CODE',MoMessages::showMessage('ENTER_VERIFY_CODE'),'miniorange-otp-verification');	
		pll_register_string('PHONE_VALIDATION_MSG',MoMessages::showMessage('PHONE_VALIDATION_MSG'),'miniorange-otp-verification');	
		pll_register_string('MO_REG_ENTER_PHONE',MoMessages::showMessage('MO_REG_ENTER_PHONE'),'miniorange-otp-verification');	
		pll_register_string('UNKNOWN_ERROR',MoMessages::showMessage('UNKNOWN_ERROR'),'miniorange-otp-verification');		
		pll_register_string('PHONE_NOT_FOUND',MoMessages::showMessage('PHONE_NOT_FOUND'),'miniorange-otp-verification');	
		pll_register_string('REGISTER_PHONE_LOGIN',MoMessages::showMessage('REGISTER_PHONE_LOGIN'),'miniorange-otp-verification');	
		pll_register_string('DEFAULT_SMS_TEMPLATE',get_option('mo_customer_validation_custom_sms_msg') ? get_option('mo_customer_validation_custom_sms_msg'): MoMessages::showMessage('DEFAULT_SMS_TEMPLATE'),'miniorange-otp-verification');	
		pll_register_string('EMAIL_SUBJECT',get_option('mo_customer_validation_custom_email_subject') ? get_option('mo_customer_validation_custom_email_subject') : MoMessages::showMessage('EMAIL_SUBJECT'),'miniorange-otp-verification');	
		pll_register_string('DEFAULT_EMAIL_TEMPLATE', get_option('mo_customer_validation_custom_email_msg') ? get_option('mo_customer_validation_custom_email_msg') :MoMessages::showMessage('DEFAULT_EMAIL_TEMPLATE'),'miniorange-otp-verification');	
		pll_register_string('DEFAULT_BOX_HEADER','Validate OTP (One Time Passcode)','miniorange-otp-verification');
		pll_register_string('GO_BACK','&larr; Go Back','miniorange-otp-verification');
		pll_register_string('RESEND_OTP','Resend OTP','miniorange-otp-verification');
		pll_register_string('VALIDATE_OTP','Validate OTP','miniorange-otp-verification');
		pll_register_string('VERIFY_CODE','Verify Code','miniorange-otp-verification');
		pll_register_string('SEND_OTP','Send OTP','miniorange-otp-verification');		
		pll_register_string('VALIDATE_PHONE_NUMBER','Validate your Phone Number','miniorange-otp-verification');		
	}
}
new Miniorange_Customer_Validation;
?>