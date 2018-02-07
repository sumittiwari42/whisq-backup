<?php

echo' 		<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="event_default" class="app_enable" data-toggle="event_default_options" name="mo_customer_validation_event_default_enable" value="1"
					'.$event_enabled.'/><strong>Event '. __( "Registration Form",'wp-otp-verification').'</strong>';

						get_plugin_form_link(MoConstants::EVENT_FORM);

echo'			<div class="mo_registration_help_desc" '.$event_hidden.' id="event_default_options">
					<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
					<p><input type="radio" '.$disabled.' id="event_phone" class="app_enable" name="mo_customer_validation_event_enable_type" value="'.$event_type_phone.'"
							'.( $event_enabled_type == $event_type_phone ? "checked" : "").' />
								<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
							</p>
							<p>
								<input type="radio" '.$disabled.' id="event_email" class="app_enable" name="mo_customer_validation_event_enable_type" value="'.$event_type_email.'"
								'.( $event_enabled_type == $event_type_email ? "checked" : "").' />
								<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
							</p>
									<p>
										<input type="radio" '.$disabled.' id="event_both" class="app_enable" name="mo_customer_validation_event_enable_type" value="'.$event_type_both.'"
											'.( $event_enabled_type == $event_type_both ? "checked" : "").' />
											<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

											mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'								</p>
				</div>
			</div>';