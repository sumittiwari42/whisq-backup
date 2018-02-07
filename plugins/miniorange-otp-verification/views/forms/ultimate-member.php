<?php

echo'		<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="um_default" data-toggle="um_default_options" class="app_enable" name="mo_customer_validation_um_default_enable" value="1"
					'.$um_enabled.' /><strong>Ultimate Member '. __( "Registration Form",'wp-otp-verification') . '</strong>';

							get_plugin_form_link(MoConstants::UM_ENABLED);

echo'		<div class="mo_registration_help_desc" '.$um_hidden.' id="um_default_options">
				<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
				<p>
					<input type="radio" '.$disabled.' id="um_phone" data-toggle="um_phone_instructions" class="app_enable" name="mo_customer_validation_um_enable_type" value="'.$um_type_phone.'"
					'.( $um_enabled_type == $um_type_phone ? "checked" : "").'/>
						<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>

					<div '.($um_enabled_type != $um_type_phone ? "hidden" : "").' id="um_phone_instructions" hidden class="mo_registration_help_desc">
						'. __( "Follow the following steps to enable Phone Verification",'wp-otp-verification').':
						<ol>
							<li><a href="'.$um_forms.'"  target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of forms",'wp-otp-verification').'</li>
							<li>'. __( "Click on the <b>Edit link</b> of your form.",'wp-otp-verification').'</li>
							<li>'. __( "Add a new <b>Mobile Number</b> Field from the list of predefined fields.",'wp-otp-verification').'</li>
							<li>'. __( "Click on <b>update</b> to save your form.",'wp-otp-verification').'</li>
						</ol>
					</div>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="um_email" class="app_enable" name="mo_customer_validation_um_enable_type" value="'.$um_type_email.'"
					'.( $um_enabled_type == $um_type_email ? "checked" : "").' />
						<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="um_both" data-toggle="um_both_instructions" class="app_enable" name="mo_customer_validation_um_enable_type" value="'.$um_type_both.'"
						'.( $um_enabled_type == $um_type_both ? "checked" : "").' />
						<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

						mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'				<div '.($um_enabled_type != $um_type_both ? "hidden" : "").' id="um_both_instructions" hidden class="mo_registration_help_desc">
						'. __( "Follow the following steps to enable Email and Phone Verification",'wp-otp-verification').':
						<ol>
							<li><a href="'.$um_forms.'">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of forms",'wp-otp-verification').'</li>
							<li>'. __( "Click on the <b>Edit link</b> of your form.",'wp-otp-verification').'</li>
							<li>'. __( "Add a new <b>Mobile Number</b> Field from the list of predefined fields.",'wp-otp-verification').'</li>
							<li>'. __( "Click on <b>update</b> to save your form.",'wp-otp-verification').'</li>
						</ol>
					</div>
				</p>
			</div>
		</div>';