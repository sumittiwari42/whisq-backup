<?php

echo' 	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="pie_default" class="app_enable" data-toggle="pie_default_options" name="mo_customer_validation_pie_default_enable" value="1"
										'.$pie_enabled.' /><strong>PIE '. __( "Registration Form",'wp-otp-verification').'</strong>';

									get_plugin_form_link(MoConstants::PIE_FORM_LINK);

echo'								<div class="mo_registration_help_desc" '.$pie_hidden.' id="pie_default_options">
									<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
									<p><input type="radio" '.$disabled.' id="pie_phone" data-form="pie_phone" class="form_options app_enable" name="mo_customer_validation_pie_enable_type" value="'.$pie_type_phone.'"
										'.( $pie_enable_type == $pie_type_phone ? "checked" : "").' />
										<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($pie_enable_type != $pie_type_phone ? "hidden" :"").' id="pie_phone_field" class="pie_form mo_registration_help_desc" >
											'. __( "Enter the label of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="pie_phone_field_key" name="pie_phone_field_key" type="text" value="'.$pie_field_key.'">
										</div>
									<p><input type="radio" '.$disabled.' id="pie_email" class="app_enable" name="mo_customer_validation_pie_enable_type" value="'.$pie_type_email.'"
										'.( $pie_enable_type == $pie_type_email ? "checked" : "").' />
										<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<p><input type="radio" '.$disabled.' id="pie_both" data-form="pie_both" class="form_options app_enable" name="mo_customer_validation_pie_enable_type" value="'.$pie_type_both.'"
										'.( $pie_enable_type == $pie_type_both ? "checked" : "").' />
											<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

											mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'										<div '.($pie_enable_type != $pie_type_both ? "hidden" :"").' class="pie_form mo_registration_help_desc" id="pie_both_field" >
											'. __( "Enter the label of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="pie_phone_field_key1" name="pie_phone_field_key" type="text" value="'.$pie_field_key.'">
										</div>

									</p>
								</div>
							</div>';