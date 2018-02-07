<?php

//FormCraft form
$fcpremium_enabled		   = get_option('mo_customer_validation_formcraft_premium_enable') ? "checked" : "";
$fcpremium_hidden		   = $fcpremium_enabled== "checked" ? "" : "hidden";
$fcpremium_enabled_type    = $fcpremium_enabled== "checked" ? get_option('mo_customer_validation_formcraft_premium_enable_type') : "";
$fcpremium_list 		   = admin_url().'admin.php?page=formcraft_admin';
$fcpremium_otp_enabled     = $fcpremium_enabled== "checked" ? maybe_unserialize(get_option('mo_customer_validation_fcpremium_otp_enabled')) : "";

$fcpremium_type_phone 	   = FormCraftPremiumForm::TYPE_PHONE;
$fcpremium_type_email 	   = FormCraftPremiumForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/formcraft-premium.php';

function get_formcraft_premium_form_list($fc_premium_otp_enabled,$disabled,$key)
{
	$keyunter = 0;
	if(!MoUtility::isBlank($fc_premium_otp_enabled))
	{
		foreach ($fc_premium_otp_enabled as $form_id=>$form) 
		{
			echo '<div id="fcp_row'.$key.'_'.$keyunter.'">
					'.__( "Form ID", 'wp-otp-verification').': <input class="field_data" id="fcpremium_'.$keyunter.'" name="fcpremium[form][]" type="text" value="'.$form_id.'">&nbsp;';
			echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.__( "Email Field Label", 'wp-otp-verification').': <input class="field_data" id="fcpremium_email_'.$key.'_'.$keyunter.'" name="fcpremium[emailkey][]" type="text" value="'.$form['email_label'].'"></span>';
			echo '<span '.($key==1 ? 'hidden' : '' ).'>'.__( "Phone Field Label", 'wp-otp-verification').': <input class="field_data" id="fcpremium_phone_'.$key.'_'.$keyunter.'" name="fcpremium[phonekey][]" type="text" value="'.$form['phone_label'].'"></span>';
			echo '<span>&nbsp; '.__( "Verification Field Label", 'wp-otp-verification').': <input class="field_data" id="fcpremium_verify_'.$key.'_'.$keyunter.'" name="fcpremium[verifyKey][]" type="text" value="'.$form['verify_label'].'"></span>';
			echo '</div>';
			$keyunter+=1;
		}
	}
	else
	{
		echo '<div id="fcp_row'.$key.'_0"> 
			'.__( "Form ID", 'wp-otp-verification').': <input id="fcpremium_'.$key.'_0" class="field_data"  name="fcpremium[form][]" type="text" value="">&nbsp;';
		echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.__( "Email Field Label", 'wp-otp-verification').': <input id="fcpremium_email_'.$key.'_0" class="field_data" name="fcpremium[emailkey][]" type="text" value=""></span>';
		echo '<span '.($key==1 ? 'hidden' : '' ).'>'.__( "Phone Field Label", 'wp-otp-verification').': <input id="fcpremium_phone_'.$key.'_0" class="field_data"  name="fcpremium[phonekey][]" type="text" value=""></span>';
		echo '<span>&nbsp; '.__( "Verification Field Label", 'wp-otp-verification').': <input class="field_data" id="fcpremium_verify_'.$key.'_0" name="fcpremium[verifyKey][]" type="text" value=""></span>';
		echo '</div>';
	}
	$result['counter']	 = $keyunter;
	return $result;
}