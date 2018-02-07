<?php 

echo'	<div class="mo_registration_divided_layout">
			<div class="mo_registration_table_layout">';

				is_customer_registered();

echo'			<table class="mo_registration_settings_table" style="width: 100%;">
					<form name="f" method="post" action="">
						<input type="hidden" name="option" value="mo_customer_validation_custom_notif" />
						<tr id="sms">
							<td>
								<h2>'.__("SEND CUSTOM MESSAGE",'wp-otp-verification').'
									<span style="float:right;margin-top:-10px;">
										<input name="save" id="save" class="button button-primary button-large" 
											value="'.__("Send Message",'wp-otp-verification').'" type="submit">
									</span>
								</h2>
								<hr/>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<div>
										<b>'.__("Phone Numbers:",'wp-otp-verification').'</b>
										<input '.$disabled.' class="mo_registration_table_textbox" style="border:1px solid #ddd" 
											name="mo_phone_numbers" 
											placeholder="'.__("Enter semicolon(;) separated Phone Numbers",'wp-otp-verification').'" 
											value="" required="">
									</div>
									<br>
									<div>
										<b>'.__("Message",'wp-otp-verification').'</b>
										<textarea '.$disabled.' id="custom_sms_msg" class="mo_registration_table_textbox" 
											name="mo_customer_validation_custom_sms_msg" 
											placeholder="'.__("Enter OTP SMS Message",'wp-otp-verification').'" 
											required/></textarea><br>
									</div>
								</div>
							</td>
						</tr>
					</form>
				</table>
			</div>
		</div>';
