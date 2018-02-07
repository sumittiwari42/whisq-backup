<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="tml_default" class="app_enable" data-toggle="tml_options" name="mo_customer_validation_tml_enable" value="1"
			'.$tml_enabled.' /><strong>Theme My Login '.__( "Form", 'wp-otp-verification').'</strong>';

			get_plugin_form_link(MoConstants::TML_FORM_LINK);

echo'		<div class="mo_registration_help_desc" '.$tml_hidden.' id="tml_options">
				<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
				<p>
					<input type="radio" '.$disabled.' id="tml_phone" class="app_enable" name="mo_customer_validation_tml_enable_type" value="'.$tml_type_phone.'"
						'.($tml_enable_type == $tml_type_phone ? "checked" : "" ).'/>
							<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="tml_email" class="app_enable" name="mo_customer_validation_tml_enable_type" value="'.$tml_type_email.'"
						'.($tml_enable_type == $tml_type_email? "checked" : "" ).'/>
							<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
				</p>
				<p>
					<input type="radio" '.$disabled.' id="tml_both" class="app_enable" name="mo_customer_validation_tml_enable_type" value="'.$tml_type_both.'"
						'.($tml_enable_type == $tml_type_both? "checked" : "" ).'/>
							<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';
							mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));
echo '			</p>
			</div>
		</div>';