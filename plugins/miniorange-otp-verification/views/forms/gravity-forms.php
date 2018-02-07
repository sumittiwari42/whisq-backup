<?php

echo'			<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="gf_contact" class="app_enable" data-toggle="gf_contact_options" name="mo_customer_validation_gf_contact_enable" value="1"
										'.$gf_enabled.' /><strong>Gravity '. __( "Form",'wp-otp-verification') . '</strong>';

								get_plugin_form_link(MoConstants::GF_FORM_LINK);								 

echo'							<div class="mo_registration_help_desc" '.$gf_hidden.' id="gf_contact_options">
									<p><input type="radio" '.$disabled.' id="gf_contact_email" class="app_enable" data-toggle="gf_contact_email_instructions" name="mo_customer_validation_gf_contact_type" value="'.$gf_type_email.'"
										'.( $gf_enabled_type == $gf_type_email ? "checked" : "").' />
										<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>

										<div '.($gf_enabled_type != $gf_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="gf_contact_email_instructions" >
											'. __( "Follow the following steps to enable Email Verification for",'wp-otp-verification').' Gravity form: 
											<ol>
												<li><a href="'.$gf_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of the Gravity Forms.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Edit option of your form",'wp-otp-verification').'</li>
												<li>'. __( "Add an email field to your existing form",'wp-otp-verification').'</li>
												<li>'. __( "Add a text field with label \"Enter Validation Code\" in your existing form.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Edit option of your form",'wp-otp-verification').'Add the form id of your form below for which you want to enable Email verification:<br>
												<br/>'. __( "Add Form",'wp-otp-verification').' : <input type="button"  value="+" '. $disabled .' onclick="add_gravityform(1);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_gravityform();" class="button button-primary" /><br/><br/>';

													$gf_form_results = get_gf_form_list($gf_otp_enabled[1],$disabled,1); 
													$gfcounter1 	 = !MoUtility::isBlank($gf_form_results['counter']) ? max($gf_form_results['counter']-1,0) : 0 ;

echo'											
												</li>

												<li>'.__( "Click on the Save Button below to save your settings and keep a track of your Form Ids.",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="gf_contact_phone" class="app_enable" data-toggle="gf_contact_phone_instructions" name="mo_customer_validation_gf_contact_type" value="'.$gf_type_phone.'"
										'.( $gf_enabled_type == $gf_type_phone ? "checked" : "").' />
										<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($gf_enabled_type != $gf_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="gf_contact_phone_instructions" >
											'. __( "Follow the following steps to enable phone Verification for Gravity form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$gf_field_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of the Gravity Forms.",'wp-otp-verification').'</li>
												<li>'. __( "Click on the Edit option of your form",'wp-otp-verification').'</li>
												<li>'. __( "Add an phone field to your existing form",'wp-otp-verification').'</li>
												<li>'. __( "Add a text field with label \"Enter Validation Code\" in your existing form.",'wp-otp-verification').'</li>
												<li>'. __( "Add the form id of your form below for which you want to enable Phone verification",'wp-otp-verification').':<br>
												<br/>'. __( "Add Form",'wp-otp-verification').' : <input type="button"  value="+" '. $disabled .' onclick="add_gravityform(0);" class="button button-primary"/>&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_gravityform();" class="button button-primary" /><br/><br/>';

													$gf_form_results = get_gf_form_list($gf_otp_enabled[0],$disabled,0); 
													$gfcounter2	  	 = !MoUtility::isBlank($gf_form_results['counter']) ? max($gf_form_results['counter']-1,0) : 0 ;

echo                        	  				'</li>

												<li>'.__( "Click on the Save Button below to save your settings and keep a track of your Form Ids.",'wp-otp-verification').'</li>
											</ol>
									</div>

								</div>
							</div>';

		echo 				'<script>
								var gfcount1,gfcount0;
								function add_gravityform(n){

									var countIdpAttr = this["gfcount"+n];
									countIdpAttr += 1;
									var sel = "<div id=\'gfrow"+n+"_"+countIdpAttr+"\'> '.__( "Form ID", 'wp-otp-verification').': <input id=\'gravity_form"+countIdpAttr+"\' class=\'field_data\' name=\'gravity_form["+n+"][]\' type=\'text\' value=\'\'/>";
									if(countIdpAttr!=0)
										$mo(sel).insertAfter($mo(\'#gfrow\'+n+\'_\'+(countIdpAttr-1)+\'\'));

									this["gfcount"+n]=countIdpAttr;

								}
								function remove_gravityform(){			
									var countIdpAttr =  Math.max(this["gfcount1"],this["gfcount0"]);
									if(countIdpAttr != 0){

										$mo("#gfrow1_" + countIdpAttr).remove();
										$mo("#gfrow0_" + countIdpAttr).remove();
										countIdpAttr -= 1;
										this["gfcount1"]=this["gfcount0"]=countIdpAttr;
									}

								}
								jQuery(document).ready(function(){ gfcount1 = '.$gfcounter1.'; gfcount0 = '.$gfcounter2.';  });
							</script>';
