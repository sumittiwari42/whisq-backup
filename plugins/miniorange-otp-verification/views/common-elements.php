<?php

	function is_customer_registered()
	{
		$registration_url = add_query_arg( array('page' => 'otpaccount'), $_SERVER['REQUEST_URI'] );
		if(MoUtility::micr())  return;
		echo '<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);
							padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
		 <a href="'.$registration_url.'">'.__( "Register or Login with miniOrange",'wp-otp-verification') .'</a> 
		 	'. __( "to enable OTP Verification",'wp-otp-verification').'</div>';
	}

	function get_plugin_form_link($formalink)
	{
		echo '<a class="dashicons dashicons-admin-page" href="'.$formalink.'" title="'.$formalink.'" ></a>';
	}

	function mo_draw_tooltip($header,$message)
	{
		echo '<span class="tooltip">
				<span class="dashicons dashicons-editor-help"></span>
				<span class="tooltiptext"><span class="header"><b><i>'. __( $header,'wp-otp-verification').'</i></b></span><br/><br/>
				<span class="body">'.__($message,'wp-otp-verification').'</span></span>
			  </span>';
	}

	function extra_post_data($data=null)
	{
		$mo_fields 		= array('option','mo_customer_validation_otp_token','miniorange_otp_token_submit',
								'miniorange-validate-otp-choice-form','submit','mo_customer_validation_otp_choice');
		$extrafields1 	= array('user_login','user_email','register_nonce','option','register_tml_nonce'); 
		$extrafields2 	= array('register_nonce','option','form_id','timestamp'); 

		if  (	isset($_SESSION[FormSessionVars::WC_DEFAULT_REG])
				|| 	isset($_SESSION[FormSessionVars::CRF_DEFAULT_REG])
				|| 	isset($_SESSION[FormSessionVars::UULTRA_REG])
				|| 	isset($_SESSION[FormSessionVars::UPME_REG])
				|| 	isset($_SESSION[FormSessionVars::PIE_REG])
				|| 	isset($_SESSION[FormSessionVars::PB_DEFAULT_REG])
				|| 	isset($_SESSION[FormSessionVars::NINJA_FORM])
				|| 	isset($_SESSION[FormSessionVars::USERPRO_FORM])
				||	isset($_SESSION[FormSessionVars::EVENT_REG])
				||  isset($_SESSION[FormSessionVars::BUDDYPRESS_REG])
				||  isset($_SESSION[FormSessionVars::WP_DEFAULT_LOGIN])
				||  isset($_SESSION[FormSessionVars::WP_LOGIN_REG_PHONE])
				||  isset($_SESSION[FormSessionVars::CLASSIFY_REGISTER])
				||  isset($_SESSION[FormSessionVars::EMEMBER])
			)
		{
			foreach ($_POST as $key => $value)
			{
				if(!in_array($key,$mo_fields))
					show_hidden_fields($key,$value);
				if($key=='g-recaptcha-response' && isset($_REQUEST['g-recaptcha-response']))
					 echo '<input type="hidden" name="g-recaptcha-response" value="'.$_POST['g-recaptcha-response'].'" />';
				if(isset($_POST['attendee']))
				{
					$i = 0;
				    while($i<count($_POST['attendee'])){
				    	echo ' <input type="hidden" name="attendee['.$i.'][first_name]" value="'.$_POST["attendee"][$i]["first_name"].'">';
				    	echo ' <input type="hidden" name="attendee['.$i.'][last_name]" value="'.$_POST["attendee"][$i]["last_name"].'">';
				    	$i++;
					}
				}
			}
		}
		elseif  (	(isset($_SESSION[FormSessionVars::WC_SOCIAL_LOGIN])
					|| isset($_SESSION[FormSessionVars::UM_DEFAULT_REG]))
					&& !MoUtility::isBlank($data)
				)
		{
			foreach ($data as $key => $value)
			{
				if(!in_array($key, $extrafields2))
					show_hidden_fields($key,$value);
			}
		}elseif (	(isset($_SESSION[FormSessionVars::TML_REG])
					|| 	isset($_SESSION[FormSessionVars::WP_DEFAULT_REG]))
					&& !MoUtility::isBlank($_POST)
				)
		{
			foreach ($_POST as $key => $value)
			{
				if(!in_array($key, $extrafields1))
					show_hidden_fields($key,$value);
			}
		}
	}

	function show_hidden_fields($key,$value)
	{
		if(is_array($value))
			foreach ($value as $t => $val)
				echo '<input type="hidden" name="'.$key.'[]" value="'.$val.'" />';
		else	
			echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
	}

	function miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,$message,$otp_type,$from_both)
	{
		if(!headers_sent()) header('Content-Type: text/html; charset=utf-8');
		$img = "<div style='display:table;text-align:center;'><img src='".MOV_LOADER_URL."'></div>";
		include 'default.php';
		die();
	}

	function miniorange_verification_user_choice($user_login, $user_email,$phone_number,$message,$otp_type)
	{
		include 'userchoice.php';
		die();
	}    

	function mo_external_phone_validation_form($goBackURL,$user_email,$message,$form,$usermeta)
	{
		$img = "<div style='display:table;text-align:center;'><img src='".MOV_LOADER_URL."'></div>";
		include 'externalphone.php';		
		die();
	}

	function get_otp_verification_form_dropdown()
	{
		$enabled = 'style="color:green;font-style:italic;font-weight:bold"';
		echo '<div class="modropdown">
				<span class="dashicons dashicons-search"></span>
				<input type="text" class="dropbtn" placeholder="'.__( 'Select your Form' ,'wp-otp-verification').'"></input>
				<div class="modropdown-content">';
			foreach (FormList::getFormList() as $key => $value)
			{
				echo '<div class="search_box"><a class="mo_search" href="#'.strtolower($key).'" ';
				echo FormList::isFormEnabled($value) ? $enabled : '';
				echo ' data-value="'.$value.'">'.$value.'</a></div>';
			}
		echo	'</div>
			</div>';
	}

	function get_country_code_dropdown()
	{
		echo '<select name="default_country_code" id="mo_country_code">';
		echo '<option value="" disabled selected="selected">
				--------- '.__( 'Select your Country' ,'wp-otp-verification').' -------
			  </option>';
		foreach (CountryList::getCountryCodeList() as $key => $value)
		{
			echo '<option data-countrycode="'.$value.'" value="'.$value.'"';
			echo CountryList::isCountrySelected($value) ? 'selected' : '';
			echo '>'.str_replace("_"," ",$key).'</option>';
		}
		echo '</select>';
	}

	function show_form_details($folder,$controller,$disabled,$page_list)
	{
		foreach (scandir(dirname(__FILE__).'/'.$folder) as $filename)
		{
			if($filename=="" || $filename=="." 
				|| $filename==".." || $filename =="wp-login.php") continue;
			$path = dirname(__FILE__) . '/'. $folder . '/' . $filename;
			if (is_file($path)) {
				echo'<tr> <td>';
					include $controller . $folder .'/'. $filename;							
				echo'</td></tr>';
			}elseif(is_dir($path)){
				show_form_details($folder.'/'.$filename,$controller,$disabled,$page_list);
			}
		}
	}

	function get_wc_payment_dropdown($disabled,$checkout_payment_plans)
	{
		if( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			echo __( '[ Please activate the WooCommerce Plugin ]' ,'wp-otp-verification'); return;
		}
		$paymentPlans = WC()->payment_gateways->get_available_payment_gateways();
		echo '<select multiple size="5" name="wc_payment[]" id="wc_payment">';
		echo 	'<option value="" disabled>'.__( 'Select your Payment Methods' ,'wp-otp-verification').'</option>';
		foreach ($paymentPlans as $paymentPlan) {
			echo '<option ';
			if(array_key_exists($paymentPlan->id, $checkout_payment_plans)) echo 'selected';
			echo ' value="'.esc_attr( $paymentPlan->id ).'">'.$paymentPlan->title.'</option>';
		}
		echo '</select>';
	}