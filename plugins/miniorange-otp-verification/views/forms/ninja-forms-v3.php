<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="ninja_form" class="app_enable" data-toggle="ninja_ajax_form_options" name="mo_customer_validation_nja_enable" value="1"
										'.$ninja_ajax_form_enabled.' /><strong>Ninja Forms <i>'. __( "( Above Version 3.0 )",'wp-otp-verification').'</i></strong>';

									get_plugin_form_link(MoConstants::NINJA_FORMS_LINK);								 

echo'							<div class="mo_registration_help_desc" '.$ninja_ajax_form_hidden.' id="ninja_ajax_form_options">
									<p><input type="radio" '.$disabled.' id="ninja_ajax_form_email" class="app_enable" data-toggle="nfae_instructions" name="mo_customer_validation_nja_enable_type" value="'.$ninja_ajax_form_type_email.'"
										'.( $ninja_ajax_form_enabled_type == $ninja_ajax_form_type_email ? "checked" : "").' />
										<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($ninja_ajax_form_enabled_type != $ninja_ajax_form_type_email ? "hidden" :"").' class="mo_registration_help_desc" id="nfae_instructions" >
											'. __( "Follow the following steps to enable Email Verification for",'wp-otp-verification').' Ninja Form: 
											<ol>
												<li><a href="'.$ninja_ajax_form_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of forms",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of your ninja form.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Email Field to your form. Note the Field Key of the email field.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Verification Field to your form where users will enter the OTP received. Note the Field Key of the verification field.",'wp-otp-verification').'</li>
												<li>'. __( "Enter your Form ID, the Email Field Key and the Verification Field Key below",'wp-otp-verification').':<br>
													<br/>'. __( "Add Form ",'wp-otp-verification').': <input type="button"  value="+" '. $disabled .' onclick="add_ninja_form(\'email\',1);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_ninja_form(1);" class="button button-primary" /><br/><br/>';

													$form_results = get_nfa_form_list($ninja_ajax_form_otp_enabled,$disabled,1); 
													$counter1 	  =  !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;

echo'											</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
									<p><input type="radio" '.$disabled.' id="ninja_ajax_form_phone" class="app_enable" data-toggle="nfap_instructions" name="mo_customer_validation_nja_enable_type" value="'.$ninja_ajax_form_type_phone.'"
										'.( $ninja_ajax_form_enabled_type == $ninja_ajax_form_type_phone ? "checked" : "").' />
										<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
									</p>
									<div '.($ninja_ajax_form_enabled_type != $ninja_ajax_form_type_phone ? "hidden" : "").' class="mo_registration_help_desc" id="nfap_instructions" >
											'. __( "Follow the following steps to enable Phone Verification for Ninja Form",'wp-otp-verification').': 
											<ol>
												<li><a href="'.$ninja_ajax_form_list.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of forms",'wp-otp-verification').'</li>
												<li>'. __( "Click on the <b>Edit</b> option of your ninja form.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Phone Field to your form. Note the Field Key of the phone field.",'wp-otp-verification').'</li>
												<li>'. __( "Make sure you have set the Input Mask type to None for the phone field.",'wp-otp-verification').'</li>
												<li>'. __( "Add an Verification Field to your form where users will enter the OTP received. Note the Field Key of the verification field.",'wp-otp-verification').'</li>
												<li>'. __( "Enter your Form ID, the Phone Field Key and the Verification Field Key below",'wp-otp-verification').':<br>
													<br/>'. __( "Add Form ",'wp-otp-verification').': <input type="button"  value="+" '. $disabled .' onclick="add_ninja_form(\'phone\',2);" class="button button-primary" />&nbsp;
													<input type="button" value="-" '. $disabled .' onclick="remove_ninja_form(2);" class="button button-primary" /><br/><br/>';

													$form_results = get_nfa_form_list($ninja_ajax_form_otp_enabled,$disabled,2); 
													$counter2 	  = !MoUtility::isBlank($form_results['counter']) ? max($form_results['counter']-1,0) : 0 ;
echo'											</li>
												<li>'. __( "Click on the Save Button below to save your settings",'wp-otp-verification').'</li>
											</ol>
									</div>
								</div>
							</div>';

echo 						'<script>
								var countnja1, countnja2;
								function add_ninja_form(t,n){
									var countNjaIdpAttr = this["countnja"+n];
									var hidden1="",hidden2="",space="";
									if(n==1)
										hidden2 = "hidden";
									if(n==2)
										hidden1 = "hidden";
									countNjaIdpAttr += 1;
									var sel = "<div id=\'ajax_row"+n+"_"+countNjaIdpAttr+"\'> '.__( "Form ID", 'wp-otp-verification').': <input id=\'ninja_ajax_form_"+countNjaIdpAttr+"\' class=\'field_data\' name=\'ninja_ajax_form[form][]\' type=\'text\' value=\'\'/> <span "+hidden1+" >&nbsp;'.__( "Email Field Key", 'wp-otp-verification').': <input id=\'ninja_form_email_"+countNjaIdpAttr+"\'  class=\'field_data\' name=\'ninja_ajax_form[emailkey][]\' type=\'text\' value=\'\'></span> <span "+hidden2+">"+space+"'.__( "Phone Field Key", 'wp-otp-verification').': <input id=\'ninja_form_phone_"+countNjaIdpAttr+"\' class=\'field_data\' name=\'ninja_ajax_form[phonekey][]\' type=\'text\' value=\'\'></span> <span>&nbsp;'.__( "Verification Field Key", 'wp-otp-verification').': <input id=\'ninja_form_verify_"+countNjaIdpAttr+"\'  class=\'field_data\' name=\'ninja_ajax_form[verifyKey][]\' type=\'text\' value=\'\'></span> </div>"
									if(countNjaIdpAttr!=0)
										$mo(sel).insertAfter($mo(\'#ajax_row\'+n+\'_\'+(countNjaIdpAttr-1)+\'\'));
									this["countnja"+n]=countNjaIdpAttr;
								}
								function remove_ninja_form(){
									var countNjaIdpAttr =   Math.max(this["countnja1"],this["countnja2"]);
									if(countNjaIdpAttr != 0){
										$mo("#ajax_row1_" + countNjaIdpAttr).remove();
										$mo("#ajax_row2_" + countNjaIdpAttr).remove();
										$mo("#ajax_row3_" + countNjaIdpAttr).remove();
										countNjaIdpAttr -= 1;
										this["countnja1"]=this["countnja2"]=countNjaIdpAttr;
									}
								}
								jQuery(document).ready(function(){  countnja1 = '. $counter1 .'; countnja2 = ' .$counter2. '; });
							</script>';

