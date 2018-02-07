<?php

	echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="wp_member_reg" class="app_enable" data-toggle="wp_member_reg_options" name="mo_customer_validation_wp_member_reg_enable" value="1"
	'.$wp_member_reg_enabled.' /><strong>WP Members '. __( "Registration Form",'wp-otp-verification') . '</strong>';

		get_plugin_form_link(MoConstants::WP_MEMBER_LINK);	

	echo'	<div class="mo_registration_help_desc" '.$wp_member_reg_hidden.' id="wp_member_reg_options">
				<p><input type="radio" '.$disabled.' id="wpmembers_reg_phone" class="app_enable" data-toggle="wpmembers_reg_phone_instructions" name="mo_customer_validation_wp_member_reg_enable_type" value="'.$wpm_type_phone.'"
					'.( $wpmember_enabled_type == $wpm_type_phone ? "checked" : "").' />
						<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
				</p>

				<div '.($wpmember_enabled_type != $wpm_type_phone ? "hidden" :"").' class="mo_registration_help_desc" id="wpmembers_reg_phone_instructions">			
					'. __( "Follow the following steps to enable Phone Verification for WP Member",'wp-otp-verification').':
					<ol>
						<li><a href="'.$wpm_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see your list of the fields.",'wp-otp-verification').'</li>
						<li>'. __( "Enable Day Phone field for your form and keep it required.",'wp-otp-verification').'</li>
						<li>'. __( "Create a new text field with meta key <i>validate_otp</i> where users can enter the validation code.",'wp-otp-verification').'</li>
						<li>'. __( "Click on the save button below to save your settings.",'wp-otp-verification').'</li>
					</ol>
				</div>

				<p><input type="radio" '.$disabled.' id="wpmembers_reg_email" class="app_enable" data-toggle="wpmembers_reg_email_instructions" name="mo_customer_validation_wp_member_reg_enable_type" value="'.$wpm_type_email.'"
					'.( $wpmember_enabled_type == $wpm_type_email ? "checked" : "").' />
					<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
				</p>

			<div '.($wpmember_enabled_type != $wpm_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="wpmembers_reg_email_instructions">			
					'. __( "Follow the following steps to enable Email Verification for WP Member",'wp-otp-verification').':
					<ol>
						<li><a href="'.$wpm_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '.__( "to see your list of fields.",'wp-otp-verification').'</li>
						<li>'. __( "Create a new text field with meta key <i>validate_otp</i> where users can enter the validation code.",'wp-otp-verification').'</li>
						<li>'. __( "Click on the save button below to save your settings.",'wp-otp-verification').'</li>
					</ol>
			</div>					
		</div>';
			