<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="userpro_registration" class="app_enable" data-toggle="userpro_registration_options" name="mo_customer_validation_userpro_registration_enable" value="1"
										'.$userpro_enabled.' /><strong>UserPro '. __( "Registration Form",'wp-otp-verification') . '</strong>';

									get_plugin_form_link(MoConstants::USERPRO_FORM_LINK);								 

echo'							<div class="mo_registration_help_desc" '.$userpro_hidden.' id="userpro_registration_options">
									<p><input type="checkbox" '.$disabled.' class="form_options" '.$automatic_verification.' id="mo_customer_validation_userpro_verify" name="mo_customer_validation_userpro_verify" value="1"/> &nbsp;<strong>'. __("Verify users after registration",'wp-otp-verification').'</strong><br/></p>
									<p><input type="radio" '.$disabled.' id="userpro_registration_email" class="app_enable" data-toggle="userpro_registration_email_instructions" name="mo_customer_validation_userpro_registration_type" value="'.$userpro_type_email.'"
										'.( $userpro_enabled_type == $userpro_type_email ? "checked" : "").' />
											<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($userpro_enabled_type != $userpro_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="userpro_registration_email_instructions" >
											'. __( "Follow the following steps to enable Email Verification for UserPro Form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of pages",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of the page which has your UserPro form",'wp-otp-verification').'.</li>
												<li>'. __( "Add the following short code just below your",'wp-otp-verification').__( "UserPro Form shortcode on the profile and registration pages",'wp-otp-verification').': <code>[mo_verify_email_userpro]</code> </li>
												<li>
													'. __( "Add a New Custom Field to your Form. Give the following parameters to the new field",'wp-otp-verification').': 
													<ol>
														<li>'. __( "Give the <i>Field Title</i> as ",'wp-otp-verification').'<code>Verify Email</code></li>
														<li>'. __( "Give the <i>Field Type</i> as ",'wp-otp-verification').'<code>Text Input</code></li>
														<li>'. __( "Give the <i>Unique Field Key</i> as ",'wp-otp-verification').'<code>'.MoConstants::USERPRO_VER_FIELD_META.'</code></li>
														<li>'. __( "Make the Field as a required field.",'wp-otp-verification').'</li>
													</ol>
												</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="userpro_registration_phone" class="app_enable" data-toggle="userpro_registration_phone_instructions" name="mo_customer_validation_userpro_registration_type" value="'.$userpro_type_phone.'"
										'.( $userpro_enabled_type == $userpro_type_phone ? "checked" : "").' />
											<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($userpro_enabled_type != $userpro_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="userpro_registration_phone_instructions" >
											'. __( "Follow the following steps to enable Phone Verification for UserPro Form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of pages",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of the page which has your UserPro form.",'wp-otp-verification').'</li>
												<li>'. __( "Add the following short code just below your UserPro Form shortcode on the profile and registration pages",'wp-otp-verification').': <code>[mo_verify_phone_userpro]</code> </li>
												<li><a href="'.$userpro_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see your list of UserPro fields.",'wp-otp-verification').'</li>
												<li>'. __( "Add a Phone Number Field to your Form from the available fields list",'wp-otp-verification').'.</li>
												<li>'. __( "Add Ajax Call Check for your Phone Number field",'wp-otp-verification').': <code>mo_phone_validation</code></li>
												<li>
													'. __( "Add a New Custom Field to your Form. Give the following parameters to the new field",'wp-otp-verification').': 
													<ol>
														<li>'. __( "Give the <i>Field Title</i> as ",'wp-otp-verification').'<code>Verify Phone</code></li>
														<li>'. __( "Give the <i>Field Type</i> as ",'wp-otp-verification').'<code>Text Input</code></li>
														<li>'. __( "Give the <i>Unique Field Key</i> as ",'wp-otp-verification').'<code>'.MoConstants::USERPRO_VER_FIELD_META.'</code></li>
														<li>'. __( "Make the Field as a required field.",'wp-otp-verification').'</li>
													</ol>
												</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
								</div>
							</div>';