<?php 

echo'	<div class="mo_registration_divided_layout">
			<div class="mo_registration_table_layout">';

			is_customer_registered();

echo'			<table style="width:100%">
					<form name="f" method="post" action="" id="mo_otp_verification_settings">
						<input type="hidden" name="option" value="mo_otp_extra_settings" />
						<tr>
							<td colspan="2">
								<h2>'.__("OTP SETTINGS",'wp-otp-verification').'
								<span style="float:right;margin-top:-10px;">
									<input type="submit" '.$disabled.' name="save" id="save" class="button button-primary button-large" value="'.__("Save Settings",'wp-otp-verification').'"/>
								</span>
								</h2><hr>
							</td>
						</tr>';

						if($showTransactionOptions){
							echo '	<tr>
										<td colspan="2"><strong><i>'.__("REMAINING TRANSACTION: ",'wp-otp-verification').'</i></strong></td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="checkbox" '.$disabled.' name="mo_show_remaining_trans" value="1"'.$show_trans.' /> '.__("Show Remaining Phone and Email Transactions as a baner in your dashboard?",'wp-otp-verification').'
											<div class="mo_otp_note" style="color:#942828;">
												 <i>'.__("You can still see your remaining transactions in the <b>At a Glance section</b> of your admin dashboard","wp-otp-verification").'</i>
											</div>
										</td>
									</tr>
									<tr><td colspan="2"><hr></td></tr>
									<tr>
										<td><strong><i>'.__("OTP LENGTH: ",'wp-otp-verification').'</i></strong></td>
										<td><strong><i>'.__("OTP VALIDITY (in mins): ",'wp-otp-verification').'</i></strong></td>
									</tr>
									<tr>
										<td width="50%">
											<div class="mo_otp_note" style="padding:10px;">
												<span style="color:#942828;"><i>'.__("Follow these steps to change the length of your OTP. The OTP generated will be of the length specified:",'wp-otp-verification').'</i></span>
												<ol>
													<li>'.__("Click on the button below.",'wp-otp-verification').'</li>
													<li>'.__("Login using the Credentials you used to register for this plugin.",'wp-otp-verification').'</li>
													<li>'.__("You will be presented with a <b><i>General Product Settings Page</i></b>.",'wp-otp-verification').'</li>
													<li>'.__("On this page search for <b><i>One Time Password Preferences Settings</i></b>.",'wp-otp-verification').'</li>
													<li>'.__("Choose your OTP length from the OTP length dropdown.",'wp-otp-verification').'</li>
													<li>'.__("Click on the Save button to save your settings.",'wp-otp-verification').'</li>
												</ol>
												<div style="text-align:center">
													<input '. $disabled. ' type="button" 
														title="'.__("Need to be registered for this option to be available",'wp-otp-verification').'"  
														value="'.__("Change OTP Length",'wp-otp-verification').'" 
														onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/customerpreferences\');" 
														class="button button-primary button-large" style="margin-right: 3%;">
												</div>
											</div>
										</td>
										<td width="50%">
											<div class="mo_otp_note" style="padding:10px;">
												<span style="color:#942828;"><i>'.__("Follow these steps to change the time for how long the OTP will stay valid for:",'wp-otp-verification').'</i></span>
												<ol>
													<li>'.__("Click on the button below.",'wp-otp-verification').'</li>
													<li>'.__("Login using the Credentials you used to register for this plugin.",'wp-otp-verification').'</li>
													<li>'.__("You will be presented with a <b><i>General Product Settings Page</i></b>.",'wp-otp-verification').'</li>
													<li>'.__("On this page search for <b><i>One Time Password Preferences Settings</i></b>.",'wp-otp-verification').'</li>
													<li>'.__("Enter the  number in mins that you want the OTP to stay valid for in the OTP Validity textbox.",'wp-otp-verification').'</li>
													<li>'.__("Click on the Save button to save your settings.",'wp-otp-verification').'</li>
												</ol>
												<div style="text-align:center">
													<input '. $disabled. ' type="button" 
														title="'.__("Need to be registered for this option to be available",'wp-otp-verification').'"  
														value="'.__("Change OTP Validity",'wp-otp-verification').'" 
														onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/customerpreferences\');" 
														class="button button-primary button-large" style="margin-right: 3%;">
												</div>
											</div>
										</td>
									</tr>
									<tr><td colspan="2"><hr></td></tr>';
						}else{

						echo	'<tr>
									<td><strong><i>'.__("OTP LENGTH: ",'wp-otp-verification').'</i></strong></td>
									<td><strong><i>'.__("OTP VALIDITY (in mins): ",'wp-otp-verification').'</i></strong></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="mo_registration_table_textbox" value="'.$mo_otp_length.'" name="mo_otp_length"/>
										<div class="mo_otp_note" style="color:#942828;">
											 <i>'.__("Enter the length that you want the OTP to be.<br/>Default is 5","wp-otp-verification").'</i>
										</div>
									</td>
									<td>
										<input type="text" class="mo_registration_table_textbox" value="'.$mo_otp_validity.'" name="mo_otp_validity"/>
										<div class="mo_otp_note" style="color:#942828;">
											 <i>'.__("Enter the time in minutes an OTP will stay valid for.<br/>Default is 5 mins","wp-otp-verification").'</i>
										</div>
									</td>
								</tr>
								<tr><td colspan="2"><hr></td></tr>';
						}

echo					'<tr>
							<td><strong><i>'.__("COUNTRY CODE: ",'wp-otp-verification').'</i></strong><br/></td>
						</tr>
						<tr>
							<td colspan="2">
								<strong><i>'.__("Select Default Country Code",'wp-otp-verification').': </i></strong>
							';

								get_country_code_dropdown(); 
								mo_draw_tooltip(MoMessages::showMessage('COUNTRY_CODE_HEAD'),MoMessages::showMessage('COUNTRY_CODE_BODY'));

								echo "<i style='margin-left:1%''>".__("Country Code",'wp-otp-verification').": <span id='country_code'></span></i> " ;

echo						'</td>
						</tr>
						<tr>
							<td colspan="2"><input type="checkbox" '.$disabled.' name="show_dropdown_on_form" value="1"'.$show_dropdown_on_form.' /> '.__("Show a country code dropdown on the phone field.",'wp-otp-verification').'</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2"><strong><i>'.__("BLOCKED EMAIL DOMAINS: ",'wp-otp-verification').'</i></strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea name="mo_otp_blocked_email_domains" rows="5" style="width:100%" 
								placeholder="'.__(" Enter semicolon separated domains that you want to block. Eg. gmail.com ", 'wp-otp-verification').'">'.$otp_blocked_email_domains.'</textarea></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2"><strong><i>'.__("BLOCKED PHONE NUMBERS: ",'wp-otp-verification').'</i></strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea name="mo_otp_blocked_phone_numbers" rows="5" style="width:100%" 
								placeholder="'.__(" Enter semicolon separated phone numbers (with country code) that you want to block. Eg. +1XXXXXXXX ", 'wp-otp-verification').'">'.$otp_blocked_phones.'</textarea></td>
						</tr>
					</form>	
				</table>
			</div>
		</div>
		<form id="showExtraSettings" action="'. MoConstants::HOSTNAME.'/moas/login" target="_blank" method="post">
	       <input type="hidden" id="extraSettingsUsername" name="username" value=" '. $email.'"/>
	       <input type="hidden" id="extraSettingsRedirectURL" name="redirectUrl" value="" />
		</form>';			