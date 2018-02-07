<?php 

class PhoneLogic extends LogicInterface
{

	public function _handle_logic($user_login,$user_email,$phone_number,$otp_type,$from_both)
	{
		$match = MoUtility::validatePhoneNumber($phone_number);
		switch ($match) 
		{
			case 0:
				$this->_handle_not_matched($phone_number,$otp_type,$from_both);						break;
			case 1:
				$this->_handle_matched($user_login,$user_email,$phone_number,$otp_type,$from_both);	break;
		}
	}

	public function _handle_matched($user_login,$user_email,$phone_number,$otp_type,$from_both)
	{
		$message = str_replace("##phone##",$phone_number,$this->_get_is_blocked_message());
		if($this->_is_blocked($user_email,$phone_number)) 
			if($this->_is_ajax_form())
				wp_send_json(MoUtility::_create_json_response($message,MoConstants::ERROR_JSON_TYPE));
			else
				miniorange_site_otp_validation_form(null,null,null,$message,$otp_type,$from_both);
		else
			$this->_start_otp_verification($user_login,$user_email,$phone_number,$otp_type,$from_both);
	}

	public function _start_otp_verification($user_login,$user_email,$phone_number,$otp_type,$from_both)
	{
		$content = json_decode(MocURLOTP::mo_send_otp_token('SMS','',$phone_number), true);
		switch ($content['status']) 
		{
			case 'SUCCESS':
				$this->_handle_otp_sent($user_login,$user_email,$phone_number,$otp_type,$from_both,$content); 		break;
			default:
				$this->_handle_otp_sent_failed($user_login,$user_email,$phone_number,$otp_type,$from_both,$content);break;
		}
	}

	public function _handle_not_matched($phone_number,$otp_type,$from_both)
	{
		MoUtility::checkSession();
		$message = str_replace("##phone##",$phone_number,$this->_get_otp_invalid_format_message());
		if($this->_is_ajax_form())
			wp_send_json(MoUtility::_create_json_response($message,MoConstants::ERROR_JSON_TYPE));
		else
			miniorange_site_otp_validation_form(null,null,null,$message,$otp_type,$from_both);
	}

	public function _handle_otp_sent_failed($user_login,$user_email,$phone_number,$otp_type,$from_both,$content)
	{
		MoUtility::checkSession();
		$message = str_replace("##phone##",$phone_number,$this->_get_otp_sent_failed_message());

		if($this->_is_ajax_form())
			wp_send_json(MoUtility::_create_json_response($message,MoConstants::ERROR_JSON_TYPE));
		else
			miniorange_site_otp_validation_form(null,null,null,$message,$otp_type,$from_both);
	}

	public function _handle_otp_sent($user_login,$user_email,$phone_number,$otp_type,$from_both,$content)
	{
		MoUtility::checkSession();
		$_SESSION[FormSessionVars::TX_SESSION_ID] = $content['txId'];

		if(MoUtility::micr() && !MoUtility::mclv())
			update_option('mo_customer_phone_transactions_remaining',get_option('mo_customer_phone_transactions_remaining')-1);

		$message = str_replace("##phone##",$phone_number,$this->_get_otp_sent_message());

		if($this->_is_ajax_form())
			wp_send_json(MoUtility::_create_json_response($message,MoConstants::SUCCESS_JSON_TYPE));
		else
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,$message,$otp_type,$from_both);
	}

	public function _get_otp_sent_message()
	{
		$message = get_option("mo_otp_success_phone_message") ? _x(get_option('mo_otp_success_phone_message'),null,'wp-otp-verification') 
														: _x(MoMessages::showMessage('OTP_SENT_PHONE'),null,'wp-otp-verification');
		return MoUtility::_is_polylang_installed() ? pll__($message) : $message;
	}

	public function _get_otp_sent_failed_message()
	{
		$message = get_option("mo_otp_error_phone_message") ? _x(get_option('mo_otp_error_phone_message'),null,'wp-otp-verification') 
														: _x(MoMessages::showMessage('ERROR_OTP_PHONE'),null,'wp-otp-verification');
		return MoUtility::_is_polylang_installed() ? pll__($message) : $message;
	}

	public function _get_otp_invalid_format_message()
	{
		$message = get_option("mo_otp_invalid_phone_message") ? _x(get_option('mo_otp_invalid_phone_message'),null,'wp-otp-verification') 
														: _x(MoMessages::showMessage('ERROR_PHONE_FORMAT'),null,'wp-otp-verification');
		return MoUtility::_is_polylang_installed() ? pll__($message) : $message;
	}

	public function _is_blocked($user_email,$phone_number)
	{
		$blocked_phone_numbers = explode(";",get_option('mo_customer_validation_blocked_phone_numbers'));
		$blocked_phone_numbers = apply_filters("mo_blocked_phones",$blocked_phone_numbers);	
		return in_array($phone_number,$blocked_phone_numbers);
	}

	public function _get_is_blocked_message()
	{
		$message = get_option("mo_otp_blocked_phone_message") ? _x(get_option('mo_otp_blocked_phone_message'),null,'wp-otp-verification') 
														: _x(MoMessages::showMessage('ERROR_PHONE_BLOCKED'),null,'wp-otp-verification');
		return MoUtility::_is_polylang_installed() ? pll__($message) : $message;
	}
}