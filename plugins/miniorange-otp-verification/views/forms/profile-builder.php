<?php

echo' 	<div class="mo_otp_form"><input type="checkbox" '.$disabled.' id="pb_default" class="app_enable" name="mo_customer_validation_pb_default_enable" value="1"
			'.$pb_enabled.' /><strong>Profile Builder '. __( "Registration Form",'wp-otp-verification').'</strong>';

				get_plugin_form_link(MoConstants::PB_FORM_LINK);

echo' 	</div>';