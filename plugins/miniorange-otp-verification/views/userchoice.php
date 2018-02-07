<?php

echo'	<html>
					<head>
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="viewport" content="width=device-width, initial-scale=1">
						<link rel="stylesheet" type="text/css" href="' . MOV_CSS_URL .'" />
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
					</head>
					<body>
						<div class="mo-modal-backdrop">
							<div class="mo_customer_validation-modal" tabindex="-1" role="dialog" id="mo_site_otp_choice_form">
								<div class="mo_customer_validation-modal-backdrop"></div>
								<div class="mo_customer_validation-modal-dialog mo_customer_validation-modal-md">
									<div class="login mo_customer_validation-modal-content">
										<div class="mo_customer_validation-modal-header">
											<b>'.__("Select Verification Type",'wp-otp-verification').'</b>
											<a class="close" href="#" onclick="mo_validation_goback();" >
												'. __( '&larr; Go Back' ,'wp-otp-verification').'</a>
										</div>
										<div class="mo_customer_validation-modal-body center">
											<div>'.__($message,'wp-otp-verification').'</div><br /> ';
											if(!MoUtility::isBlank($user_email) || !MoUtility::isBlank($phone_number))
											{
		echo'									<div class="mo_customer_validation-login-container">
													<form id="mo_validate_form" name="f" method="post" action="">
														<input id="miniorange-validate-otp-choice-form" type="hidden" 
															name="option" value="miniorange-validate-otp-choice-form" />
														<input type="radio" checked name="mo_customer_validation_otp_choice" 
															value="user_email_verification" />
															'.__("Email Verification",'wp-otp-verification').'<br>
														<input type="radio" name="mo_customer_validation_otp_choice" 
															value="user_phone_verification" />
															'.__("Phone Verification",'wp-otp-verification').'<br>
														<br /><input type="submit" name="miniorange_otp_token_user_choice" 
															id="miniorange_otp_token_user_choice" class="miniorange_otp_token_submit"  
															value="'.__("Send OTP",'wp-otp-verification').'" />';
														extra_post_data();
		echo'										</form>
												</div>';
											}
		echo'							</div>
									</div>
								</div>
							</div>
						</div>
						<form name="f" method="post" action="" id="validation_goBack_form">
							<input id="validation_goBack" name="option" value="validation_goBack" type="hidden"></input>
						</form>
						<style> .mo_customer_validation-modal{ display: block !important; } </style>
						<script>	
							function mo_validation_goback(){
								document.getElementById("validation_goBack_form").submit();
							}
						</script>
					</body>
			    </html>';