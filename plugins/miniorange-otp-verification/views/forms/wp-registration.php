<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="wp_default" class="app_enable" data-toggle="wp_default_options" name="mo_customer_validation_wp_default_enable" value="1"
			'.$default_registration.' /><strong>WordPress '. __( "Default Registration Form",'wp-otp-verification').'</strong>';

echo'		<div class="mo_registration_help_desc" '.$wp_default_hidden.' id="wp_default_options">
				<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
				<p>
					<input type="radio" '.$disabled.' id="wp_default_phone" class="app_enable" data-toggle="wp_default_phone_options" name="mo_customer_validation_wp_default_enable_type" value="'.$wpreg_phone_type.'"
						'.($wp_default_type == $wpreg_phone_type  ? "checked" : "" ).'/>
						<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
				</p>
				<div '.($wp_default_type != $wpreg_phone_type  ? "hidden" :"").' class="mo_registration_help_desc" 
						id="wp_default_phone_options" >
						<input type="checkbox" '.$disabled.' name="mo_customer_validation_wp_reg_restrict_duplicates" value="1"
								'.$wp_handle_reg_duplicates.' /><strong>'. __( "Do not allow users to use the same phone number for multiple accounts.",'wp-otp-verification').'</strong>
				</div>
				<p>
					<input type="radio" '.$disabled.' id="wp_default_email" class="app_enable" name="mo_customer_validation_wp_default_enable_type" value="'.$wpreg_email_type.'"
						'.($wp_default_type == $wpreg_email_type? "checked" : "" ).'/>
						<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="wp_default_both" class="app_enable" name="mo_customer_validation_wp_default_enable_type" 
						value="'.$wpreg_both_type.'" data-toggle="wp_default_both_options"
						'.($wp_default_type == $wpreg_both_type? "checked" : "" ).'/>
						<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';
							mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));
echo '			</p>
				<div '.($wp_default_type != $wpreg_both_type ? "hidden" :"").' class="mo_registration_help_desc" 
						id="wp_default_both_options" >
						<input type="checkbox" '.$disabled.' name="mo_customer_validation_wp_reg_restrict_duplicates" value="1"
								'.$wp_handle_reg_duplicates.' /><strong>'. __( "Do not allow users to use the same phone number for multiple accounts.",'wp-otp-verification').'</strong>
				</div>
			</div>
		</div>';