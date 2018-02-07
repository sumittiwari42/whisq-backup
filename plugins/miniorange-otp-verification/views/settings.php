<?php

echo'	<div class="mo_registration_divided_layout">
			<div class="mo_registration_table_layout">';

			is_customer_registered();

echo'			<form name="f" method="post" action="" id="mo_otp_verification_settings">
					<input type="hidden" id="error_message" name="error_message" value="">
					<input type="hidden" name="option" value="mo_customer_validation_settings" />
					<table style="width:100%">
						<tr>
							<td colspan="2">
								<h2>'.__("CONFIGURE YOUR FORM",'wp-otp-verification').'</h2>
								<hr/>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="mo_otp_note">
									<b><div class="mo_otp_dropdown_note" data-toggle="how_to_use_the_otp_plugin">
										'.__('HOW DO I USE THE PLUGIN?','wp-otp-verification').'
										</div></b>
									<div id="how_to_use_the_otp_plugin" hidden>
										<b>'.__("By following these easy steps you can verify your users email or phone number instantly",
												'wp-otp-verification').':
										<ol>
											<li>'.__("Select the form from the list below.",'wp-otp-verification');  
												mo_draw_tooltip(MoMessages::showMessage('FORM_NOT_AVAIL_HEAD'),
																MoMessages::showMessage('FORM_NOT_AVAIL_BODY'));
		echo'								</li>
											<li>'.__("Save your settings.",'wp-otp-verification').'</li>
											<li>'.__("Log out and go to your registration or landing page for testing.",'wp-otp-verification').'</li>
											<li>'.__("To customize your SMS/Email messages/gateway check under",'wp-otp-verification').' 
													<a href="'.$config.'"> '.__("SMS/Email Templates Tab",'wp-otp-verification').'</a></li>
											<li>'.__("For any query related to custom SMS/Email messages/gateway check",'wp-otp-verification').' 
												<a href="'.$help_url.'"> '.__("Help & Troubleshooting Tab",'wp-otp-verification').'</a></li>
											<li>
											<div>
												<i><b>'.__("Cannot see your registration form in the list above? Have your own custom registration form?"
															,'wp-otp-verification').'</b></i>';
												mo_draw_tooltip(MoMessages::showMessage('FORM_NOT_AVAIL_HEAD'),
																MoMessages::showMessage('FORM_NOT_AVAIL_BODY'));
		echo'								</div>
											</li>
											</b>
										</ol>
									</div>
								</div>
								<div class="mo_otp_note" style="color:#942828;">
									<b><div class="mo_otp_dropdown_note" data-toggle="wc_sms_notif_addon">
										'.__('NEED A DEVELOPER DOCUMENTATION? WISH TO INTEGRATE YOUR FORM WITH THE PLUGIN?','wp-otp-verification').'
										</div></b>
									<div id="wc_sms_notif_addon" hidden>
										'.__( " <i>If you wish to integrate the plugin with your form then you can follow our documentation. Contact us at info@miniorange.com or use the support section on the right to get the documentaion.</i>", 'wp-otp-verification').'
									</div>
								</div>
								<div class="mo_otp_note" style="color:#942828;">
									<div class="corner-ribbon top-left sticky red shadow">'.__("NEW",'wp-otp-verification').'</div>
									<b><div class="mo_otp_dropdown_note" data-toggle="wc_sms_notif_addon" style="color:#942828;margin-left: 50px;">
										'.__('LOOKING FOR A WOOCOMMERCE SMS NOTIFICATION PLUGIN?','wp-otp-verification').'
										</div></b>
									<div id="wc_sms_notif_addon" style="margin-left: 20px;">
										'.__( " <b> Looking for a plugin that will send out SMS notifications to users and admin for WooCommerce? </b> <i>We have a separate add-on for that. Contact us at info@miniorange.com or use the support section on the right and we will help you get started.</i>", 'wp-otp-verification').'
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td>
								<h2>'.__("Select your form from the list",'wp-otp-verification').': </h2>
								<!--<div style="margin-top:1em;margin-left:1%;float:left;"><input type="text" id="mo_search" 
									placeholder="Search for your form"></input></div>-->
								</td><td>';

								get_otp_verification_form_dropdown();
								mo_draw_tooltip(MoMessages::showMessage('FORM_NOT_AVAIL_HEAD'),MoMessages::showMessage('FORM_NOT_AVAIL_BODY'));
echo'							
							</td>
						</tr>
					</table>
					<table id="mo_forms" style="width: 100%;">
						<tr>
							<td><strong><i>'.__("REGISTRATION FORMS",'wp-otp-verification').'</i></strong><hr></td>
						</tr>';

						show_form_details('forms',$controller,$disabled,$page_list);

echo'					</tr>
					</table>
					<br>
					<table id="mo_forms" style="width: 100%;">
						<tr>
							<td><strong><i>'.__("LOGIN FORMS",'wp-otp-verification').'</i></strong><hr></td>
						</tr>
						<tr>
	 						<td>';
								include $controller . 'forms/wp-login.php';											
echo'						</td>
						</tr>
					</table>
					<input type="button" id="ov_settings_button"  
						title="'.__("Please select atleast one form from the list above to enable this button",'wp-otp-verification').'" 
						value="'.__("Save",'wp-otp-verification').'" style="float:left;margin-bottom:2%;" '.$disabled.'
						class="button button-primary button-large" />
			</form>
		</div>
	</div>';