<?php

echo'	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="simplr_default" data-toggle="simplr_default_options" class="app_enable" name="mo_customer_validation_simplr_default_enable" value="1"
				'.$simplr_enabled.' /><strong>Simplr User '.__( "Registration Form Plus", 'wp-otp-verification').'</strong>';

					get_plugin_form_link(MoConstants::SIMPLR_FORM_LINK);

echo'			<div class="mo_registration_help_desc" '.$simplr_hidden.' id="simplr_default_options">
					<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
						<p><input type="radio" '.$disabled.' data-toggle="simplr_phone_instruction" id="simplr_phone" class="form_options app_enable" name="mo_customer_validation_simplr_enable_type" value="'.$simplr_type_phone.'"
							'.( $simplr_enabled_type == $simplr_type_phone ? "checked" : "" ).' />
								<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>';

echo'						<div '.($simplr_enabled_type!= $simplr_type_phone ? "hidden" : "").' id="simplr_phone_instruction" class="mo_registration_help_desc">
								'. __( "Follow the following steps to enable Phone Verification",'wp-otp-verification').':
								<ol>
									<li><a href="'.$simplr_fields_page.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of fields",'wp-otp-verification').'</li>
									<li>'. __( "Add a new Phone Field by clicking the <b>Add Field</b> button.",'wp-otp-verification').'</li>
									<li>'. __( "Give the <b>Field Name</b> and <b>Field Key</b> for the new field. Remember the Field Key as you will need it later.",'wp-otp-verification').'</li>
									<li>'. __( "Click on <b>Add Field</b> button at the bottom of the page to save your new field.",'wp-otp-verification').'</li>
									<li><a href="'.$page_list.'" target="_blank	">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of pages",'wp-otp-verification').'</li>
									<li>'. __( "Click on the <b>Edit</b> link of your page to modify it.",'wp-otp-verification').'</li>
									<li>'. __( "In the ShortCode add the following attribute",'wp-otp-verification').': <b>fields="{Field Key you provided in Step 2}"</b>. '. __( "If you already have the fields attribute defined then just add the new field key to the list.",'wp-otp-verification').'</li>
									<li>'. __( "Click on <b>update</b> to save your page.",'wp-otp-verification').'</li>
									<li>'. __( "Enter the Field Key of the phone field",'wp-otp-verification').':<input class="mo_registration_table_textbox" id="simplr_phone_field_key1" name="simplr_phone_field_key" type="text" value="'.$simplr_field_key.'"></li>
								</ol>
							</div>
							</p>
							<p><input type="radio" '.$disabled.' id="simplr_email" class="form_options app_enable" name="mo_customer_validation_simplr_enable_type" value="'.$simplr_type_email.'"
									'.( $simplr_enabled_type == $simplr_type_email ? "checked" : "").' />
									<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
							</p>
							<p><input type="radio" '.$disabled.' data-toggle="simplr_both_instruction" id="simplr_both" class="form_options app_enable" name="mo_customer_validation_simplr_enable_type" value="'.$simplr_type_both.'"
									'.( $simplr_enabled_type == $simplr_type_both ? "checked" : "").' />
									<strong>'. __( "Let the user choose",'wp-otp-verification').'</strong>';

									mo_draw_tooltip(MoMessages::showMessage('INFO_HEADER'),MoMessages::showMessage('ENABLE_BOTH_BODY'));

echo'							<div '.($simplr_enabled_type != $simplr_type_both ? "hidden" : "").' id="simplr_both_instruction" class="mo_registration_help_desc">
									'. __( "Follow the following steps to enable Email and Phone Verification",'wp-otp-verification').':
									<ol>
										<li><a href="'.$simplr_fields_page.'" target="_blank">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of fields",'wp-otp-verification').'
										<li>'. __( "Add a new Phone Field by clicking the <b>Add Field</b> button.",'wp-otp-verification').'</li>
										<li>'. __( "Give the <b>Field Name</b> and <b>Field Key</b> for the new field. Remember the Field Key as you will need it later.",'wp-otp-verification').'</li>
										<li>'. __( "Click on <b>Add Field</b> button at the bottom of the page to save your new field.",'wp-otp-verification').'</li>
										<li><a href="'.$page_list.'" target="_blank	">'. __( "Click Here",'wp-otp-verification').'</a> '. __( " to see your list of pages",'wp-otp-verification').'</li>
										<li>'. __( "Click on the <b>Edit</b> link of your page to modify it.",'wp-otp-verification').'</li>
										<li>'. __( "In the ShortCode add the following attribute",'wp-otp-verification').': <b>fields="{Field Key you provided in Step 2}"</b>. '. __( "If you already have the fields attribute defined then just add the new field key to the list.",'wp-otp-verification').'</li>
										<li>'. __( "Click on <b>update</b> to save your page.",'wp-otp-verification').'</li>
										<li>'. __( "Enter the Field Key of the phone field",'wp-otp-verification').': <input class="mo_registration_table_textbox" id="simplr_phone_field_key2" name="simplr_phone_field_key" type="text" value="'.$simplr_field_key.'"></li>
									</ol>
								</div>
							</p>
						</div>
					</div>';