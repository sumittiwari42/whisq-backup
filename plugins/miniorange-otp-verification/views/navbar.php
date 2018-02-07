<?php

echo'	<div class="wrap">
			<div><img style="float:left;" src="'.MOV_LOGO_URL.'"></div>
			<h1>
				'.__("OTP Verification",'wp-otp-verification').'
				<a class="add-new-h2" href="'.$profile_url.'">'.__("Account",'wp-otp-verification').'</a>
				<a class="add-new-h2" href="'.$help_url.'">'.__("Troubleshooting",'wp-otp-verification').'</a>
				<a class="add-new-h2" href="'.$license_url.'">'.__("License",'wp-otp-verification').'</a>
			</h1>	
		</div>';

echo'	<div id="tab">
			<h2 class="nav-tab-wrapper">';

echo '			<a class="nav-tab '.($active_tab == 'mosettings' ? 'nav-tab-active' : '').'" href="'.$settings		.'">
																						'.__("Forms",'wp-otp-verification').'</a>
				<a class="nav-tab '.($active_tab == 'otpsettings'? 'nav-tab-active' : '').'" href="'.$otpsettings	.'">
																						'.__("OTP Settings",'wp-otp-verification').'</a>
				<a class="nav-tab '.($active_tab == 'config'   	 ? 'nav-tab-active' : '').'" href="'.$config		.'">
																						'.__("SMS/Email Templates",'wp-otp-verification').'</a>
				<a class="nav-tab '.($active_tab == 'messages' 	 ? 'nav-tab-active' : '').'" href="'.$messages		.'">
																						'.__("Messages",'wp-otp-verification').'</a>';

				do_action('mo_otp_verification_nav_bar_after' , $active_tab);

echo'			
				<a class="nav-tab '.($active_tab == 'custom'   	 ? 'nav-tab-active' : '').'" href="'.$custom.'">
																						'.__("Send Custom Message",'wp-otp-verification').'</a>

				<a class="nav-tab '.($active_tab == 'pricing' 	 ? 'nav-tab-active' : '').'" href="'.$license_url	.'">
																						'.__("Licensing Tab",'wp-otp-verification').'</a>

			</h2>
		</div>';