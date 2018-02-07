<?php 

echo'

	 <div class="mo_registration_divided_layout">
		<div class="mo_registration_table_layout">';

			is_customer_registered();

echo '<form name="f" method="post" action="" id="mo_otp_verification_messages">
		<input type="hidden" name="option" value="mo_customer_validation_messages" />
			<table style="width:100%">
				<tr>
					<td>
						<h2>'.__("CONFIGURE MESSAGES",'wp-otp-verification').'
							<span style="float:right;margin-top:-10px;">
								<input type="submit" '.$disabled.' name="save" id="save" class="button button-primary button-large" 
									value="'.__("Save Settings",'wp-otp-verification').'"/>
							</span>
						</h2><hr/>
					</td>
				</tr>
				<tr>
					<td> <strong>'.__("Configure messages your users will see on successful and failure of Email or SMS delivery.",
										'wp-otp-verification').'</strong> </td>
				</tr>
				<tr>
					<td>
						<h3>'.__("Email Messages",'wp-otp-verification').'</h3><hr/>
						<div style="margin-left:1%;">
							<div style="margin-bottom:1%;"><strong>'.__("SUCCESS OTP MESSAGE",'wp-otp-verification').': </strong>
							<span style="color:red">'.__("( NOTE: ##email## in the message body will be replaced by the user's email address )",
															'wp-otp-verification').'</span></div>
							<textarea name="otp_success_email" rows="4" style="width:100%;padding:2%;">'.__($otp_success_email,'wp-otp-verification').'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.__("ERROR OTP MESSAGE",'wp-otp-verification').': </strong></div>
							<textarea name="otp_error_email" rows="4" style="width:100%;padding:2%;">'.__($otp_error_email,'wp-otp-verification').'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.__("BLOCKED EMAIL MESSAGE",'wp-otp-verification').': </strong>
							<span style="color:red">'.__("( NOTE: ##email## in the message body will be replaced by the user's email address )",
															'wp-otp-verification').'</span></div>
							<textarea name="otp_blocked_email" rows="4" style="width:100%;padding:2%;">'.__($otp_blocked_email,'wp-otp-verification').'</textarea><br/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<h3>'.__("SMS/Mobile Messages",'wp-otp-verification').'</h3><hr/>
						<div style="margin-left:1%;">
							<div style="margin-bottom:1%;"><strong>'.__("SUCCESS OTP MESSAGE",'wp-otp-verification').': </strong>
							<span style="color:red">'.__("( NOTE: ##phone## in the message body will be replaced by the user's mobile number )",
															'wp-otp-verification').'</span></div>
							<textarea name="otp_success_phone" rows="4" style="width:100%;padding:2%;">'.__($otp_success_phone,'wp-otp-verification').'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.__("ERROR OTP MESSAGE",'wp-otp-verification').': </strong></div>
							<textarea name="otp_error_phone" rows="4" style="width:100%;padding:2%;">'.__($otp_error_phone,'wp-otp-verification').'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.__("INVALID FORMAT MESSAGE",'wp-otp-verification').': </strong>
							<span style="color:red">'.__("( NOTE: ##phone## in the message body will be replaced by the user's mobile number )",
															'wp-otp-verification').'</span></div>
							<textarea name="otp_invalid_phone" rows="4" style="width:100%;padding:2%;">'.__($otp_invalid_format,'wp-otp-verification').'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.__("BLOCKED PHONE MESSAGE",'wp-otp-verification').': </strong>
							<span style="color:red">'.__("( NOTE: ##phone## in the message body will be replaced by the user's mobile number )",
															'wp-otp-verification').'</span></div>
							<textarea name="otp_blocked_phone" rows="4" style="width:100%;padding:2%;">'.__($otp_blocked_phone,'wp-otp-verification').'</textarea><br/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<h3>'.__("Common Messages",'wp-otp-verification').'</h3><hr/>
						<div style="margin-left:1%">
							<div style="margin-bottom:1%;"><strong>'.__("INVALID OTP MESSAGE",'wp-otp-verification').': </strong></div>
							<textarea name="invalid_otp" rows="4" style="width:100%;padding:2%;">'.__($invalid_otp,'wp-otp-verification').'</textarea><br/>
						</div>
					</td>
				</tr>

			</table>
	  </form>'; 

echo '
		</div>
	 </div>	';

