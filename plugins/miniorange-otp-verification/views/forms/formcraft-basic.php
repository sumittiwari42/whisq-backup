<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="formcraft" class="app_enable" data-toggle="formcraft_options" name="mo_customer_validation_formcraft_enable" value="1"
										'.$formcraft_enabled.' /><strong>FormCraft Basic (Free Version)</strong>';

									get_plugin_form_link(MoConstants::FORMCRAFT_BASIC_LINK);								 

echo'							<div class="mo_registration_help_desc" '.$formcraft_hidden.' id="formcraft_options">
									<p><input type="radio" '.$disabled.' id="formcraft_email" class="app_enable" data-toggle="fcbe_instructions" name="mo_customer_validation_formcraft_enable_type" value="'.$formcarft_type_email.'"
										'.( $formcraft_enabled_type == $formcarft_type_email ? "checked" : "").' />
										<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($formcraft_enabled_type != $formcarft_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="fcbe_instructions" >
											'. __( "Follow the following steps to enable Email Verification for FormCraft",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$formcraft_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of forms",'wp-otp-verification').'</li>
												<li>'. __( "Click on the form to edit it.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Email Field to your form. Note the Label of the email field.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Verification Field to your form where users will enter the OTP received. Note the Label of the verification field.",'wp-otp-verification').'</li>
												<li>'. __( "Enter your Form ID, the label of the Email Field and Verification Field below",'wp-otp-verification').':<br>
													<br/>'. __( "Add Form ",'wp-otp-verification').': <input type="button"  value="+" '. $disabled .' onclick="add_fc_form(\'email\',1);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_fc_form(1);" class="button button-primary" /><br/><br/>';

													$form_results = get_formcraft_basic_form_list($formcraft_otp_enabled,$disabled,1); 
													$counter1 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'											</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="formcraft_phone" class="app_enable" data-toggle="fcbp_instructions" name="mo_customer_validation_formcraft_enable_type" value="'.$formcarft_type_phone.'"
										'.( $formcraft_enabled_type == $formcarft_type_phone ? "checked" : "").' />
										<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($formcraft_enabled_type != $formcarft_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="fcbp_instructions" >
											'. __( "Follow the following steps to enable Phone Verification for FormCraft",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$formcraft_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of forms",'wp-otp-verification').'</li>
												<li>'. __( "Click on the form to edit it.",'wp-otp-verification').'</li>
												<li>'. __( "Add a Phone Field to your form. Note the Label of the phone field.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Verification Field to your form where users will enter the OTP received. Note the Label of the verification field.",'wp-otp-verification').'</li>
												<li>'. __( "Enter your Form ID, the label of the Email Field and Verification Field below",'wp-otp-verification').':<br>
													<br/>'. __( "Add Form ",'wp-otp-verification').': <input type="button"  value="+" '. $disabled .' onclick="add_fc_form(\'phone\',2);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_fc_form(2);" class="button button-primary" /><br/><br/>';

													$form_results = get_formcraft_basic_form_list($formcraft_otp_enabled,$disabled,2); 
													$counter2 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'											</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
								</div>
							</div>';

echo 						'<script>
								var countfc1, countfc2;
								function add_fc_form(t,n){
									var countFcIdpAttr = this["countfc"+n];
									var hidden1="",hidden2="",space="";
									if(n==1)
										hidden2 = "hidden";
									if(n==2)
										hidden1 = "hidden";
									countFcIdpAttr += 1;
									var sel = "<div id=\'fc_row"+n+"_"+countFcIdpAttr+"\'> '.__( "Form ID", 'wp-otp-verification').': <input id=\'formcraft_"+countFcIdpAttr+"\' class=\'field_data\' name=\'formcraft[form][]\' type=\'text\' value=\'\'/> <span "+hidden1+" >&nbsp;'.__( "Email Field Label", 'wp-otp-verification').': <input id=\'formcraft_email_"+countFcIdpAttr+"\'  class=\'field_data\' name=\'formcraft[emailkey][]\' type=\'text\' value=\'\'></span> <span "+hidden2+">"+space+"'.__( "Phone Field Label", 'wp-otp-verification').': <input id=\'formcraft_phone_"+countFcIdpAttr+"\' class=\'field_data\' name=\'formcraft[phonekey][]\' type=\'text\' value=\'\'></span> <span>&nbsp;'.__( "Verification Field Label", 'wp-otp-verification').': <input id=\'formcraft_verify_"+countFcIdpAttr+"\'  class=\'field_data\' name=\'formcraft[verifyKey][]\' type=\'text\' value=\'\'></span> </div>"
									if(countFcIdpAttr!=0)
										$mo(sel).insertAfter($mo(\'#fc_row\'+n+\'_\'+(countFcIdpAttr-1)+\'\'));
									this["countfc"+n]=countFcIdpAttr;
								}
								function remove_fc_form(){
									var countFcIdpAttr =   Math.max(this["countfc1"],this["countfc2"]);
									if(countFcIdpAttr != 0){
										$mo("#fc_row1_" + countFcIdpAttr).remove();
										$mo("#fc_row2_" + countFcIdpAttr).remove();
										$mo("#fc_row3_" + countFcIdpAttr).remove();
										countFcIdpAttr -= 1;
										this["countfc1"]=this["countfc2"]=countFcIdpAttr;
									}
								}
								jQuery(document).ready(function(){  countfc1 = '. $counter1 .'; countfc2 = ' .$counter2. '; });
							</script>';

