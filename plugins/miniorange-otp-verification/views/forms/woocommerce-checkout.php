<?php

echo' 	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="wc_checkout" data-toggle="wc_checkout_options" class="app_enable" name="mo_customer_validation_wc_checkout_enable" value="1"
						'.$wc_checkout.' /><strong>Woocommerce '. __( "Checkout Form",'wp-otp-verification') . '</strong>';

				get_plugin_form_link(MoConstants::WC_FORM_LINK);

echo'			<div class="mo_registration_help_desc" '.$wc_checkout_hidden.' id="wc_checkout_options">
				<b>'. __( "Choose between Phone or Email Verification",'wp-otp-verification').'</b>
				<p><input type="radio" '.$disabled.' id="wc_checkout_phone" class="app_enable" name="mo_customer_validation_wc_checkout_type" value="'.$wc_type_phone.'"
						'.($wc_checkout_enable_type == $wc_type_phone ? "checked" : "" ).' />
							<strong>'. __( "Enable Phone Verification",'wp-otp-verification').'</strong>
						</p>
				<p><input type="radio" '.$disabled.' id="wc_checkout_email" class="app_enable" name="mo_customer_validation_wc_checkout_type" value="'.$wc_type_email.'"
							'.($wc_checkout_enable_type == $wc_type_email ? "checked" : "" ).' />
								<strong>'. __( "Enable Email Verification",'wp-otp-verification').'</strong>
							</p>
							<p style="margin-left:2%;">
							<input type="checkbox" '.$disabled.' '.$guest_checkout.' class="app_enable" name="mo_customer_validation_wc_checkout_guest" value="1" ><b>'. __( "Enable Verification only for Guest Checkout.",'wp-otp-verification').'</b><br/>
							<div style="margin-left:4%;"><i>'. __( "Verify customer's phone number or email address only when he is not logged in during checkout ( is a guest user ).",'wp-otp-verification').'</i></div>
				<p>
				<p style="margin-left:2%;">
					<input type="checkbox" '.$disabled.' '.$checkout_button .' class="app_enable" name="mo_customer_validation_wc_checkout_button" value="1" type="checkbox"><b>'. __( "Show verification button instead of link on WooCommerce Checkout Page.",'wp-otp-verification').'</b><br/>
				</p>
				<p style="margin-left:2%;">
					<input type="checkbox" '.$disabled.' '.$checkout_popup.' class="app_enable" name="mo_customer_validation_wc_checkout_popup" value="1" type="checkbox"><b>'. __( "Show a popup for validating OTP.",'wp-otp-verification').'</b><br/>
				</p>
				<p style="margin-left:2%;">
					<b><label for="wc_payment" style="vertical-align:top;">Select the PaymentPlans that you wish to enable OTP Verification for :</label> </b>
				';

					get_wc_payment_dropdown($disabled,$checkout_payment_plans);

echo			'</p>
			</div>
		</div>';