<?php

class MoMessages
{
	function __construct()
	{
		//created an array instead of messages instead of constant variables for Translation reasons.
		define("MO_MESSAGES", serialize( array(			
			//General Messages
			"OTP_SENT_PHONE" 		 => __( "A OTP (One Time Passcode) has been sent to ##phone## Please enter the OTP in the field below to verify your phone.", 'wp-otp-verification'), 
			"OTP_SENT_EMAIL" 		 => __( "A One Time Passcode has been sent to ##email## Please enter the OTP below to verify your Email Address. If you cannot see the email in your inbox, make sure to check your SPAM folder.", 'wp-otp-verification'),
			"ERROR_OTP_EMAIL" 		 => __( "There was an error in sending the OTP. Please enter a valid email id or contact site Admin.", 'wp-otp-verification'),
			"ERROR_OTP_PHONE" 		 => __( "There was an error in sending the OTP to the given Phone Number. Please Try Again or contact site Admin.", 'wp-otp-verification'),
			"ERROR_PHONE_FORMAT" 	 => __( "##phone## is not a valid phone number. Please enter a valid Phone Number. E.g:+1XXXXXXXXXX", 'wp-otp-verification'),
			"CHOOSE_METHOD" 		 => __( "Please select one of the methods below to verify your account. A One time passcode will be sent to the selected method.", 'wp-otp-verification'),
			"PLEASE_VALIDATE" 		 => __( "You need to verify yourself in order to submit this form", 'wp-otp-verification'),
			"ERROR_PHONE_BLOCKED"	 => __( "##phone## has been blocked by the user. Please Try a different number or Contact site Admin.",'wp-otp-verification'),
			"ERROR_EMAIL_BLOCKED"	 => __( "##email## has been blocked by the user. Please Try a different email or Contact site Admin.",'wp-otp-verification'),

			//ToolTip Messages
			"FORM_NOT_AVAIL_HEAD" 	 => __( "MY FORM IS NOT IN THE LIST", 'wp-otp-verification'),
			"FORM_NOT_AVAIL_BODY" 	 => __( "We are actively adding support for more forms. Please contact us using the support form on your right or email us at info@miniorange.com. While contacting us please include enough information about your registration form and how you intend to use this plugin. We will respond promptly.", 'wp-otp-verification'),
			"CHANGE_SENDER_ID_BODY"  => __( "SenderID/Number is gateway specific. You will need to use your own SMS gateway for this.", 'wp-otp-verification'),
			"CHANGE_SENDER_ID_HEAD"  => __( "CHANGE SENDER ID / NUMBER", 'wp-otp-verification'),
			"CHANGE_EMAIL_ID_BODY"   => __( "Sender Email is gateway specific. You will need to use your own Email gateway for this.",'wp-otp-verification'),
			"CHANGE_EMAIL_ID_HEAD"   => __( "CHANGE SENDER EMAIL ADDRESS", 'wp-otp-verification'),
			"INFO_HEADER" 			 => __( "WHAT DOES THIS MEAN?", 'wp-otp-verification'),
			"META_KEY_HEADER"		 => __( "WHAT IS A META KEY?", 'wp-otp-verification'),
			"META_KEY_BODY"		 	 => __( "WordPress stores addtional user data like phone number, age etc in the usermeta table in a key value pair. MetaKey is the key against which the additional value is stored in the usermeta table.", 'wp-otp-verification'),
			"ENABLE_BOTH_BODY"		 => __( "New users can validate their Email or Phone Number using either Email or Phone Verification.s They will be prompted during registration to choose one of the two verification methods.",'wp-otp-verification'),
			"COUNTRY_CODE_HEAD" 	 => __( "DON'T WANT USERS TO ENTER THEIR COUNTRY CODE?",'wp-otp-verification'),
			"COUNTRY_CODE_BODY" 	 => __( "Choose the default country code that will be appended to the phone number entered by the users. This will allow your users to enter their phone numbers in the phone field without a country code.",'wp-otp-verification'),

			//Support Query Messages			
			"SUPPORT_FORM_VALUES" 	 => __( "Please submit your query along with email.",'wp-otp-verification'),
			"SUPPORT_FORM_SENT" 	 => __( "Thanks for getting in touch! We shall get back to you shortly.",'wp-otp-verification'),
			"SUPPORT_FORM_ERROR" 	 => __( "Your query could not be submitted. Please try again.",'wp-otp-verification'),

			//Setting Messages
			"SETTINGS_SAVED" 		 => __( "Settings saved successfully. You can go to your registration form page to test the plugin.",'wp-otp-verification'),
			"REG_ERROR" 			 => __( "Please register an account before trying to enable OTP verification for any form.",'wp-otp-verification'),
			"MSG_TEMPLATE_SAVED" 	 => __( "Settings saved successfully.",'wp-otp-verification'),
			"SMS_TEMPLATE_SAVED" 	 => __( "Your SMS configurations are saved successfully.",'wp-otp-verification'),
			"EMAIL_TEMPLATE_SAVED" 	 => __( "Your email configurations are saved successfully.",'wp-otp-verification'),
			"CUSTOM_MSG_SENT" 		 => __( "Message sent successfully",'wp-otp-verification'),
			"CUSTOM_MSG_SENT_FAIL" 	 => __( "Error sending message. ERROR :" ,'wp-otp-verification') . '##error##',
			"EXTRA_SETTINGS_SAVED"   => __( "Settings saved successfully.",'wp-otp-verification'),

			//Ninja Form Messages
			"NINJA_FORM_FIELD_ERROR" => __( "Please fill in the form id and field id of your Ninja Form",'wp-otp-verification'),
			"NINJA_CHOOSE" 			 => __( "Please choose a Verification Method for Ninja Form.",'wp-otp-verification'),

			//Common AJAX Form Error Messages
			"EMAIL_MISMATCH" 		 => __( "The email OTP was sent to and the email in contact submission do not match.",'wp-otp-verification'),
			"PHONE_MISMATCH" 	 	 => __( "The phone number OTP was sent to and the phone number in contact submission do not match.",'wp-otp-verification'),
			"ENTER_PHONE" 			 => __( "You will have to provide a Phone Number before you can verify it.",'wp-otp-verification'),
			"ENTER_EMAIL" 			 => __( "You will have to provide an Email Address before you can verify it.",'wp-otp-verification'),

			//Contact Form 7 messages
			"CF7_PROVIDE_EMAIL_KEY"  => __( "Please Enter the name of the email address field you created in User Contact Form 7.",'wp-otp-verification'),
			"CF7_CHOOSE" 			 => __( "Please choose a Verification Method for Contact Form 7.",'wp-otp-verification'),

			//BuddyPress Form Messages
			"BP_PROVIDE_FIELD_KEY"   => __( "Please Enter the Name of the phone number field you created in BuddyPress.",'wp-otp-verification'),
			"BP_CHOOSE" 			 => __( "Please choose a Verification Method for BuddyPress Registration Form.",'wp-otp-verification'),

			//Ultimate Member Registration Messages
			"UM_CHOOSE" 			 => __( "Please choose a Verification Method for Ultimate Member Registration Form.",'wp-otp-verification'),

			//Event Registration Messages
			"EVENT_CHOOSE" 			 => __( "Please choose a Verification Method for Event Registration Form.",'wp-otp-verification'),

			//UserUltra Messages
			"UULTRA_PROVIDE_FIELD" 	 => __( "Please Enter the Field Key of the phone number field you created in Users Ultra Registration form.",'wp-otp-verification'),
			"UULTRA_CHOOSE" 		 => __( "Please choose a Verification Method for Users Ultra Registration Form.",'wp-otp-verification'),

			//CRF Messages
			"CRF_PROVIDE_PHONE_KEY"  => __( "Please Enter the label name of the phone number field you created in Custom User Registration form.",'wp-otp-verification'),
			"CRF_PROVIDE_EMAIL_KEY"  => __( "Please Enter the label name of the email number field you created in Custom User Registration form.",'wp-otp-verification'),
			"CRF_CHOOSE" 			 => __( "Please choose a Verification Method for Custom User Registration Form.", 'wp-otp-verification'),

			//Simplr Form Messages
			"SMPLR_PROVIDE_FIELD" 	 => __( "Please Enter the Field Key of the phone number field you created in Simplr User Registration form.",'wp-otp-verification'),
			"SIMPLR_CHOOSE" 		 => __( "Please choose a Verification Method for Simplr User Registration Form.",'wp-otp-verification'),

			//UserProfile Made Easy Messages
			"UPME_PROVIDE_PHONE_KEY" => __( "Please Enter the Field Key of the phone number field you created in User Profile Made Easy Registration form.",'wp-otp-verification'),
			"UPME_CHOOSE" 			 => __( "Please choose a Verification Method for User Profile Made Easy Registration Form.",'wp-otp-verification'),

			//Pie Registration Form Messages
			"PIE_PROVIDE_PHONE_KEY"  => __( "Please Enter the Meta Key of the phone field.",'wp-otp-verification'),
			"PIE_CHOOSE" 			 => __( "Please choose a Verification Method for Pie Registration Form.",'wp-otp-verification'),

			//WooCommerce Messages
			"ENTER_PHONE_CODE" 		 => __( "Please enter the verification code sent to your phone",'wp-otp-verification'),
			"ENTER_EMAIL_CODE"       => __( "Please enter the verification code sent to your email address",'wp-otp-verification'),
			"ENTER_VERIFY_CODE" 	 => __( "Please verify yourself before submitting the form. Refresh the page and try again",'wp-otp-verification'),
			"PHONE_VALIDATION_MSG" 	 => __( "Enter your mobile number below for verification :",'wp-otp-verification'),
			"WC_CHOOSE_METHOD" 		 => __( "Please choose a Verification Method for Woocommerce Default Registration Form.",'wp-otp-verification'),
			"WC_SOCIAL_CHOOSE" 		 => __( "Please choose a Verification Method for Woocommerce Checkout Registration Form.",'wp-otp-verification'),

			//Theme My Login Messages
			"TMLM_CHOOSE" 			 => __( "Please choose a Verification Method for Theme My Login Registration Form.",'wp-otp-verification'),

			//Default Registration Form
			"ENTER_PHONE_DEFAULT" 	 => __( "ERROR: Please enter a valid phone number.",'wp-otp-verification'),
			"WP_CHOOSE_METHOD" 		 => __( "Please choose a Verification Method for WordPress Default Registration Form.",'wp-otp-verification'),

			//UserPro Registration Form
			"USERPRO_CHOOSE" 		 => __( "Please choose a Verification Method for UserPro Registration Form.",'wp-otp-verification'),
			"USERPRO_VERIFY" 		 => __( "Please verify yourself before submitting the form.",'wp-otp-verification'),

			//Registration Messages
			"PASS_LENGTH" 			 => __( "Choose a password with minimum length 6.",'wp-otp-verification'),
			"PASS_MISMATCH" 		 => __( "Password and Confirm Password do not match.",'wp-otp-verification'),
			"OTP_SENT" 				 => __( "A passcode has been sent to ",'wp-otp-verification') . "{{method}}" .  __( " Please enter the otp below to verify your account.",'wp-otp-verification'),
			"ERR_OTP" 				 => __( "There was an error in sending OTP. Please click on Resend OTP link to resend the OTP.",'wp-otp-verification'),
			"REG_SUCCESS" 			 => __( "Your account has been retrieved successfully.",'wp-otp-verification'),
			"ACCOUNT_EXISTS" 		 => __( "You already have an account with miniOrange. Please enter a valid password.",'wp-otp-verification'),
			"REG_COMPLETE" 			 => __( "Registration complete!",'wp-otp-verification'),
			"INVALID_OTP" 			 => __( "Invalid one time passcode. Please enter a valid passcode.",'wp-otp-verification'),
			"RESET_PASS" 			 => __( "You password has been reset successfully and sent to your registered email. Please check your mailbox.",'wp-otp-verification'),
			"REQUIRED_FIELDS" 		 => __( "Please enter all the required fields",'wp-otp-verification'),
			"REQUIRED_OTP" 			 => __( "Please enter a value in OTP field.",'wp-otp-verification'),
			"INVALID_SMS_OTP" 		 => __( "There was an error in sending sms. Please Check your phone number.",'wp-otp-verification'),
			"NEED_UPGRADE_MSG" 		 => __( "You have not upgraded yet. Check licensing tab to upgrade to premium version.",'wp-otp-verification'),
			"VERIFIED_LK" 			 => __( "Your license is verified. You can now setup the plugin.",'wp-otp-verification'),
			"LK_IN_USE"				 => __( "License key you have entered has already been used. Please enter a key which has not been used before on any other instance or if you have exhausted all your keys then check licensing tab to buy more.",'wp-otp-verification'),
			"INVALID_LK" 			 => __( "You have entered an invalid license key. Please enter a valid license key.",'wp-otp-verification'),
			"REG_REQUIRED" 			 => __( "Please complete your registration to save configuration.",'wp-otp-verification'),

			//common messages
			"UNKNOWN_ERROR" 		 => __( "Error processing your request. Please try again.",'wp-otp-verification'),
			"MO_REG_ENTER_PHONE" 	 => __( "Phone with country code eg. +1xxxxxxxxxx",'wp-otp-verification'),

			//License Messages
			"UPGRADE_MSG" 			 => __( "Thank you. You have upgraded to ",'wp-otp-verification'). "{{plan}}.",
			"FREE_PLAN_MSG" 		 => __( "You are on our FREE plan. Check Licensing Tab to learn how to upgrade.",'wp-otp-verification'),
			"TRANS_LEFT_MSG" 		 => __( "You have ",'wp-otp-verification') . "<b><i>{{email}} Email Transactions</i></b>" . __( " and ",'wp-otp-verification') . "<b><i>{{phone}} Phone Transactions</i></b>" . __( " remaining.",'wp-otp-verification'), 
												//'<a href="{{syncurl}}" class="button button-primary">SYNC</a>';,
			"YOUR_GATEWAY_HEADER"    => __( "WHAT DO YOU MEAN BY YOUR GATEWAY? WHEN DO I OPT FOR THIS PLAN?",'wp-otp-verification'),
			"YOUR_GATEWAY_BODY"    	 => __( "Your Gateway means that you have your own SMS or Email Gateway for delivering OTP to the user's email or phone. The plugin will handle OTP generation and verification but your existing gateway would be used to deliver the message to the user. <br/><br/>Hence, the One Time Cost of the plugin. <b><i>NOTE:</i></b> You will still need to pay SMS and Email delivery charges to your gateway separately.",'wp-otp-verification'),
			"MO_GATEWAY_HEADER"    	 => __( "WHAT DO YOU MEAN BY miniOrange GATEWAY? WHEN DO I OPT FOR THIS PLAN?",'wp-otp-verification'),
			"MO_GATEWAY_BODY"    	 => __( "miniOrange Gateway means that you want the complete package of OTP generation, delivery ( to user's phone or email ) and verification. Opt for this plan when you don't have your own SMS or Email gateway for message delivery. <br/><br/> <b><i>NOTE:</i></b> SMS Delivery charges depend on the country you want to send the OTP to. Click on the Upgrade Now button below and select your country to see the full pricing.",'wp-otp-verification'),

			//Gravity Forms Messages
			"GRAVITY_CHOOSE" 		 => __( "Please choose a Verification Method for Gravity Form.",'wp-otp-verification'),

			//WP Login Form Messages
			"PHONE_NOT_FOUND" 		 => __( "Sorry, but you don't have a registered phone number.",'wp-otp-verification'),
			"REGISTER_PHONE_LOGIN" 	 => __( "A new security system has been enabled for you. Please register your phone to continue.",'wp-otp-verification'),

			//WP Member messages
			"WP_MEMBER_CHOOSE" 		 => __( "Please choose a Verification Method for WP Member Form.",'wp-otp-verification'),

			//Ultimate Membership Pro
			"UMPRO_VERIFY" 			 => __( "Please verify yourself before submitting the form.",'wp-otp-verification'),
			"UMPRO_CHOOSE" 			 => __( "Please choose a verification method for Ultimate Membership Pro form.",'wp-otp-verification'),

			//Classify Theme
			"CLASSIFY_THEME" 		 => __( "Please choose a Verification Method for Classify Theme.",'wp-otp-verification'),

			//Reales Theme
			"REALES_THEME" 			 => __( "Please choose a Verification Method for Reales WP Theme.",'wp-otp-verification'),

			//WP Default Login
			"WP_LOGIN_MISSING_KEY" 	 => __( "Please provide a meta key value for users phone numbers.",'wp-otp-verification'),
			"PHONE_EXISTS"			 => __( "Phone Number is already in use. Please use another number.",'wp-otp-verification'),

			//WP Comments
			"WPCOMMNENT_CHOOSE"		 => __( "Please choose a Verification Method for WordPress Comments Form",'wp-otp-verification'),			

			//FormCraft Error
			"FORMCRAFT_CHOOSE"	 	 => __( "Please choose a Verification Method for FormCraft Form",'wp-otp-verification'),	
			"FORMCRAFT_FIELD_ERROR"	 => __( "Please fill in the form id and field id of your FormCraft Form",'wp-otp-verification'),

			//wpeMember form
			"WPEMEMBER_CHOOSE" 		 => __( "Please choose a Verification Method for WpEmember Registration Form",'wp-otp-verification'),

			//for onprem plugin
			"DEFAULT_SMS_TEMPLATE"   => __( "Dear Customer, Your OTP is ##otp##. Use this Passcode to complete your transaction. Thank you.",'wp-otp-verification'), 
			"EMAIL_SUBJECT" 		 => __( "Your Requested One Time Passcode",'wp-otp-verification'),
			"DEFAULT_EMAIL_TEMPLATE" => __( "Dear Customer, \n\nYour One Time Passcode for completing your transaction is: ##otp##\nPlease use this Passcode to complete your transaction. Do not share this Passcode with anyone.\n\nThank You,\nminiOrange Team.",'wp-otp-verification'),
		)));
	}

	public static function showMessage($messageKeys , $data=array())
	{
		$displayMessage = "";
		$messageKeys = explode(" ",$messageKeys);
		$messages = unserialize(MO_MESSAGES);
		foreach ($messageKeys as $messageKey) 
		{
			if(MoUtility::isBlank($messageKey)) return $displayMessage;
			$formatMessage = $messages[$messageKey];
		    foreach($data as $key => $value)
		    {
		        $formatMessage = str_replace("{{" . $key . "}}", $value ,$formatMessage);
		    }
		    $displayMessage.=$formatMessage;
		}
	    return $displayMessage;
	}
}	
new MoMessages;

class MoDisplayMessages
{
	private $message;
	private $type;

	function __construct( $message,$type ) 
	{
        $this->_message = $message;
        $this->_type = $type;
        add_action( 'admin_notices', array( $this, 'render' ) );
    }

    function render() 
    {
    	switch ($this->_type) 
    	{
    		case 'CUSTOM_MESSAGE':
    			echo  __($this->_message,'wp-otp-verification');																				break;
    		case 'NOTICE':
    			echo '	<div style="margin-top:1%;" class="is-dismissible notice notice-warning"> <p>'.__($this->_message,'wp-otp-verification').'</p> </div>';		break;
    		case 'ERROR':
    			echo '	<div style="margin-top:1%;" class="notice notice-error is-dismissible"> <p>'.__($this->_message,'wp-otp-verification').'</p> </div>';		break;
    		case 'SUCCESS':
    			echo '	<div style="margin-top:1%;" class="notice notice-success is-dismissible"> <p>'.__($this->_message,'wp-otp-verification').'</p> </div>';		break;
    	}
    }
}