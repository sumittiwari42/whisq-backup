<?php

	class RegistrationMagicForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::CRF_DEFAULT_REG;
		private $phoneFormID;
		private $otpType;
		private $emailKey;
		private $phoneKey;

		const TYPE_PHONE 		= 'mo_crf_phone_enable';
		const TYPE_EMAIL 		= 'mo_crf_email_enable';
		const TYPE_BOTH 		= 'mo_crf_both_enable';

		function handleForm()
		{
			$this->otpType = get_option('mo_customer_validation_crf_enable_type');
			$this->emailKey = get_option('mo_customer_validation_crf_email_key');
			$this->phoneKey = get_option('mo_customer_validation_crf_phone_key');
			$this->phoneFormID = 'input[name='.$this->getFieldID($this->phoneKey).']';

			if(array_key_exists('option',$_POST)) return;

			if(array_key_exists('rm_form_sub_id',$_REQUEST) && isset($_REQUEST['rm_form_sub_id']) 
				&& $_REQUEST['rm_form_sub_id']!="rm_login_form" )
				$this->_handle_crf_form_submit($_REQUEST);

			MoUtility::checkSession();
			if(array_key_exists($this->formSessionVar,$_SESSION) && $_SESSION[$this->formSessionVar]=='validated')
				$this->unsetOTPSessionVariables();
		}

		public static function isFormEnabled()
		{
			return get_option('mo_customer_validation_crf_default_enable') ? TRUE : FALSE;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function _handle_crf_form_submit($requestdata)
		{
			$email = $phone = '';
			if( $this->otpType == self::TYPE_EMAIL || $this->otpType == self::TYPE_BOTH)
				$email = $this->getCRFEmailFromRequest($requestdata);
			if($this->isPhoneVerificationEnabled())
				$phone = $this->getCRFPhoneFromRequest($requestdata);
			$this->miniorange_crf_user($email, isset($requestdata['user_name']) ? $requestdata['user_name'] : NULL ,$phone);
		}

		function getCRFEmailFromRequest($requestdata)
		{
			return $this->getFormPostSubmittedValue($this->getFieldID($this->emailKey),$requestdata);
		}

		function getCRFPhoneFromRequest($requestdata)
		{
			return $this->getFormPostSubmittedValue($this->getFieldID($this->phoneKey),$requestdata);
		}

		function getFormPostSubmittedValue($reg1,$requestdata)
		{
			if(isset($requestdata[$reg1])) return $requestdata[$reg1];
		}

		function getFieldID($key)
		{
			global $wpdb;
			$crf_fields =$wpdb->prefix."rm_fields";
			$row1 = $wpdb->get_row("SELECT * FROM $crf_fields where field_label ='".$key."'");
			return $row1->field_type.'_'.$row1->field_id;
		}

		function miniorange_crf_user($user_email,$user_name,$phone_number)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);
			$errors = new WP_Error();
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone_number,"phone");
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone_number,"both");
			else
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone_number,"email");
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$otpVerType = strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? "phone" 
							: (strcasecmp($this->otpType,self::TYPE_BOTH)==0 ? "both" : "email" );	
			$fromBoth = strcasecmp($otpVerType,"both")==0 ? TRUE : FALSE;
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'validated';	
		}

		public function unsetOTPSessionVariables()
		{
			unset($_SESSION[$this->txSessionId]);
			unset($_SESSION[$this->formSessionVar]);
		}

		public function is_ajax_form_in_play($isAjax)
		{
			MoUtility::checkSession();
			return isset($_SESSION[$this->formSessionVar]) ? FALSE : $isAjax;
		}

		public function getPhoneNumberSelector($selector)	
		{
			MoUtility::checkSession();
			if(self::isFormEnabled() && $this->isPhoneVerificationEnabled()) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_option('mo_customer_validation_crf_default_enable', 
				isset( $_POST['mo_customer_validation_crf_default_enable']) ? $_POST['mo_customer_validation_crf_default_enable'] : 0);
			update_option('mo_customer_validation_crf_enable_type',
				isset( $_POST['mo_customer_validation_crf_enable_type']) ? $_POST['mo_customer_validation_crf_enable_type'] : 0);
			update_option('mo_customer_validation_crf_phone_key',
				isset( $_POST['crf_phone_field_key']) ? $_POST['crf_phone_field_key'] : '');
			update_option('mo_customer_validation_crf_email_key',
				isset( $_POST['crf_email_field_key']) ? $_POST['crf_email_field_key'] : '');
		}
	}
	new RegistrationMagicForm;