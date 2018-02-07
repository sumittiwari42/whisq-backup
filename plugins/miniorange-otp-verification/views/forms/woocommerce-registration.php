<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="wc_default" data-toggle="wc_default_options" class="app_enable" name="mo_customer_validation_wc_default_enable" value="1"
		'.$woocommerce_registration.' /><strong>Woocommerce '. __( "Registration Form",'wp-otp-verification').'</strong>';

			get_plugin_form_link(MoConstants::WC_FORM_LINK);

echo'		<div class="mo_registration_help_desc" '.$wc_hidden.' id="wc_default_options">
				<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
				<p>
					<input type="radio" '.$disabled.' id="wc_phone" class="app_enable" data-toggle="wc_phone_options" name="mo_customer_validation_wc_enable_type" value="'.$wc_reg_type_phone.'"
						'.($wc_enable_type == $wc_reg_type_phone ? "checked" : "" ).'/>
						<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
				</p>
				<div '.($wc_enable_type != $wc_reg_type_phone  ? "hidden" :"").' class="mo_registration_help_desc" 
						id="wc_phone_options" >
						<input type="checkbox" '.$disabled.' name="mo_customer_validation_wc_restrict_duplicates" value="1"
								'.$wc_restrict_duplicates.' /><strong>'. __( "Do not allow users to use the same phone number for multiple accounts.",'wp-otp-verification').'</strong>
				</div>
				<p>
					<input type="radio" '.$disabled.' id="wc_email" class="app_enable" name="mo_customer_validation_wc_enable_type" value="'.$wc_reg_type_email.'"
						'.($wc_enable_type == $wc_reg_type_email? "checked" : "" ).'/>
						<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="wc_both" class="app_enable" name="mo_customer_validation_wc_enable_type" value="'.$wc_reg_type_both.'"
						'.($wc_enable_type == $wc_reg_type_both? "checked" : "" ).'/>
						<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';
							mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));
echo '			</p>
				<b>'. __( "Select page to redirect to after registration",'wp-otp-verification').': </b>';
				if(get_option('mo_customer_validation_wc_redirect') && !MoUtility::isBlank(get_page_by_title(get_option("mo_customer_validation_wc_redirect"))))
					wp_dropdown_pages(array("selected" => get_page_by_title( get_option("mo_customer_validation_wc_redirect") )->ID));
				else
					wp_dropdown_pages();

echo'		</div>
		</div>';