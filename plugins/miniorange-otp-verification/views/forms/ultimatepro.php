<?php

echo'			<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="ultimatepro" class="app_enable" data-toggle="ultipro_options" name="mo_customer_validation_ultipro_enable" value="1"
										'.$ultipro_enabled.' /><strong>Ultimate Membership Pro '. __( "Registration Form",'wp-otp-verification') . '</strong>';

								get_plugin_form_link(MoConstants::UM_PRO_LINK);															 

echo'							<div class="mo_registration_help_desc" '.$ultipro_hidden.' id="ultipro_options">
									<p><input type="radio" '.$disabled.' id="ultipro_email" class="app_enable" data-toggle="ultipro_email_instructions" name="mo_customer_validation_ultipro_type" value="'.$umpro_type_email.'"
										'.( $ultipro_enabled_type == $umpro_type_email ? "checked" : "").' />
											<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>

										<div '.($ultipro_enabled_type != $umpro_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="ultipro_email_instructions" >
											'. __( "Follow the following steps to enable Email Verification for Ultimate membership Pro Form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of pages",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of the page which has your Ultimate membership Pro registration form",'wp-otp-verification').'</li>
												<li>'. __( "Add the following short code just below the given registration shortcode",'wp-otp-verification').': <code>[mo_email]</code> </li>
												<li><a href="'.$umpro_custom_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see the list of your custom fields.",'wp-otp-verification').'</li>
												<li>'. __( "Add a custom text field with slug \"validate\" and label \"Enter Validation Code\" in your registration page.Use this text field to enter the OTP received. Make sure it's a required field.",'wp-otp-verification').'</li>								
												<li>'. __( "Click on the Save Button below to save your settings.",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="ultipro_phone" class="app_enable" data-toggle="ultipro_phone_instructions" name="mo_customer_validation_ultipro_type" value="'.$umpro_type_phone.'"
										'.( $ultipro_enabled_type == $umpro_type_phone ? "checked" : "").' />
											<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>

										<div '.($ultipro_enabled_type != $umpro_type_phone ? "hidden" :"").' class="mo_registration_help_desc" id="ultipro_phone_instructions" >
											'. __( "Follow the following steps to enable Phone Verification for Ultimate membership Pro Form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of pages",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of the page which has your Ultimate membership Pro registration form",'wp-otp-verification').'.</li>
												<li>'. __( "Add the following short code just below the given registration shortcode",'wp-otp-verification').': <code>[mo_phone]</code> </li>
												<li><a href="'.$umpro_custom_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see the list of your custom fields.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the edit option for the phone field and change the field type to text. Click on save to save your settings.",'wp-otp-verification').'</li>
												<li>'. __( "Enable the phone field for your registration form and make sure it is a required field.",'wp-otp-verification').'</li>  
												<li>'. __( "Add a custom text field with slug \"validate\" and label \"Enter Validation Code\" in your registration page. Use this text field to enter the OTP received. Make sure it's a required field.",'wp-otp-verification').'</li>								
												<li>'. __( "Click on the Save Button below to save your settings.",'wp-otp-verification').'</li>
											</ol>
									</div>

								</div>
							</div>';