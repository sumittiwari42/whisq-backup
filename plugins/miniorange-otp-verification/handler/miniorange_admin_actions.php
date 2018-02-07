<?php 

class MoOTPAdminActionHandler
{
	function __construct()
	{
		add_action( 'admin_init',  array( $this, '_handle_admin_actions' ) );
		add_filter( 'dashboard_glance_items', array( $this,'otp_transactions_glance_counter'), 10, 1 );  
	}

	function _handle_admin_actions()
	{
		if(!MoUtility::micr() || !current_user_can( 'manage_options' )) return;
		$this->showRemainingTransactions();
		if(!isset($_POST['option'])) return;
		switch($_POST['option'])
		{
			case "mo_customer_validation_settings":
				$this->_save_settings($_POST);																	 break;
			case "mo_customer_validation_messages":
				$this->_handle_custom_messages_form_submit($_POST);												 break;
			case "mo_validation_contact_us_query_option":
				$this->_mo_validation_support_query($_POST['query_email'],$_POST['query'],$_POST['query_phone']);break;	
			case "mo_customer_validation_custom_notif":
				$this->_mo_validation_send_notif_msg($_POST);													 break;
			case "mo_otp_extra_settings":
				$this->_save_extra_settings($_POST); 															 break;
			case "mo_customer_validation_sms_configuration":
				$this->_mo_configure_sms_template($_POST);														 break;	
			case "mo_customer_validation_email_configuration":
				$this->_mo_configure_email_template($_POST);													 break;
		}
	}

	function showRemainingTransactions()
	{
		if(!array_key_exists('page',$_GET)) return;
		if(!MoUtility::micr()) return;
		if(!get_option('mo_customer_validation_show_remaining_trans')) return;
		$email = get_option('mo_customer_email_transactions_remaining');
		$phone = get_option('mo_customer_phone_transactions_remaining');
		$profile_url = add_query_arg( array('option' => 'check_mo_ln' ), $_SERVER['REQUEST_URI'] );
		do_action('mo_registration_show_message', MoMessages::showMessage('TRANS_LEFT_MSG',
					array('email'=>$email,'phone'=>$phone,'syncurl'=>$profile_url)),'NOTICE');
	}

	function _handle_custom_messages_form_submit($post)
	{
		update_option('mo_otp_success_email_message',isset( $post['otp_success_email']) ? $post['otp_success_email']  : 0);
		update_option('mo_otp_success_phone_message',isset( $post['otp_success_phone']) ? $post['otp_success_phone']  : 0);
		update_option('mo_otp_error_phone_message'	,isset( $post['otp_error_phone'])   ? $post['otp_error_phone']    : 0);
		update_option('mo_otp_error_email_message'	,isset( $post['otp_error_email'])   ? $post['otp_error_email']    : 0);
		update_option('mo_otp_invalid_phone_message',isset( $post['otp_invalid_phone']) ? $post['otp_invalid_phone']  : 0);
		update_option('mo_otp_invalid_message'		,isset( $post['invalid_otp']) 	    ? $post['invalid_otp']        : 0);

		do_action('mo_registration_show_message', MoMessages::showMessage('MSG_TEMPLATE_SAVED'),'SUCCESS');
	}

	function _save_settings($posted)
	{
		if(!$posted['error_message'])
			do_action('mo_registration_show_message', MoMessages::showMessage('SETTINGS_SAVED',array('logoutURL'=>wp_logout_url())),'SUCCESS');
		else
			do_action('mo_registration_show_message', MoMessages::showMessage($posted['error_message']),'ERROR');
	}

	function _save_extra_settings($posted)
	{
		update_option('mo_customer_validation_default_country_code',
				isset($posted['default_country_code']) ? $posted['default_country_code'] : '');
		update_option('mo_customer_validation_blocked_domains',
				isset($posted['mo_otp_blocked_email_domains']) ? $posted['mo_otp_blocked_email_domains'] : '');
		update_option('mo_customer_validation_blocked_phone_numbers',
				isset($posted['mo_otp_blocked_phone_numbers']) ? $posted['mo_otp_blocked_phone_numbers'] : '');
		update_option('mo_customer_validation_show_remaining_trans',
				isset($posted['mo_show_remaining_trans']) ? $posted['mo_show_remaining_trans'] : '');
		update_option('mo_customer_validation_show_dropdown_on_form', 
				isset($posted['show_dropdown_on_form']) ? $posted['show_dropdown_on_form'] : '');
		update_option('mo_customer_validation_otp_length', isset($posted['mo_otp_length']) ? $posted['mo_otp_length'] : '');
		update_option('mo_customer_validation_otp_validity', isset($posted['mo_otp_validity']) ? $posted['mo_otp_validity'] : '');
		do_action('mo_registration_show_message', MoMessages::showMessage('EXTRA_SETTINGS_SAVED'),'SUCCESS');
	}

	function _mo_validation_send_notif_msg($post)
	{
		$phone_numbers = explode(";",$post['mo_phone_numbers']);
		$message = $post['mo_customer_validation_custom_sms_msg'];
		$content = null;
		foreach ($phone_numbers as $phone) {
			$phone = MoUtility::processPhoneNumber($phone);
			$content = json_decode(MocURLOTP::send_notif($phone,$message));
		}
		if(is_null($content)) return;
		switch ($content->status) 
		{
			case 'SUCCESS':
				do_action('mo_registration_show_message', MoMessages::showMessage('CUSTOM_MSG_SENT'),'SUCCESS'); 						break;
			case 'ERROR':
				do_action('mo_registration_show_message', MoMessages::showMessage('CUSTOM_MSG_SENT_FAIL',$content->message),'ERROR'); 	break;
		}
	}

	function _mo_validation_support_query($email,$query,$phone)
	{
		if( empty($email) || empty($query) )
		{
			do_action('mo_registration_show_message', MoMessages::showMessage('SUPPORT_FORM_VALUES'),'ERROR');
			return;
		}

		$query 	  = sanitize_text_field( $query );
		$email 	  = sanitize_text_field( $email );
		$phone 	  = sanitize_text_field( $phone );
		$submited = MocURLOTP::submit_contact_us( $email, $phone, $query );

		if(json_last_error() == JSON_ERROR_NONE && $submited) 
		{
			do_action('mo_registration_show_message',MoMessages::showMessage('SUPPORT_FORM_SENT'),'SUCCESS');
			return;
		}

		do_action('mo_registration_show_message',MoMessages::showMessage('SUPPORT_FORM_ERROR'),'ERROR');
	}

	public function otp_transactions_glance_counter() 
	{
		if(!MoUtility::micr() || MoUtility::mclv()) return;
		$email = get_option('mo_customer_email_transactions_remaining');
		$phone = get_option('mo_customer_phone_transactions_remaining');
		echo "<li class='mo-trans-count'><a href='" . admin_url() . "admin.php?page=mosettings'>" 
				. MoMessages::showMessage('TRANS_LEFT_MSG',array('email'=>$email,'phone'=>$phone)). "</a></li>";
	}	
}
new MoOTPAdminActionHandler;