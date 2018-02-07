<?php

echo'		<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="bbp_default" class="app_enable" data-toggle="bbp_default_options" name="mo_customer_validation_bbp_default_enable" value="1"
				'.$bbp_enabled.' /><strong>BuddyPress '. __( "Registration Form",'wp-otp-verification').'</strong>';

					get_plugin_form_link(MoConstants::BBP_FORM_LINK);

echo'			<div class="mo_registration_help_desc" '.$bbp_hidden.' id="bbp_default_options">
					<p><input type="checkbox" '.$disabled.' class="form_options" '.$automatic_activation.' id="bbp_disable_activation_link" 
						name="mo_customer_validation_bbp_disable_activation" value="1"/> 
						&nbsp;<strong>'. __( "Automatically activate users after verification",'wp-otp-verification').'</strong><br/>
						<i>'. __( "( No activation email would be sent after verification )",'wp-otp-verification').'</i></p>
					<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
					<p><input type="radio" '.$disabled.' data-toggle="bbp_phone_instructions" id="bbp_phone" class="form_options app_enable" 
						name="mo_customer_validation_bbp_enable_type" value="'.$bbp_type_phone.'"
							'.( $bbp_enable_type == $bbp_type_phone ? "checked" : "").' />
								<strong>'. __( "Enable Phone verification",'wp-otp-verification').'</strong>

						<div '.($bbp_enable_type != $bbp_type_phone ? "hidden" : "").' id="bbp_phone_instructions" 
							class="mo_registration_help_desc">'. __( "Follow the following steps to enable Phone Verification"
								,'wp-otp-verification').':
							<ol>
								<li><a href="'.$bbp_fields.'" target="_blank">'. __( "Click here",'wp-otp-verification').'</a> '. __( " to see your list of fields." ,'wp-otp-verification').'</li>
								<li>'. __( "Add a new Phone Field by clicking the <b>Add New Field</b> button.",'wp-otp-verification').'</li>
								<li>'. __( "Give the <b>Field Name</b> and <b>Description</b> for the new field. Remember the Field Name as you will 
									need it later.",'wp-otp-verification').'</li>
								<li>'. __( "Select the field <b>type</b> from the select box. 
									Choose <b>Text Field</b>.",'wp-otp-verification').'</li>
								<li>'. __( "Select the field <b>requirement</b> from the select box to the right.",'wp-otp-verification').'</li>
								<li>'. __( "Click on <b>Save</b> button to save your new field.",'wp-otp-verification').'</li>
								<li>'. __( "Enter the Name of the phone field",'wp-otp-verification').':
									<input class="mo_registration_table_textbox" id="bbp_phone_field_key" name="bbp_phone_field_key" type="text" 
									value="'.$bbp_field_key.'"></li>
							</ol>
						</div>
					</p>
					<p><input type="radio" '.$disabled.' id="bbp_email" class="form_options app_enable" 
						name="mo_customer_validation_bbp_enable_type" value="'.$bbp_type_email.'"
						'.( $bbp_enable_type == $bbp_type_email? "checked" : "" ).' />
						<strong>'. __( "Enable Email verification",'wp-otp-verification').'</strong>
					</p>
					<p><input type="radio" '.$disabled.' data-toggle="bbp_both_instructions" id="bbp_both" class="form_options app_enable" 
						name="mo_customer_validation_bbp_enable_type" value="'.$bbp_type_both.'"
							'.( $bbp_enable_type == $bbp_type_both ? "checked" : "").' />
							<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

						mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'				<div '.($bbp_enable_type != $bbp_type_both ? "hidden" : "").' id="bbp_both_instructions" class="mo_registration_help_desc">
						'. __( "Follow the following steps to enable Email and Phone Verification",'wp-otp-verification').':
						<ol>
							<li><a href="'.$bbp_fields.'" target="_blank">'. __( "Click here",'wp-otp-verification').'</a> '. __( " to see your list of fields.",'wp-otp-verification').'</li>
							<li>'. __( "Add a new Phone Field by clicking the <b>Add New Field</b> button.",'wp-otp-verification').'</li>
							<li>'. __( "Give the <b>Field Name</b> and <b>Description</b> for the new field. Remember the Field Name as you 
										will need it later.",'wp-otp-verification').'</li>
							<li>'. __( "Select the field <b>type</b> from the select box. Choose <b>Text Field</b>.",'wp-otp-verification').'</li>
							<li>'. __( "Select the field <b>requirement</b> from the select box to the right.",'wp-otp-verification').'</li>
							<li>'. __( "Click on <b>Save</b> button to save your new field.",'wp-otp-verification').'</li>
							<li>'. __( "Enter the Name of the phone field",'wp-otp-verification').':
								<input class="mo_registration_table_textbox" id="bbp_phone_field_key1" name="bbp_phone_field_key" 
									type="text" value="'.$bbp_field_key.'"></li>
						</ol>
					</div>
					</p>
				</div>
			</div>';

