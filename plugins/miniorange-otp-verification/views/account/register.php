<?php	

echo'<!--Register with miniOrange-->
	<form name="f" method="post" action="" id="register-form">
		<input type="hidden" name="option" value="mo_registration_register_customer" />
		<div class="mo_registration_divided_layout">
			<div class="mo_registration_table_layout">
				<h3>'.__("Register with miniOrange",'wp-otp-verification').'</h3>
				<p>'.__("Please enter a valid email that you have access to. You will be able to move forward after verifying an OTP that we will be sending to this email.",'wp-otp-verification').' <b>OR</b> '.__("Login using your miniOrange credentials.",'wp-otp-verification').'</p>
				<table class="mo_registration_settings_table">
					<tr>
						<td><b><font color="#FF0000">*</font>'.__("Email:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" type="email" name="email"
							required placeholder="person@example.com"
							value="'.$current_user->user_email.'" /></td>
					</tr>

					<tr>
						<td><b><font color="#FF0000">*</font>'.__("Website/Company Name:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" type="text" name="company"
							required placeholder="'.__("Enter your companyName",'wp-otp-verification').'"
							value="'.$_SERVER["SERVER_NAME"].'" /></td>
						<td></td>
					</tr>

					<tr>
						<td><b>&nbsp;&nbsp;'.__("FirstName:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" type="text" name="fname"
							placeholder="'.__("Enter your First Name",'wp-otp-verification').'"
							value="'.$current_user->user_firstname.'" /></td>
						<td></td>
					</tr>

					<tr>
						<td><b>&nbsp;&nbsp;'.__("LastName:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" type="text" name="lname"
							placeholder="'.__("Enter your Last Name",'wp-otp-verification').'"
							value="'.$current_user->user_lastname.'" /></td>
						<td></td>
					</tr>

					<tr>
						<td><b>&nbsp;&nbsp;'.__("Phone number:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" type="tel" id="phone"
							pattern="[\+]\d{7,14}|[\+]\d{1,4}[\s]\d{6,12}" name="phone"
							title="'.MoMessages::showMessage('MO_REG_ENTER_PHONE').'"
							placeholder="'.MoMessages::showMessage('MO_REG_ENTER_PHONE').'"
							value="'.$admin_phone.'" /><br>'.__("We will call only if you need support.",'wp-otp-verification').'</td>
						<td></td>
					</tr>

					<tr>
						<td><b><font color="#FF0000">*</font>'.__("Password:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" required type="password"
							name="password" placeholder="'.__("Choose your password (Min. length 6)",'wp-otp-verification').'" /></td>
					</tr>
					<tr>
						<td><b><font color="#FF0000">*</font>'.__("Confirm Password:",'wp-otp-verification').'</b></td>
						<td><input class="mo_registration_table_textbox" required type="password"
							name="confirmPassword" placeholder="'.__("Confirm your password",'wp-otp-verification').'" /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><br /><input type="submit" name="submit" value="'.__("Next",'wp-otp-verification').'" style="width:100px;"
							class="button button-primary button-large" /></td>
					</tr>
				</table>
			</div>
		</div>
	</form>';