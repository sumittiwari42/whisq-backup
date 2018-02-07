<?php

	if(! defined( 'ABSPATH' )) exit;

	//Include all required files for plugin to work.
	includeFile('/objects');
	require_once 'includes/lib/encryption.php';	
	includeFile('/helper');
	includeFile('/handler');
	require_once 'views/common-elements.php';

	global $phoneLogic,$emailLogic;
	$phoneLogic = new PhoneLogic();
	$emailLogic = new EmailLogic();
	define('MOV_VERSION', '3.2.34');
	define('MOV_DIR', plugin_dir_path(__FILE__));
	define('MOV_URL', plugin_dir_url(__FILE__));
	define('MOV_CSS_URL', MOV_URL . 'includes/css/mo_customer_validation_style.min.css?version='.MOV_VERSION);
	define('MO_INTTELINPUT_CSS', MOV_URL.'includes/css/intlTelInput.css?version='.MOV_VERSION);
	define('MOV_JS_URL', MOV_URL . 'includes/js/settings.min.js?version='.MOV_VERSION);
	define('VALIDATION_JS_URL', MOV_URL . 'includes/js/formValidation.min.js?version='.MOV_VERSION);
	define('MO_INTTELINPUT_JS', MOV_URL.'includes/js/intlTelInput.min.js?version='.MOV_VERSION);
	define('MO_DROPDOWN_JS', MOV_URL.'includes/js/dropdown.min.js?version='.MOV_VERSION);
	define('MOV_LOADER_URL', MOV_URL . 'includes/images/loader.gif');
	define('MOV_LOGO_URL', MOV_URL . 'includes/images/logo.png');

	function includeFile($folder){
		foreach (scandir(dirname(__FILE__).$folder) as $filename) {
		    $path = dirname(__FILE__) . $folder . '/' . $filename;
		    if (is_file($path)) {
		        require_once $path;
		    }elseif(is_dir($path) && $filename!="" && $filename!="." && $filename!=".."){
		    	includeFile($folder . '/' . $filename);
		    }
		}
	}
