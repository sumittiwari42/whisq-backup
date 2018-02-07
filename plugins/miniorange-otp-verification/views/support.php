<?php

echo'	<div class="mo_registration_support_layout">
			<h3>'.__("Support",'wp-otp-verification').'</h3>
			<p>'.__("Need any help? Just send us a query so we can help you.",'wp-otp-verification').'</p>
				<form name="f" method="post" action="">
					<input type="hidden" name="option" value="mo_validation_contact_us_query_option"/>
					<table class="mo_registration_settings_table">
						<tr><td>
							<input type="email" class="mo_registration_table_textbox" id="query_email" name="query_email" value="'.$email.'" 
								placeholder="'.__("Enter your Email",'wp-otp-verification').'" required />
							</td>
						</tr>
						<tr><td>
							<input type="text" class="mo_registration_table_textbox" name="query_phone" id="query_phone" value="'.$phone.'" 
								placeholder="'.__("Enter your phone",'wp-otp-verification').'"/>
							</td>
						</tr>
						<tr>
							<td>
								<textarea id="query" name="query" class="mo_registration_settings_textarea" style="resize: vertical;width:100%" 
									cols="52" rows="7" onkeyup="mo_registration_valid_query(this)" onblur="mo_registration_valid_query(this)" 
									onkeypress="mo_registration_valid_query(this)" 
									placeholder="'.__("Write your query here",'wp-otp-verification').'"></textarea>
							</td>
						</tr>
					</table>
					<input type="submit" name="send_query" id="send_query" value="'.__("Submit Query",'wp-otp-verification').'" 
						style="margin-bottom:3%;" class="button button-primary button-large" />
				</form>
				<br />			
		</div>

		<script>
			function moSharingSizeValidate(e){
				var t=parseInt(e.value.trim());t>60?e.value=60:10>t&&(e.value=10)
			}
			function moSharingSpaceValidate(e){
				var t=parseInt(e.value.trim());t>50?e.value=50:0>t&&(e.value=0)
			}
			function moLoginSizeValidate(e){
				var t=parseInt(e.value.trim());t>60?e.value=60:20>t&&(e.value=20)
			}
			function moLoginSpaceValidate(e){
				var t=parseInt(e.value.trim());t>60?e.value=60:0>t&&(e.value=0)
			}
			function moLoginWidthValidate(e){
				var t=parseInt(e.value.trim());t>1000?e.value=1000:140>t&&(e.value=140)
			}
			function moLoginHeightValidate(e){
				var t=parseInt(e.value.trim());t>50?e.value=50:35>t&&(e.value=35)
			}
		</script>';