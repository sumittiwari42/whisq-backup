<?php

echo '<div class="mo_registration_divided_layout">
	<div class="mo_registration_table_layout">

	<div>
	<div style="width:50%;float:left;"><h4>Thank you for registering with us.</h4></div>
	<span style="width:50%;float:left;text-align:right;margin: 1em 0 1.33em 0">
	<input type="button" '.$disabled.' name="check_btn" id="check_btn" class="button button-primary button-large" value="'.__("Check License",'wp-otp-verification').'"/>
		</span></div>
		<h3>'.__("Your Profile",'wp-otp-verification').'</h3>
		<table border="1" style="background-color:#FFFFFF; border:1px solid #CCCCCC; border-collapse: collapse; padding:0px 0px 0px 10px; margin:2px; width:100%">
			<tr>
				<td style="width:45%; padding: 10px;"><b>'.__("Registered Email",'wp-otp-verification').'</b></td>
				<td style="width:55%; padding: 10px;">'.$email.'</td>
			</tr>
			<tr>
				<td style="width:45%; padding: 10px;"><b>'.__("Customer ID",'wp-otp-verification').'</b></td>
				<td style="width:55%; padding: 10px;">'.$customer_id.'</td>
			</tr>
			<tr>
				<td style="width:45%; padding: 10px;"><b>'.__("API Key",'wp-otp-verification').'</b></td>
				<td style="width:55%; padding: 10px;">'.$api_key.'</td>
			</tr>
			<tr>
				<td style="width:45%; padding: 10px;"><b>'.__("Token Key",'wp-otp-verification').'</b></td>
				<td style="width:55%; padding: 10px;">'.$token.'</td>
			</tr>
		</table><br/><hr>
		<h3>'.__("Track your Transactions:",'wp-otp-verification').'</h3>
		<div style="margin-left:2%;">
			<b>'.__("Follow these steps to view your transactions:",'wp-otp-verification').'</b>
			<ol>
				<li>'.__("Click on the button below.",'wp-otp-verification').'</li>
				<li>'.__("Login using the credentials you used to register for this plugin.",'wp-otp-verification').'</li>
				<li>'.__("You will be presented with <i><b>View Transactions</b></i> page.",'wp-otp-verification').'</li>
				<li>'.__("From this page you can track your remaining transactions",'wp-otp-verification').'</li>
			</ol>
			<div style="margin-top:2%;text-align:center">
				<input type="button" title="'.__("Need to be registered for this option to be available",'wp-otp-verification').'" value="'.__("View Transactions",'wp-otp-verification').'" onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/viewtransactions\');" class="button button-primary button-large" style="margin-right: 3%;">
			</div>
		</div>
		<form id="showExtraSettings" action="'.MoConstants::HOSTNAME.'/moas/login" target="_blank" method="post">
	       <input type="hidden" id="extraSettingsUsername" name="username" value="'.$email.'" />
	       <input type="hidden" id="extraSettingsRedirectURL" name="redirectUrl" value="" />
	       <input type="hidden" id="" name="requestOrigin" value="'.$plan_type.'" />
		</form>
		<form id="mo_ln_form" style="display:none;" action="" method="post">
			<input type="hidden" name="option" value="check_mo_ln" />
		</form>
		<br/>
	</div>
</div>';