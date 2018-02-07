<?php

$form_action 	  	= MoConstants::HOSTNAME.'/moas/login';
$redirect_url	  	= MoConstants::HOSTNAME .'/moas/initializepayment';
$free_plan_name 	= 'Free';
$basic_plan_name 	= 'Your Gateway';
$premium_plan_name 	= 'miniOrange Gateway';
$free_plan_price	= 'Free';
$basic_plan_price 	= '$99 - One Time Payment';
$premium_plan_price	= '$0 - One Time Payment';
$width 				= $plan ? "63%" : "95%";
$vl 				= MoUtility::mclv();

$free_plan_features =array(
		"Email Address Verifications",
		"Phone Verifications",
		"Custom Email Template",
		"Custom SMS Template",
		"",
		"Block Email Domains",
		"Block SMS numbers",
		"Send Custom SMS Messages",
		"Country Code Dropdown for your form",
		"",
		"",
		""
);

$basic_plan_features =array(
		"Email Address Verifications",
		"Phone Verifications",
		"Custom Email Template ",
		"Custom SMS Template",
		"Custom SMS/SMTP Gateway",
		"Block Email Domains",
		"Block SMS numbers",
		"Send Custom SMS Messages",
		"Country Code Dropdown for your form",
		"",
		"",
		"Custom Integration/Work***"
);

$premium_plan_features =array(
		"Email Address Verifications",
		"Phone Verifications",
		"Custom Email Template ",
		"Custom SMS Template",
		"Custom SMS/SMTP Gateway",
		"Block Email Domains",
		"Block SMS numbers",
		"Send Custom SMS Messages",
		"Country Code Dropdown for your form",
		"Custom OTP Length",
		"Custom OTP Validity Time",
		"Custom Integration/Work***"
);

include MOV_DIR . 'views/pricing.php';