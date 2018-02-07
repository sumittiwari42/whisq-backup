<?php

echo'		<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="cf7_contact" class="app_enable" data-toggle="cf7_contact_options" name="mo_customer_validation_cf7_contact_enable" value="1"
										'.$cf7_enabled.' /><strong>Contact Form 7 - '. __( "Contact Form",'wp-otp-verification') . '</strong>';

									get_plugin_form_link(MoConstants::CF7_FORM_LINK);								 

echo'							<div class="mo_registration_help_desc" '.$cf7_hidden.' id="cf7_contact_options">
									<p><input type="radio" '.$disabled.' id="cf7_contact_email" class="app_enable" 
										data-toggle="cf7_contact_email_instructions" name="mo_customer_validation_cf7_contact_type" 
										value="'.$cf7_type_email.'"
										'.( $cf7_enabled_type == $cf7_type_email ? "checked" : "").' /><strong>
										'. __( "Enable Email verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($cf7_enabled_type != $cf7_type_email ? "hidden" :"").' class="mo_registration_help_desc" 
											id="cf7_contact_email_instructions" >
											'. __( "Follow the following steps to enable Email Verification for",'wp-otp-verification').'
											Contact form 7: 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( "to see your list of pages.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of the page which has your contact form.",'wp-otp-verification').'</li>
												<li>'. __( "Add the following short code just below your Contact Form 7 shortcode",'wp-otp-verification').': <code>[mo_verify_email]</code> </li>
												<li><a href="'.$cf7_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a>'
													. __( " to see your list of Contact Forms.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of your form.",'wp-otp-verification').'</li>
												<li>
													'. __( "Now place the following code in your form where you wish to show the Verify Email button 
															and field ",'wp-otp-verification').': <br>
													<pre>&lt;div style="margin-bottom:3%"&gt;<br/>&lt;input type="button" class="button alt" style="width:100%" id="miniorange_otp_token_submit" title="'. __( "Please Enter an Email Address to enable this.",'wp-otp-verification').'" value="'. __( "Click here to verify your Email",'wp-otp-verification').'"&gt;&lt;div id="mo_message" hidden="" style="background-color: #f7f6f7;padding: 1em 2em 1em 3.5em;"&gt;&lt;/div&gt;<br/>&lt;/div&gt;
													<br/><br/>&lt;p&gt;'. __( "Verify Code (required)",'wp-otp-verification').' &lt;br /&gt;<br/>	[text* email_verify]&lt;/p&gt;</pre>
												</li>
												<li>'. __( "Enter the name of the email field below",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="cf7_email_field_key" name="cf7_email_field_key" type="text" value="'.$cf7_field_key.'">
													<div class="mo_otp_note">'.__( " Name of the Email Field is the value after email* in your Contact Form 7 form." , 'wp-otp-verification' ).' <br/><i>'. __( "For Reference",'wp-otp-verification').': [ email* &lt;name of your email field&gt; ]</i></div>
												</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="cf7_contact_phone" class="app_enable" data-toggle="cf7_contact_phone_instructions" name="mo_customer_validation_cf7_contact_type" value="'.$cf7_type_phone.'"
										'.( $cf7_enabled_type == $cf7_type_phone ? "checked" : "").' /><strong>'.__( "Enable Phone verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($cf7_enabled_type != $cf7_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="cf7_contact_phone_instructions" >
											'.__( "Follow the following steps to enable Phone Verification for Contact form 7",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'.__( "Click Here",'wp-otp-verification').'</a> '.__( "to see your list of pages.",'wp-otp-verification').'</li>
												<li>'.__( "Click on the <b>Edit</b> option of the page which has your contact form.",'wp-otp-verification').'</li>
												<li>'.__( "Add the following short code just below your Contact Form 7 shortcode ",'wp-otp-verification').': <code>[mo_verify_phone]</code> </li>
												<li><a href="'.$cf7_field_list.'" target="_blank">'.__( "Click Here",'wp-otp-verification').'</a> '.__(" to see your list of Contact Forms.",'wp-otp-verification').'</li>
												<li>'.__( "Click on the <b>Edit</b> option of your form.",'wp-otp-verification').'</li>
												<li>
													'. __( "Now place the following code in your form where you wish to show the Verify Phone button and field ",'wp-otp-verification').': <br>
													<pre>&lt;p&gt;'.__( "Phone Number (required)",'wp-otp-verification').' &lt;br /&gt;<br/>	[tel* mo_phone]&lt;/p&gt;<br /><br/>&lt;div style="margin-bottom:3%"&gt;<br/>&lt;input type="button" class="button alt" style="width:100%" id="miniorange_otp_token_submit" title="'. __( "Please Enter a phone number to enable this.",'wp-otp-verification').'" value="'. __( "Click here to verify your Phone",'wp-otp-verification').'"&gt;&lt;div id="mo_message" hidden="" style="background-color: #f7f6f7;padding: 1em 2em 1em 3.5em;"&gt;&lt;/div&gt;<br/>&lt;/div&gt;<br/><br/>&lt;p&gt;'. __( "Verify Code (required)",'wp-otp-verification').'&lt;br /&gt;<br/>	[text* phone_verify]&lt;/p&gt;</pre>
												</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
								</div>
							</div>';