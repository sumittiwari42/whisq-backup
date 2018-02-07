<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="uultra_default" class="app_enable" data-toggle="uultra_default_options" name="mo_customer_validation_uultra_default_enable" value="1"
										'.$uultra_enabled.' /><strong>User Ultra '. __( "Registration Form",'wp-otp-verification').'</strong>';

										get_plugin_form_link(MoConstants::UULTRA_FORM_LINK);

echo'							<div class="mo_registration_help_desc" '.$uultra_hidden.' id="uultra_default_options">
									<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
									<p><input type="radio" '.$disabled.' data-toggle="uultra_phone_instructions" id="uultra_phone" class="form_options app_enable" name="mo_customer_validation_uultra_enable_type" value="'.$uultra_type_phone.'"
										'.( $uultra_enable_type == $uultra_type_phone ? "checked" : "").' />
											<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>';									

echo'									<div '.($uultra_enable_type  != $uultra_type_phone ? "hidden" : "").' id="uultra_phone_instructions" class="mo_registration_help_desc">
											'. __( "Follow the following steps to enable Phone Verification",'wp-otp-verification').':
											<ol>
												<li><a href="'.$uultra_form_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of fields",'wp-otp-verification').'</li>
												<li>'. __( "Click on <b>Click here to add new field</b> button to add a new phone field.",'wp-otp-verification').'</li>
												<li>'. __( "Fill up the details of your new field and click on <b>Submit New Field.</b>",'wp-otp-verification').'</li>
												<li>'. __( "Keep the <b>Meta Key</b> handy as you will need it later on.",'wp-otp-verification').'</li>
												<li>'. __( "Enter the Meta Key of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="uultra_phone_field_key" name="uultra_phone_field_key" type="text" value="'.$uultra_field_key.'"></li>
											</ol>
										</div>
									</p>
									<p><input type="radio" '.$disabled.' id="uultra_email" class="form_options app_enable" name="mo_customer_validation_uultra_enable_type" value="'.$uultra_type_email.'"
										 '.( $uultra_enable_type == $uultra_type_email ? "checked" : "" ).' />
										 <strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<p><input type="radio" '.$disabled.' data-toggle="uultra_both_instructions" id="uultra_both" class="form_options app_enable" name="mo_customer_validation_uultra_enable_type" value="'.$uultra_type_both.'"
										'.( $uultra_enable_type == $uultra_type_both ? "checked" : "" ).' />
											<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

										mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'									<div '.($uultra_enable_type  != $uultra_type_both ? "hidden" :"").' id="uultra_both_instructions" class="mo_registration_help_desc">
											'. __( "Follow the following steps to enable both Email and Phone Verification",'wp-otp-verification').':
											<ol>
												<li><a href="'.$uultra_form_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of fields",'wp-otp-verification').'</li>
												<li>'. __( "Click on <b>Click here to add new field</b> button to add a new phone field.",'wp-otp-verification').'</li>
												<li>'. __( "Fill up the details of your new field and click on <b>Submit New Field.</b>",'wp-otp-verification').'</li>
												<li>'. __( "Keep the <b>Meta Key</b> handy as you will need it later on.",'wp-otp-verification').'</li>
												<li>'. __( "Enter the Meta Key of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="uultra_phone_field_key1" name="uultra_phone_field_key" type="text" value="'.$uultra_field_key.'"></li>
											</ol>
										</div>
									</p>
								</div>
							</div>';