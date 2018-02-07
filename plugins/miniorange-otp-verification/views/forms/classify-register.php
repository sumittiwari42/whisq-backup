<?php
echo'			<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="classify_theme" class="app_enable" data-toggle="classify_options" name="mo_customer_validation_classify_enable" value="1"
										'.$classify_enabled.' /><strong>Classify Theme '. __( "Registration Form",'wp-otp-verification').'</strong>';

						get_plugin_form_link(MoConstants::CLASSIFY_LINK);

echo'							<div class="mo_registration_help_desc" '.$classify_hidden.' id="classify_options">

									<p><input type="radio" '.$disabled.' id="classify_email" class="app_enable" data-toggle="classify_email_instructions" name="mo_customer_validation_classify_type" value="'.$classify_type_email.'"
										'.( $classify_enabled_type == $classify_type_email ? "checked" : "").' />
										<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>

										<div '.($classify_enabled_type != $classify_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="classify_email_instructions" >
											'. __( "Follow the following to configure your Registration form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see the list of pages.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Edit option of the \"Register\" page",'wp-otp-verification').'</li>
												<li>'. __( "From the page Attributes section ,set \"Register Page\" from your template dropdown menu.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Update button to save your settings.",'wp-otp-verification').'</li>
											</ol>
											'. __( "Follow the following to configure your Profile form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see the list of pages.",'wp-otp-verification').'</li>
												<li>'.( $classify_enabled_type == "classify_email_enable" ? "checked" : ""). __( "Click on the Edit option of the \"Profile\" page",'wp-otp-verification').'</li>
												<li>'.( $classify_enabled_type == "classify_email_enable" ? "checked" : ""). __( "From the page Attributes section ,set \"Profile Page\" from your template dropdown menu.",'wp-otp-verification').'</li>
												<li>'.( $classify_enabled_type == "classify_email_enable" ? "checked" : ""). __( "Click on the Update button to save your settings.",'wp-otp-verification').'</li><br><br>
											</ol>

											'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'
											</div>

									<p><input type="radio" '.$disabled.' id="classify_phone" class="app_enable" data-toggle="classify_phone_instructions" 	name="mo_customer_validation_classify_type" value="'.$classify_type_phone.'"
										'.( $classify_enabled_type == $classify_type_phone ? "checked" : "").' />
										<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>

									<div '.($classify_enabled_type != $classify_type_phone ? "hidden" :"").' class="mo_registration_help_desc" id="classify_phone_instructions" >
										'. __( "Follow the following to configure your Registration form ",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see the list of pages.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Edit option of the \"Register\" page",'wp-otp-verification').'</li>
												<li>'. __( "From the page Attributes section ,set \"Register Page\" from your template dropdown menu.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Update button to save your settings.",'wp-otp-verification').'</li>
											</ol>
										'. __( "Follow the following to configure your Profile form ",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$page_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see the list of pages.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Edit option of the \"Profile\" page",'wp-otp-verification').'</li>
												<li>'. __( "From the page Attributes section ,set \"Profile\" Page from your template dropdown menu.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Update button to save your settings.",'wp-otp-verification').'</li>
											</ol>

											'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'
											</div>

								</div>';
