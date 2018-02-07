<?php

echo' 	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="emember_reg" class="app_enable" data-toggle="emember_default_options" name="mo_customer_validation_emember_default_enable" value="1"
										'.$emember_enabled.' /><strong>WP eMember '. __( "Registration Form",'wp-otp-verification').'</strong>';

									get_plugin_form_link(MoConstants::EMEMBER_FORM_LINK);

echo'								<div class="mo_registration_help_desc" '.$emember_hidden.' id="emember_default_options">
									<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
									<p><input type="radio" '.$disabled.' id="emember_phone" class="app_enable" name="mo_customer_validation_emember_enable_type" 
											value="'.$emember_type_phone.'" data-toggle="emember_phone_instructions"
										'.( $emember_enable_type == $emember_type_phone ? "checked" : "").' />
										<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($emember_enable_type != $emember_type_phone ? "hidden" :"").' class="mo_registration_help_desc" 
											id="emember_phone_instructions" >
											'. __( "Follow the following steps to enable Phone Verification for",'wp-otp-verification').'
											eMember Form: 
											<ol>
												<li><a href="'.$form_settings_link.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see your form settings.",'wp-otp-verification').'</li>
												<li>'. __( "Go to the <b>Registration Form Fields</b> section.",'wp-otp-verification').'</li>
												<li>'. __( "Check the \"Show phone field on registration page\" option to show Phone field on your form.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="emember_email" class="app_enable" name="mo_customer_validation_emember_enable_type" value="'.$emember_type_email.'"
										'.( $emember_enable_type == $emember_type_email ? "checked" : "").' />
										<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<p><input type="radio" '.$disabled.' id="emember_both" class="app_enable" name="mo_customer_validation_emember_enable_type" 
										value="'.$emember_type_both.'" data-toggle="emember_both_instructions"
										'.( $emember_enable_type == $emember_type_both ? "checked" : "").' />
											<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

											mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'										
									</p>
									<div '.($emember_enable_type != $emember_type_both ? "hidden" :"").' class="mo_registration_help_desc" 
											id="emember_both_instructions" >
											'. __( "Follow the following steps to enable Phone Verification for",'wp-otp-verification').'
											eMember Form: 
											<ol>
												<li><a href="'.$form_settings_link.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see your form settings.",'wp-otp-verification').'</li>
												<li>'. __( "Go to the <b>Registration Form Fields</b> section.",'wp-otp-verification').'</li>
												<li>'. __( "Check the \"Show phone field on registration page\" option to show Phone field on your form.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
								</div>
							</div>';