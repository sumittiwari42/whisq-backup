<?php

echo'	<div class="mo_otp_form">
							<input type="checkbox" '.$disabled.' id="upme_default" class="app_enable" data-toggle="upme_default_options" name="mo_customer_validation_upme_default_enable" value="1"
								 '.$upme_enabled.' /><strong>UserProfile Made Easy '. __( "Registration Form",'wp-otp-verification').'</strong>';

									get_plugin_form_link(MoConstants::UPME_FORM_LINK);						 

echo '								<div class="mo_registration_help_desc" '.$upme_hidden.' id="upme_default_options">
									<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
									<p><input type="radio" '.$disabled.' data-toggle="upme_phone_instructions" id="upme_phone" class="form_options app_enable" name="mo_customer_validation_upme_enable_type" value="'.$upme_type_phone.'"
										'.( $upme_enable_type == $upme_type_phone ? "checked" : "").' />
											<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>';

echo'									</p>
										<div '.($upme_enable_type != $upme_type_phone ? "hidden" : "").' id="upme_phone_instructions" class="mo_registration_help_desc">
											'. __( "Follow the following steps to enable Phone Verification",'wp-otp-verification').':
											<ol>
												<li><a href="'.$upme_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of fields",'wp-otp-verification').'</li>
												<li>'. __( "Click on <b>Click here to add new field</b> button to add a new phone field.",'wp-otp-verification').' </li>
												<li>'. __( "Fill up the details of your new field and click on <b>Submit New Field</b>.",'wp-otp-verification').' </li>
												<li>'. __( "Keep the <b>Meta Key</b> handy as you will need it later on.",'wp-otp-verification').' </li>
												<li>'. __( "Enter the Meta Key of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="upme_phone_field_key" name="upme_phone_field_key" type="text" value="'.$upme_field_key.'"></li>
											</ol>
										</div>

									<p><input type="radio" '.$disabled.' id="upme_email" class="form_options app_enable" name="mo_customer_validation_upme_enable_type" value="'.$upme_type_email.'"
										'.( $upme_enable_type == $upme_type_email ? "checked" : "").' />
											<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<p><input type="radio" '.$disabled.' data-toggle="upme_both_instructions" id="upme_both" class="form_options app_enable" name="mo_customer_validation_upme_enable_type" value="'.$upme_type_both.'"
										'.( $upme_enable_type == $upme_type_both ? "checked" : "").' />
											<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

										mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'									<div '.($upme_enable_type != $upme_type_both ? "hidden" :"").' id="upme_both_instructions" class="mo_registration_help_desc">
											'. __( "Follow the following steps to enable both Email and Phone Verification",'wp-otp-verification').':
											<ol>
												<li><a href="'.$upme_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of fields",'wp-otp-verification').'</li>
												<li>'. __( "Click on <b>Click here to add new field</b> button to add a new phone field.",'wp-otp-verification').'</li>
												<li>'. __( "Fill up the details of your new field and click on <b>Submit New Field</b>.",'wp-otp-verification').'</li>
												<li>'. __( "Keep the <b>Meta Key</b> handy as you will need it later on.",'wp-otp-verification').'</li>
												<li>'. __( "Enter the Meta Key of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="upme_phone_field_key1" name="upme_phone_field_key" type="text" value="'.$upme_field_key.'"></li>
											</ol>
										</div>
									</p>
								</div>
							</div>';