<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="reales_reg" class="app_enable" data-toggle="reales_options" name="mo_customer_validation_reales_enable" value="1"
			'.$reales_enabled.' /><strong>Reales WP Theme '. __( "Registration Form",'wp-otp-verification').'</strong>';

			get_plugin_form_link(MoConstants::REALES_THEME);

echo'		<div class="mo_registration_help_desc" '.$reales_hidden.' id="reales_options">
				<b>Choose between Phone or Email Verification</b>
				<p>
					<input type="radio" '.$disabled.' id="reales_phone" class="app_enable" name="mo_customer_validation_reales_enable_type" value="'.$reales_type_phone.'"
						'.($reales_enable_type == $reales_type_phone ? "checked" : "" ).'/>
						<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="reales_email" class="app_enable" name="mo_customer_validation_reales_enable_type" value="'.$reales_type_email.'"
						'.($reales_enable_type == $reales_type_email? "checked" : "" ).'/>
						<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
				</p>
			</div>
		</div>';

