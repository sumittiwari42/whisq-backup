<?php
/* The file contains all of the functions which make changes to the OTP tables */

/* Adds a single new order to the OTP database */
function Add_EWD_OTP_Order($Order_Name, $Order_Number, $Order_Email, $Order_Status, $Order_External_Status, $Order_Location, $Order_Notes_Public, $Order_Notes_Private, $Order_Display, $Order_Status_Updated, $Customer_ID, $Sales_Rep_ID, $Order_Payment_Price, $Order_Payment_Completed, $Order_PayPal_Receipt_Number, $Order_Internal_Status, $WooCommerce_ID = 0, $Zendesk_ID = 0) {
	global $wpdb;
	global $EWD_OTP_orders_table_name, $EWD_OTP_order_statuses_table_name, $EWD_OTP_fields_table_name, $EWD_OTP_fields_meta_table_name, $Order_ID;
	
	$wpdb->insert( $EWD_OTP_orders_table_name, 
		array( 'Order_Name' => $Order_Name,
			'Order_Number' => $Order_Number,
			'Order_Status' => $Order_Status,
			'Order_External_Status' => $Order_External_Status,
			'Order_Location' => $Order_Location,
			'Order_Notes_Public' => $Order_Notes_Public,
			'Order_Notes_Private' => $Order_Notes_Private,
			'Order_Email' => $Order_Email,
			'Order_Display' => $Order_Display,
			'Customer_ID' => $Customer_ID,
			'Sales_Rep_ID' => $Sales_Rep_ID,
			'Order_Payment_Price' => $Order_Payment_Price,
			'Order_Payment_Completed' => $Order_Payment_Completed,
			'Order_PayPal_Receipt_Number' => $Order_PayPal_Receipt_Number,
			'WooCommerce_ID' => $WooCommerce_ID,
			'Zendesk_ID' => $Zendesk_ID,
			'Order_Status_Updated' => $Order_Status_Updated)
	);
	
	$Order_ID = $wpdb->insert_id;
	
	$wpdb->insert( $EWD_OTP_order_statuses_table_name, 
		array( 'Order_ID' => $Order_ID,
			'Order_Status' => $Order_Status,
			'Order_Location' => $Order_Location,
			'Order_Internal_Status' => $Order_Internal_Status,
			'Order_Status_Created' => $Order_Status_Updated)
	);
					 
	//Add the custom fields to the meta table
	$Fields = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Slug, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Orders'");
	if (is_array($Fields)) {
		foreach ($Fields as $Field) {
			if (isset($_REQUEST[$Field->Field_Slug]) or isset($_FILES[$Field->Field_Slug])) {
				// If it's a file, pass back to Prepare_Data_For_Insertion.php to upload the file and get the name
				if ($Field->Field_Type == "file" or $Field->Field_Type == "picture") {
					$File_Upload_Return = EWD_OTP_Handle_File_Upload($Field->Field_Slug);
					if ($File_Upload_Return['Success'] == "No") {return $File_Upload_Return['Data'];}
					elseif ($File_Upload_Return['Success'] == "N/A") {$NoFile = "Yes";}
					else {$Value = $File_Upload_Return['Data'];}
				}
				else {
					$Value = trim($_REQUEST[$Field->Field_Slug]);
					$Options = explode(",", $Field->Field_Values);
					if (sizeOf($Options) > 0 and $Options[0] != "") {
						array_walk($Options, create_function('&$val', '$val = trim($val);'));
						$InArray = in_array($Value, $Options);
					}
				}		
				if (!isset($InArray) or $InArray) {
					if ($NoFile != "Yes") {
						$wpdb->insert($EWD_OTP_fields_meta_table_name,
						array( 'Field_ID' => $Field->Field_ID,
							'Order_ID' => $Order_ID,
							'Meta_Value' => $Value)
						);
					}
				}
				elseif ($InArray == false) {$CustomFieldError = __(" One or more custom field values were incorrect.", 'order-tracking');}
				unset($InArray);
				unset($NoFile);
			}
		}	
	}
		
	$update = __("Order has been successfully created.", 'order-tracking');
	return $update;
}

/* Edits a single order with a given ID in the OTP database */
function Edit_EWD_OTP_Order($Order_ID, $Order_Name, $Order_Number, $Order_Email, $Order_Status, $Order_External_Status, $Order_Location, $Order_Notes_Public, $Order_Notes_Private, $Order_Display, $Order_Status_Updated, $Customer_ID, $Sales_Rep_ID, $Order_Payment_Price, $Order_Payment_Completed, $Order_PayPal_Receipt_Number, $Order_Internal_Status) {
	global $wpdb;
	global $EWD_OTP_orders_table_name, $EWD_OTP_order_statuses_table_name, $EWD_OTP_fields_table_name, $EWD_OTP_fields_meta_table_name;
	
	$wpdb->update( $EWD_OTP_orders_table_name, 
		array( 'Order_Name' => $Order_Name,
			'Order_Number' => $Order_Number,
			'Order_Status' => $Order_Status,
			'Order_External_Status' => $Order_External_Status,
			'Order_Location' => $Order_Location,
			'Order_Notes_Public' => $Order_Notes_Public,
			'Order_Notes_Private' => $Order_Notes_Private,
			'Order_Email' => $Order_Email,
			'Order_Display' => $Order_Display,
			'Customer_ID' => $Customer_ID,
			'Sales_Rep_ID' => $Sales_Rep_ID,
			'Order_Payment_Price' => $Order_Payment_Price,
			'Order_Payment_Completed' => $Order_Payment_Completed,
			'Order_PayPal_Receipt_Number' => $Order_PayPal_Receipt_Number,
			'Order_Status_Updated' => $Order_Status_Updated),
		array( 'Order_ID' => $Order_ID)
	);
	
	$Status = $wpdb->get_row($wpdb->prepare("SELECT Order_Status, Order_Location FROM $EWD_OTP_order_statuses_table_name WHERE Order_ID='%d' ORDER BY Order_Status_Created DESC", $Order_ID));
	if ($Status->Order_Location != $Order_Location or $Status->Order_Status != $Order_Status) {
		$wpdb->insert( $EWD_OTP_order_statuses_table_name, 
			array( 'Order_ID' => $Order_ID,
				'Order_Status' => $Order_Status,
				'Order_Location' => $Order_Location,
				'Order_Internal_Status' => $Order_Internal_Status,
				'Order_Status_Created' => $Order_Status_Updated)
		);
	}
			 
	// Delete the custom field values for the given Order_ID
	$File_Fields = $wpdb->get_results("SELECT Field_ID FROM $EWD_OTP_fields_table_name WHERE Field_Type='file' or Field_Type='picture'and Field_Function='Orders'");
	$File_Field_IDs = "";
	foreach ($File_Fields as $File_Field) {$File_Field_IDs .= $File_Field->Field_ID . ",";}
	$Sql = "DELETE FROM $EWD_OTP_fields_meta_table_name WHERE Order_ID='" . $Order_ID . "'";
	if (strlen($File_Field_IDs) > 0) {$Sql .= " AND Field_ID NOT IN (" . substr($File_Field_IDs, 0, -1) . ")";}
	$wpdb->query($Sql);
		
	//Add the custom fields to the meta table
	$Fields = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Slug, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Orders'");
	if (is_array($Fields)) {
		foreach ($Fields as $Field) {
			if (isset($_REQUEST[$Field->Field_Slug]) or isset($_FILES[$Field->Field_Slug])) {
				// If it's a file, pass back to Prepare_Data_For_Insertion.php to upload the file and get the name
				if ($Field->Field_Type == "file" or $Field->Field_Type == "picture") {
					if ($_FILES[$Field->Field_Slug]['name'] != "") {
						$wpdb->delete($EWD_OTP_fields_meta_table_name, array('Order_ID' => $Order_ID, 'Field_ID' => $Field->Field_ID));
						$File_Upload_Return = EWD_OTP_Handle_File_Upload($Field->Field_Slug);
						if ($File_Upload_Return['Success'] == "No") {return $File_Upload_Return['Data'];}
						elseif ($File_Upload_Return['Success'] == "N/A") {$NoFile = "Yes";}
						else {$Value = $File_Upload_Return['Data'];}
					}
					else {$NoFile = "Yes";}
				}
				else {
					$Options = explode(",", $Field->Field_Values);
					if (sizeOf($Options) > 0 and $Options[0] != "") {
						array_walk($Options, create_function('&$val', '$val = trim($val);'));
						if ($Field->Field_Type == "checkbox") {
							if (is_array($_REQUEST[$Field->Field_Slug])) {
								$Value = implode(",", array_map('trim', $_REQUEST[$Field->Field_Slug]));
							}
						}
						else {
							$Value = trim($_REQUEST[$Field->Field_Slug]);
							$InArray = in_array($Value, $Options);
						}
					}
					else {
						$Value = trim($_REQUEST[$Field->Field_Slug]);
					}
				}
				if (!isset($InArray) or $InArray) {
					if (!isset($NoFile) or $NoFile != "Yes") {
						$wpdb->insert($EWD_OTP_fields_meta_table_name,
							array( 'Field_ID' => $Field->Field_ID,
								'Order_ID' => $Order_ID,
								'Meta_Value' => $Value)
						);
					}
				}
				elseif ($InArray == false) {$CustomFieldError = __(" One or more custom field values were incorrect.", 'UPCP');}
				unset($InArray);
				unset($NoFile);
			}
		}
	}
		
	$update = __("Order has been successfully edited.", 'order-tracking');
	return $update;
}

function Update_EWD_OTP_Order_Status($Order_ID, $Order_Status, $Order_Status_Updated, $Order_Internal_Status = "", $Order_External_Status = "", $Order_Location = "") {
	global $wpdb;
	global $EWD_OTP_orders_table_name, $EWD_OTP_order_statuses_table_name;
	
	if ($Order_External_Status == "" ) {$Order_External_Status = $Order_Status;}	
	
	$wpdb->update( $EWD_OTP_orders_table_name, 
		array( 'Order_Status' => $Order_Status,
			'Order_External_Status' => $Order_External_Status,
			'Order_Location' => $Order_Location,
			'Order_Status_Updated' => $Order_Status_Updated),
		array( 'Order_ID' => $Order_ID)
	);
	$wpdb->insert( $EWD_OTP_order_statuses_table_name, 
		array( 'Order_ID' => $Order_ID,
			'Order_Status' => $Order_Status,
			'Order_Location' => $Order_Location,
			'Order_Internal_Status' => $Order_Internal_Status,
			'Order_Status_Created' => $Order_Status_Updated)
	);
	$update = __("Order status has been successfully edited.", 'order-tracking');
	return $update;
}

function Delete_EWD_OTP_Order_Status($Order_Status_ID) {
	global $wpdb;
	global $EWD_OTP_order_statuses_table_name;

	$wpdb->query($wpdb->prepare("DELETE FROM $EWD_OTP_order_statuses_table_name WHERE Order_Status_ID=%d", $Order_Status_ID));

	$user_update = array("Message_Type" => "Update", "Message" => __("Order status has been successfully deleted.", 'order-tracking'));
	return $update;
}

function Hide_EWD_OTP_Order($Order_ID) {
	global $wpdb;
	global $EWD_OTP_orders_table_name, $EWD_OTP_order_statuses_table_name;
		
	$wpdb->update( $EWD_OTP_orders_table_name, 
		array( 'Order_Display' => "No"),
		array( 'Order_ID' => $Order_ID)
	);

	$update = __("Order has been successfully hidden.", 'order-tracking');
	return $update;
}

/* Deletes a single prder with a given ID in the OTP database */
function Delete_EWD_OTP_Order($Order_ID) {
	global $wpdb;
	global $EWD_OTP_orders_table_name, $EWD_OTP_order_statuses_table_name, $EWD_OTP_fields_meta_table_name;
		
	$wpdb->delete(
		$EWD_OTP_orders_table_name,
		array('Order_ID' => $Order_ID)
	);
	$wpdb->delete(
		$EWD_OTP_order_statuses_table_name,
		array('Order_ID' => $Order_ID)
	);
	$wpdb->delete(
		$EWD_OTP_fields_meta_table_name,
		array('Order_ID' => $Order_ID)
	);

	$update = __("Order has been successfully deleted.", 'order-tracking');
	$user_update = array("Message_Type" => "Update", "Message" => $update);
	return $update;
}

/* Adds multiple new orders inputted via a spreadsheet uploaded to the top form 
*  on the left-hand side of the orders' page to the OTP database */
function Add_EWD_OTP_Orders_From_Spreadsheet($Excel_File_Name) {
	global $wpdb;
	global $EWD_OTP_orders_table_name;
	global $EWD_OTP_order_statuses_table_name;
	global $EWD_OTP_fields_table_name;
	global $EWD_OTP_fields_meta_table_name;
    global $EWD_OTP_customers;

		
	$Order_Email = get_option("EWD_OTP_Order_Email");
		
	$Excel_URL = '../wp-content/plugins/order-tracking/order-sheets/' . $Excel_File_Name;
		
	// Uses the PHPExcel class to simplify the file parsing process
	include_once('../wp-content/plugins/order-tracking/PHPExcel/Classes/PHPExcel.php');
		
	// Build the workbook object out of the uploaded spredsheet
	$inputFileType = PHPExcel_IOFactory::identify($Excel_URL);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objWorkBook = $objReader->load($Excel_URL);
		
	// Create a worksheet object out of the product sheet in the workbook
	$sheet = $objWorkBook->getActiveSheet();
		
	$Allowable_Custom_Fields = array();
	//List of fields that can be accepted via upload
	$Allowed_Fields = array ("Name" => "Order_Name", "Number" => "Order_Number", "Order Status" => "Order_Status", "Location" => "Order_Location", "Display" => "Order_Display", "Notes Public" => "Order_Notes_Public", "Notes Private" => "Order_Notes_Private", "Email" => "Order_Email", "Show in Admin Table" => "Order_Display", "Sales Rep ID" => "Sales_Rep_ID", "Customer ID" => "Customer_ID");
	$Custom_Fields_From_DB = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Orders'");
	if (is_array($Custom_Fields_From_DB)) {
		foreach ($Custom_Fields_From_DB as $Custom_Field_From_DB) {
			$Allowable_Custom_Fields[$Custom_Field_From_DB->Field_Name] = $Custom_Field_From_DB->Field_Name;
			$Field_IDs[$Custom_Field_From_DB->Field_Name] = $Custom_Field_From_DB->Field_ID;
		}
	}
		
	// Get column names
	$highestColumn = $sheet->getHighestColumn();
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);	
	for ($column = 0; $column < $highestColumnIndex; $column++) {
		$Titles[$column] = trim($sheet->getCellByColumnAndRow($column, 1)->getValue());
	}

	// Make sure all columns are acceptable based on the acceptable fields above
	$Custom_Fields = array();
	foreach ($Titles as $key => $Title) {
		if ($Title != "" and !array_key_exists($Title, $Allowed_Fields) and !array_key_exists($Title, $Allowable_Custom_Fields)) {
			$Error = __("You have a column which is not recognized: ", 'order-tracking') . $Title . __(". <br>Please make sure that the column names match the order field labels exactly (without the word order).", 'order-tracking');
			$user_update = array("Message_Type" => "Error", "Message" => $Error);
			return $user_update;
		}
		if ($Title == "") {
			$Error = __("You have a blank column that has been edited.<br>Please delete that column and re-upload your spreadsheet.", 'order-tracking');
			$user_update = array("Message_Type" => "Error", "Message" => $Error);
			return $user_update;
		}
		if (array_key_exists($Title, $Allowable_Custom_Fields)) {
			$Custom_Fields[$key] = $Title;
			unset($Titles[$key]);
		}
	}
		
	// Put the spreadsheet data into a multi-dimensional array to facilitate processing
	$highestRow = $sheet->getHighestRow();
	for ($row = 2; $row <= $highestRow; $row++) {
		for ($column = 0; $column < $highestColumnIndex; $column++) {
			$Data[$row][$column] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
		}
	}

	// Creates an array of the field names which are going to be inserted into the database
	// and then turns that array into a string so that it can be used in the query
	$Fields = array();
	for ($column = 0; $column < $highestColumnIndex; $column++) {
		if ($column < sizeOf($Titles)) {
			if (!array_key_exists($column, $Custom_Fields)) {$Fields[] = $Allowed_Fields[$Titles[$column]];}
			if ($Allowed_Fields[$Titles[$column]] == "Order_Status") {$Status_Column = $column;}
			if ($Allowed_Fields[$Titles[$column]] == "Order_Location") {$Location_Column = $column;}
			if ($Allowed_Fields[$Titles[$column]] == "Order_Number") {$Number_Column = $column;}
		}
	}
	$FieldsString = implode(",", $Fields);
		
	$Date = date("Y-m-d H:i:s");

	// Create the query to insert the products one at a time into the database and then run it
	foreach ($Data as $Order) {
				
		// Create an array of the values that are being inserted for each order,
		// edit if it's a current order, otherwise add it
		foreach ($Order as $Col_Index => $Value) {
			if (!array_key_exists($Col_Index, $Custom_Fields)) {$Values[] = esc_sql($Value);}
			if (isset($Status_Column) and $Status_Column == $Col_Index) {$Status = $Value;}
			if (isset($Location_Column) and $Location_Column == $Col_Index) {$Location = $Value;}
			if (isset($Number_Column) and $Number_Column == $Col_Index) {$Number = $Value;}
			if (array_key_exists($Col_Index, $Custom_Fields)) {
				$Custom_Fields_To_Insert[$Custom_Fields[$Col_Index]] = $Value;
			}
		}
		$ValuesString = implode("','", $Values);
		if (isset($Number)) {
			$Order_ID = $wpdb->get_var($wpdb->prepare("SELECT Order_ID FROM $EWD_OTP_orders_table_name WHERE Order_Number='%s'", $Number));
		}

		if ($Order_ID != "") {
			$Order_Created = "No";
			$UpdateString = "";
			foreach ($Values as $key => $value) {$UpdateString .= $Fields[$key] . "='" . $value . "', ";}
			$wpdb->query($wpdb->prepare("UPDATE $EWD_OTP_orders_table_name SET " . $UpdateString . " Order_Status_Updated='%s' WHERE Order_ID='%d'", $Date, $Order_ID));
			$Order = $wpdb->get_row("SELECT * FROM $EWD_OTP_orders_table_name WHERE Order_ID='" . $Order_ID . "'");
		}
		else {
			$Order_Created = "Yes";
			$wpdb->query($wpdb->prepare("INSERT INTO $EWD_OTP_orders_table_name (" . $FieldsString . ", Order_Status_Updated) VALUES ('" . $ValuesString . "','%s')", $Date));
			$Order_ID = $wpdb->insert_id;
			$Order = $wpdb->get_row("SELECT * FROM $EWD_OTP_orders_table_name WHERE Order_ID='" . $Order_ID . "'");
		}
				
		if (isset($Status)) {
			if (!isset($Location)) {$Location = "";}
			$wpdb->query($wpdb->prepare("INSERT INTO $EWD_OTP_order_statuses_table_name (Order_ID, Order_Status, Order_Location, Order_Status_Created) VALUES (%d, %s, %s, %s)", $Order_ID, $Status, $Location, $Date));
		}

		if (!isset($Custom_Fields_To_Insert)) {$Custom_Fields_To_Insert = "";}
		if (is_array($Custom_Fields_To_Insert)) {
			foreach ($Custom_Fields_To_Insert as $Field => $Value) {
				$Trimmed_Field = trim($Field);
				$Field_ID = $Field_IDs[$Trimmed_Field];
				$wpdb->query($wpdb->prepare("DELETE FROM $EWD_OTP_fields_meta_table_name WHERE Field_ID=%d AND Order_ID=%d", $Field_ID, $Order_ID));
				$wpdb->query($wpdb->prepare("INSERT INTO $EWD_OTP_fields_meta_table_name (Field_ID, Order_ID, Meta_Value) VALUES (%d, %d, %s)", $Field_ID, $Order_ID, $Value));
			}
		}

		if ($Order_Created = "No") {
			if ($Order_Email == "Change" and $Order->Order_Email != "") {
				EWD_OTP_Send_Email($Order->Order_Email, $Order->Order_Number, $Order->Order_Status, $Order->Order_Notes_Public, $Order->Order_Status_Updated, $Order->Order_Name);
			}
		}
		else {
			if (($Order_Email == "Change" or $Order_Email == "Creation") and $Order->Order_Email != "") {
				EWD_OTP_Send_Email($Order->Order_Email, $Order->Order_Number, $Order->Order_Status, $Order->Order_Notes_Public, $Order->Order_Status_Update, $Order->Order_Name, "Yes");
			}
		}

		unset($Status);
		unset($Location);
		unset($Number);
		unset($Order_ID);
		unset($Values);
		unset($ValuesString);
		unset($UpdateString);
		unset($Custom_Fields_To_Insert);
		unset($Order_Created);
	}

	return __("Orders added successfully.", 'order-tracking');
}

function Update_EWD_OTP_Statuses() {
	if (isset($_POST['Statuses_Submit'])) {
		$Statuses_Array = array();
		foreach ($_POST['status'] as $key => $stat) {
			if ($stat != "") {
				$Statuses_Array_Item['Status'] = $stat;
				$Statuses_Array_Item['Percentage'] = $_POST['status_percentages'][$key];
				$Statuses_Array_Item['Message'] = stripslashes_deep(urldecode($_POST['status_messages'][$key]));
				$Statuses_Array_Item['Internal'] = stripslashes_deep(urldecode($_POST['status_internals'][$key]));
	
				if ($Statuses_Array_Item['Message'] == "") {$Statuses_Array_Item['Message'] = 'Default';}
	
				$Statuses_Array[] = $Statuses_Array_Item;
				unset($Statuses_Array_Item);
			}
		}
			
		usort($Statuses_Array, 'EWD_OTP_Status_Sort');
	
		update_option("EWD_OTP_Statuses_Array",$Statuses_Array);
			
		$update = __("Statuses have been successfully updated.", 'order-tracking');
		return $update;
	}
}

function EWD_OTP_Status_Sort($a, $b) {
    return $a['Percentage'] - $b['Percentage'];
}

function Delete_EWD_OTP_Status($Status) {
	$Statuses_Array = get_option("EWD_OTP_Statuses_Array");

	foreach ($Statuses_Array as $key => $Statuses_Array_Item) {
		if ($Statuses_Array_Item['Status'] == $Status) {unset($Statuses_Array[$key]);}
	}
		
	update_option("EWD_OTP_Statuses_Array", $Statuses_Array);

	$update = __("Status has been successfully deleted.", 'order-tracking');
	return $update;
}

function Update_EWD_OTP_Location() {
	if (isset($_POST['Locations_Submit'])) {
		$Locations_Array = array();
		foreach ($_POST['location'] as $key => $location) {
			if ($location != "") {
				$Location_Array_Item['Name'] = $location;
				$Location_Array_Item['Latitude'] = filter_var($_POST['location_latitude'][$key], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				if (strpos($_POST['location_latitude'][$key], "S") !== false) {$Location_Array_Item['Latitude'] = $Location_Array_Item['Latitude'] * -1;}
				$Location_Array_Item['Longitude'] = filter_var($_POST['location_longitude'][$key], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				if (strpos($_POST['location_longitude'][$key], "W") !== false) {$Location_Array_Item['Longitude'] = $Location_Array_Item['Longitude'] * -1;}

				$Locations_Array[] = $Location_Array_Item;
				unset($Location_Array_Item);
			}
		}
	
		update_option("EWD_OTP_Locations_Array",$Locations_Array);
		
		$update = __("Locations have been successfully updated.", 'order-tracking');
		return $update;
	}
}

function Delete_EWD_OTP_Location($Location) {
	$Locations_Array = get_option("EWD_OTP_Locations_Array");
	if (!is_array($Locations_Array)) {$Locations_Array = array();}
		
	foreach ($Locations_Array as $key => $Location_Array_Item) {
		if ($Location_Array_Item['Name'] == $Location) {
			unset($Locations_Array[$key]);
		}
	}
		
	update_option("EWD_OTP_Locations_Array",$Locations_Array);
		
	$update = __("Location has been successfully deleted.", 'order-tracking');
	return $update;
}

/* Adds a single new custom field to the EWD_OTP database */
function Add_EWD_OTP_Custom_Field($Field_Name, $Field_Slug, $Field_Type, $Field_Description, $Field_Values, $Field_Front_End_Display, $Field_Required, $Field_Equivalent, $Field_Function) {
	global $wpdb;
	global $EWD_OTP_fields_table_name;
	$Date = date("Y-m-d H:i:s");
	global $EWD_OTP_Full_Version;
		
	if ($EWD_OTP_Full_Version != "Yes") {exit();}		
	$wpdb->insert($EWD_OTP_fields_table_name,
		array( 'Field_Name' => $Field_Name,
			'Field_Slug' => $Field_Slug,
			'Field_Type' => $Field_Type,
			'Field_Description' => $Field_Description,
			'Field_Values' => $Field_Values,
			'Field_Front_End_Display' => $Field_Front_End_Display,
			'Field_Required' => $Field_Required,
			'Field_Equivalent' => $Field_Equivalent,
			'Field_Function' => $Field_Function,
			'Field_Date_Created' => $Date)
	);
	$update = __("Field has been successfully created.", 'order-tracking');
	return $update;
}

/* Edits a single custom field with a given ID in the EWD_OTP database */
function  Edit_EWD_OTP_Custom_Field($Field_ID, $Field_Name, $Field_Slug, $Field_Type, $Field_Description, $Field_Values, $Field_Front_End_Display, $Field_Required, $Field_Equivalent, $Field_Function) {
	global $wpdb;
	global $EWD_OTP_fields_table_name;
	global $EWD_OTP_Full_Version;
	
	if ($EWD_OTP_Full_Version != "Yes") {exit();}		
	$wpdb->update(
		$EWD_OTP_fields_table_name,
		array( 'Field_Name' => $Field_Name,
			'Field_Slug' => $Field_Slug,
			'Field_Type' => $Field_Type,
			'Field_Description' => $Field_Description,
			'Field_Values' => $Field_Values,
			'Field_Front_End_Display' => $Field_Front_End_Display,
			'Field_Required' => $Field_Required,
			'Field_Equivalent' => $Field_Equivalent,
			'Field_Function' => $Field_Function),
		array( 'Field_ID' => $Field_ID)
	);
	$update = __("Field has been successfully edited.", 'order-tracking');
	return $update;
}

/* Deletes a single tag with a given ID in the EWD_OTP database, and then eliminates 
*  all of the occurrences of that tag from the tagged items table.  */
function Delete_EWD_OTP_Custom_Field($Field_ID) {
	global $wpdb;
	global $EWD_OTP_fields_table_name;
	global $EWD_OTP_Full_Version;
		
	if ($EWD_OTP_Full_Version != "Yes") {exit();}		
	$wpdb->delete(
		$EWD_OTP_fields_table_name,
		array('Field_ID' => $Field_ID)
	);
					
	$update = __("Field has been successfully deleted.", 'order-tracking');
	return $update;
}

function Add_EWD_OTP_Sales_Rep($Sales_Rep_First_Name, $Sales_Rep_Last_Name, $Sales_Rep_Email, $Sales_Rep_WP_ID, $Sales_Rep_Created) {
	global $wpdb;
	global $EWD_OTP_sales_reps, $EWD_OTP_fields_table_name, $EWD_OTP_fields_meta_table_name;
		
	$wpdb->insert( $EWD_OTP_sales_reps, 
		array( 'Sales_Rep_First_Name' => $Sales_Rep_First_Name,
			'Sales_Rep_Last_Name' => $Sales_Rep_Last_Name,
			'Sales_Rep_Email' => $Sales_Rep_Email,
			'Sales_Rep_WP_ID' => $Sales_Rep_WP_ID,
			'Sales_Rep_Created' => $Sales_Rep_Created)
	);

	$Sales_Rep_ID = $wpdb->insert_id;

	//Add the custom fields to the meta table
	$Fields = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Slug, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Sales_Reps'");
	if (is_array($Fields)) {
		foreach ($Fields as $Field) {
			if (isset($_REQUEST[$Field->Field_Slug]) or isset($_FILES[$Field->Field_Slug])) {
				// If it's a file, pass back to Prepare_Data_For_Insertion.php to upload the file and get the name
				if ($Field->Field_Type == "file" or $Field->Field_Type == "picture") {
					$File_Upload_Return = EWD_OTP_Handle_File_Upload($Field->Field_Slug);
					if ($File_Upload_Return['Success'] == "No") {return $File_Upload_Return['Data'];}
					elseif ($File_Upload_Return['Success'] == "N/A") {$NoFile = "Yes";}
					else {$Value = $File_Upload_Return['Data'];}
				}
				else {
					$Value = trim($_REQUEST[$Field->Field_Slug]);
					$Options = explode(",", $Field->Field_Values);
					if (sizeOf($Options) > 0 and $Options[0] != "") {
						array_walk($Options, create_function('&$val', '$val = trim($val);'));
						$InArray = in_array($Value, $Options);
					}
				}		
				if (!isset($InArray) or $InArray) {
					if ($NoFile != "Yes") {
						$wpdb->insert($EWD_OTP_fields_meta_table_name,
						array( 'Field_ID' => $Field->Field_ID,
							'Sales_Rep_ID' => $Sales_Rep_ID,
							'Meta_Value' => $Value)
						);
					}
				}
				elseif ($InArray == false) {$CustomFieldError = __(" One or more custom field values were incorrect.", 'order-tracking');}
				unset($InArray);
				unset($NoFile);
			}
		}	
	}
		
	$update = __("Sales Rep has been successfully created.", 'order-tracking');
	return $update;
}

/* Edits a single order with a given ID in the OTP database */
function Edit_EWD_OTP_Sales_Rep($Sales_Rep_ID, $Sales_Rep_First_Name, $Sales_Rep_Last_Name, $Sales_Rep_Email, $Sales_Rep_WP_ID) {
	global $wpdb;
	global $EWD_OTP_sales_reps, $EWD_OTP_fields_table_name, $EWD_OTP_fields_meta_table_name;
		
	$wpdb->update( $EWD_OTP_sales_reps, 
		array( 'Sales_Rep_First_Name' => $Sales_Rep_First_Name,
			'Sales_Rep_Last_Name' => $Sales_Rep_Last_Name,
			'Sales_Rep_Email' => $Sales_Rep_Email,
			'Sales_Rep_WP_ID' => $Sales_Rep_WP_ID),
		array( 'Sales_Rep_ID' => $Sales_Rep_ID)
	); 

	// Delete the custom field values for the given Order_ID
	$File_Fields = $wpdb->get_results("SELECT Field_ID FROM $EWD_OTP_fields_table_name WHERE Field_Type='file' and Field_Function='Sales_Reps'");
	foreach ($File_Fields as $File_Field) {$File_Field_IDs .= $File_Field->Field_ID . ",";}
	$Sql = "DELETE FROM $EWD_OTP_fields_meta_table_name WHERE Sales_Rep_ID='" . $Sales_Rep_ID . "'";
	if (strlen($File_Field_IDs) > 0) {$Sql .= " AND Field_ID NOT IN (" . substr($File_Field_IDs, 0, -1) . ")";}
	$wpdb->query($Sql);
		
	//Add the custom fields to the meta table
	$Fields = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Slug, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Sales_Reps'");
	if (is_array($Fields)) {
		foreach ($Fields as $Field) {
			if (isset($_REQUEST[$Field->Field_Slug]) or isset($_FILES[$Field->Field_Slug])) {
				// If it's a file, pass back to Prepare_Data_For_Insertion.php to upload the file and get the name
				if ($Field->Field_Type == "file" or $Field->Field_Type == "picture") {
					if ($_FILES[$Field->Field_Slug]['name'] != "") {
						$wpdb->delete($EWD_OTP_fields_meta_table_name, array('Sales_Rep_ID' => $Sales_Rep_ID, 'Field_ID' => $Field->Field_ID));
						$File_Upload_Return = EWD_OTP_Handle_File_Upload($Field->Field_Slug);
						if ($File_Upload_Return['Success'] == "No") {return $File_Upload_Return['Data'];}
						elseif ($File_Upload_Return['Success'] == "N/A") {$NoFile = "Yes";}
						else {$Value = $File_Upload_Return['Data'];}
					}
					else {$NoFile = "Yes";}
				}
				else {
					$Value = trim($_REQUEST[$Field->Field_Slug]);
					$Options = explode(",", $Field->Field_Values);
					if (sizeOf($Options) > 0 and $Options[0] != "") {
						array_walk($Options, create_function('&$val', '$val = trim($val);'));
						$InArray = in_array($Value, $Options);
					}
				}
				if (!isset($InArray) or $InArray) {
					if ($NoFile != "Yes") {
						$wpdb->insert($EWD_OTP_fields_meta_table_name,
							array( 'Field_ID' => $Field->Field_ID,
								'Sales_Rep_ID' => $Sales_Rep_ID,
								'Meta_Value' => $Value)
						);
					}
				}
				elseif ($InArray == false) {$CustomFieldError = __(" One or more custom field values were incorrect.", 'UPCP');}
				unset($InArray);
				unset($NoFile);
			}
		}
	}
		
	$update = __("Sales Rep has been successfully edited.", 'order-tracking');
	return $update;
}

function Delete_EWD_OTP_Sales_Rep($Sales_Rep_ID) {
	global $wpdb;
	global $EWD_OTP_sales_reps, $EWD_OTP_fields_meta_table_name;
			
	$wpdb->delete(
		$EWD_OTP_sales_reps,
		array('Sales_Rep_ID' => $Sales_Rep_ID)
	);
	$wpdb->delete(
		$EWD_OTP_fields_meta_table_name,
		array('Sales_Rep_ID' => $Sales_Rep_ID)
	);			

	$update = __("Sales Rep has been successfully deleted.", 'order-tracking');
	return $update;
}

function Add_EWD_OTP_Customer($Customer_Name, $Customer_Email, $Sales_Rep_ID, $Customer_WP_ID, $Customer_FEUP_ID, $Customer_Created) {
	global $wpdb;
	global $EWD_OTP_customers, $EWD_OTP_fields_table_name, $EWD_OTP_fields_meta_table_name;
		
	$wpdb->insert( $EWD_OTP_customers, 
		array( 'Customer_Name' => $Customer_Name,
			'Customer_Email' => $Customer_Email,
			'Sales_Rep_ID' => $Sales_Rep_ID,
			'Customer_WP_ID' => $Customer_WP_ID,
			'Customer_FEUP_ID' => $Customer_FEUP_ID,
			'Customer_Created' => $Customer_Created)
	);

	$Customer_ID = $wpdb->insert_id;

	//Add the custom fields to the meta table
	$Fields = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Slug, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Customers'");
	if (is_array($Fields)) {
		foreach ($Fields as $Field) {
			if (isset($_REQUEST[$Field->Field_Slug]) or isset($_FILES[$Field->Field_Slug])) {
				// If it's a file, pass back to Prepare_Data_For_Insertion.php to upload the file and get the name
				if ($Field->Field_Type == "file" or $Field->Field_Type == "picture") {
					$File_Upload_Return = EWD_OTP_Handle_File_Upload($Field->Field_Slug);
					if ($File_Upload_Return['Success'] == "No") {return $File_Upload_Return['Data'];}
					elseif ($File_Upload_Return['Success'] == "N/A") {$NoFile = "Yes";}
					else {$Value = $File_Upload_Return['Data'];}
				}
				else {
					$Value = trim($_REQUEST[$Field->Field_Slug]);
					$Options = explode(",", $Field->Field_Values);
					if (sizeOf($Options) > 0 and $Options[0] != "") {
						array_walk($Options, create_function('&$val', '$val = trim($val);'));
						$InArray = in_array($Value, $Options);
					}
				}		
				if (!isset($InArray) or $InArray) {
					if ($NoFile != "Yes") {
						$wpdb->insert($EWD_OTP_fields_meta_table_name,
						array( 'Field_ID' => $Field->Field_ID,
							'Customer_ID' => $Customer_ID,
							'Meta_Value' => $Value)
						);
					}
				}
				elseif ($InArray == false) {$CustomFieldError = __(" One or more custom field values were incorrect.", 'order-tracking');}
				unset($InArray);
				unset($NoFile);
			}
		}	
	}
		
	$update = __("Customer has been successfully created.", 'order-tracking');
	return $update;
}

/* Edits a single order with a given ID in the OTP database */
function Edit_EWD_OTP_Customer($Customer_ID, $Customer_Name, $Customer_Email, $Sales_Rep_ID, $Customer_WP_ID, $Customer_FEUP_ID) {
	global $wpdb;
	global $EWD_OTP_customers, $EWD_OTP_fields_table_name, $EWD_OTP_fields_meta_table_name;
		
	$wpdb->update( $EWD_OTP_customers, 
		array( 'Customer_Name' => $Customer_Name,
			'Customer_Email' => $Customer_Email,
			'Sales_Rep_ID' => $Sales_Rep_ID,
			'Customer_WP_ID' => $Customer_WP_ID,
			'Customer_FEUP_ID' => $Customer_FEUP_ID),
		array( 'Customer_ID' => $Customer_ID)
	);

	// Delete the custom field values for the given Order_ID
	$File_Fields = $wpdb->get_results("SELECT Field_ID FROM $EWD_OTP_fields_table_name WHERE Field_Type='file' and Field_Function='Customers'");
	foreach ($File_Fields as $File_Field) {$File_Field_IDs .= $File_Field->Field_ID . ",";}
	$Sql = "DELETE FROM $EWD_OTP_fields_meta_table_name WHERE Customer_ID='" . $Customer_ID . "'";
	if (strlen($File_Field_IDs) > 0) {$Sql .= " AND Field_ID NOT IN (" . substr($File_Field_IDs, 0, -1) . ")";}
	$wpdb->query($Sql);
		
	//Add the custom fields to the meta table
	$Fields = $wpdb->get_results("SELECT Field_ID, Field_Name, Field_Slug, Field_Values, Field_Type FROM $EWD_OTP_fields_table_name WHERE Field_Function='Customers'");
	if (is_array($Fields)) {
		foreach ($Fields as $Field) {
			if (isset($_REQUEST[$Field->Field_Slug]) or isset($_FILES[$Field->Field_Slug])) {
				// If it's a file, pass back to Prepare_Data_For_Insertion.php to upload the file and get the name
				if ($Field->Field_Type == "file" or $Field->Field_Type == "picture") {
					if ($_FILES[$Field->Field_Slug]['name'] != "") {
						$wpdb->delete($EWD_OTP_fields_meta_table_name, array('Customer_ID' => $Customer_ID, 'Field_ID' => $Field->Field_ID));
						$File_Upload_Return = EWD_OTP_Handle_File_Upload($Field->Field_Slug);
						if ($File_Upload_Return['Success'] == "No") {return $File_Upload_Return['Data'];}
						elseif ($File_Upload_Return['Success'] == "N/A") {$NoFile = "Yes";}
						else {$Value = $File_Upload_Return['Data'];}
					}
					else {$NoFile = "Yes";}
				}
				else {
					$Value = trim($_REQUEST[$Field->Field_Slug]);
					$Options = explode(",", $Field->Field_Values);
					if (sizeOf($Options) > 0 and $Options[0] != "") {
						array_walk($Options, create_function('&$val', '$val = trim($val);'));
						$InArray = in_array($Value, $Options);
					}
				}
				if (!isset($InArray) or $InArray) {
					if ($NoFile != "Yes") {
						$wpdb->insert($EWD_OTP_fields_meta_table_name,
							array( 'Field_ID' => $Field->Field_ID,
								'Customer_ID' => $Customer_ID,
								'Meta_Value' => $Value)
						);
					}
				}
				elseif ($InArray == false) {$CustomFieldError = __(" One or more custom field values were incorrect.", 'UPCP');}
				unset($InArray);
				unset($NoFile);
			}
		}
	} 
		
	$update = __("Customer has been successfully edited.", 'order-tracking');
	return $update;
}

function Delete_EWD_OTP_Customer($Customer_ID) {
	global $wpdb;
	global $EWD_OTP_customers, $EWD_OTP_fields_meta_table_name;
			
	$wpdb->delete(
		$EWD_OTP_customers,
		array('Customer_ID' => $Customer_ID)
	);
	$wpdb->delete(
		$EWD_OTP_fields_meta_table_name,
		array('Customer_ID' => $Customer_ID)
	);	

	$update = __("Customer has been successfully deleted.", 'order-tracking');
	return $update;
}

function Update_EWD_OTP_Customer_Note($Tracking_Number, $Note) {
	global $wpdb;
	global $EWD_OTP_orders_table_name;
		
	$wpdb->update( $EWD_OTP_orders_table_name, 
		array( 'Order_Customer_Notes' => $Note),
		array( 'Order_Number' => $Tracking_Number)
	); 
		
	$update = __("Note has been successfully edited.", 'order-tracking');
	return $update;
}

function Update_EWD_OTP_Options() {
	global $EWD_OTP_Full_Version;

	$Custom_CSS = $_POST['custom_css'];
	$AJAX_Reload = $_POST['ajax_reload'];
	$New_Window = $_POST['new_window'];
	$Order_Information_Array = $_POST['order_information'];
	if (is_array($Order_Information_Array)) {$Order_Information = implode(",", $Order_Information_Array);}
	else {$Order_Information = "";}
	$Order_Email = $_POST['order_email'];
	$Email_Confirmation = $_POST['email_confirmation'];
	$Form_Instructions = $_POST['form_instructions'];
	$Timezone = $_POST['timezone'];
	$Localize_Date_Time = $_POST['localize_date_time'];
	$Access_Role = $_POST['access_role'];
	$WooCommerce_Integration = $_POST['woocommerce_integration'];
	$Display_Graphic = $_POST['display_graphic'];
	$Mobile_Stylesheet = $_POST['mobile_stylesheet'];

	$Custom_CSS = stripslashes_deep($Custom_CSS);
	$AJAX_Reload = stripslashes_deep($AJAX_Reload);
	$New_Window = stripslashes_deep($New_Window);
	$Order_Information = stripslashes_deep($Order_Information);
	$Order_Email = stripslashes_deep($Order_Email);
	$Email_Confirmation = stripslashes_deep($Email_Confirmation);
	$Form_Instructions = stripslashes_deep($Form_Instructions);
	$Timezone = stripslashes_deep($Timezone);
	$Localize_Date_Time = stripslashes_deep($Localize_Date_Time);
		
	if (isset($_POST['custom_css'])) {update_option('EWD_OTP_Custom_CSS', $Custom_CSS);}
	if (isset($_POST['ajax_reload'])) {update_option('EWD_OTP_AJAX_Reload', $AJAX_Reload);}
	if (isset($_POST['new_window'])) {update_option('EWD_OTP_New_Window', $New_Window);}
	if (isset($_POST['order_information'])) {update_option('EWD_OTP_Order_Information', $Order_Information);}
	if (isset($_POST['order_email'])) {update_option('EWD_OTP_Order_Email', $Order_Email);}
	if (isset($_POST['email_confirmation'])) {update_option("EWD_OTP_Email_Confirmation", $Email_Confirmation);}
	if (isset($_POST['form_instructions'])) {update_option('EWD_OTP_Form_Instructions', $Form_Instructions);}
	if (isset($_POST['timezone'])) {update_option('EWD_OTP_Timezone', $Timezone);}
	if (isset($_POST['localize_date_time'])) {update_option('EWD_OTP_Localize_Date_Time', $Localize_Date_Time);}
	if (isset($_POST['show_tinymce'])) {update_option('EWD_OTP_Show_TinyMCE', $_POST['show_tinymce']);}

	if (isset($_POST['statistics_days']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_Statistics_Days', $_POST['statistics_days']);}
	if (isset($_POST['access_role']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_Access_Role', $Access_Role);}
	if (isset($_POST['woocommerce_integration']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_WooCommerce_Integration', $WooCommerce_Integration);}
	if (isset($_POST['woocommerce_prefix']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_WooCommerce_Prefix', $_POST['woocommerce_prefix']);}
	if (isset($_POST['woocommerce_random_suffix']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_WooCommerce_Random_Suffix', $_POST['woocommerce_random_suffix']);}
	if (isset($_POST['display_graphic']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_Display_Graphic', $Display_Graphic);}
	if (isset($_POST['mobile_stylesheet']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_Mobile_Stylesheet', $Mobile_Stylesheet);}
	if (isset($_POST['allow_customer_downloads']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_Allow_Customer_Downloads', $_POST['allow_customer_downloads']);}
	if (isset($_POST['allow_sales_rep_downloads']) and $EWD_OTP_Full_Version == "Yes") {update_option('EWD_OTP_Allow_Sales_Rep_Downloads', $_POST['allow_sales_rep_downloads']);}

	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['allow_order_payments'])) {update_option("EWD_OTP_Allow_Order_Payments", $_POST['allow_order_payments']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['default_payment_status'])) {update_option("EWD_OTP_Default_Payment_Status", $_POST['default_payment_status']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['paypal_email_address'])) {update_option("EWD_OTP_PayPal_Email_Address", $_POST['paypal_email_address']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['pricing_currency_code'])) {update_option("EWD_OTP_Pricing_Currency_Code", $_POST['pricing_currency_code']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['thank_you_url'])) {update_option("EWD_OTP_Thank_You_URL", $_POST['thank_you_url']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['customer_notes_email'])) {update_option("EWD_OTP_Customer_Notes_Email", $_POST['customer_notes_email']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['customer_order_email'])) {update_option("EWD_OTP_Customer_Order_Email", $_POST['customer_order_email']);}

	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['zendesk_integration'])) {update_option("EWD_OTP_Zendesk_Integration", $_POST['zendesk_integration']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['zendesk_api_key'])) {update_option("EWD_OTP_Zendesk_API_Key", $_POST['zendesk_api_key']);}

	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['tracking_title_label'])) {update_option("EWD_OTP_Tracking_Title_Label", $_POST['tracking_title_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['tracking_description_label'])) {update_option("EWD_OTP_Tracking_Description_Label", $_POST['tracking_description_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['tracking_ordernumber_label'])) {update_option("EWD_OTP_Tracking_ordernumber_Label", $_POST['tracking_ordernumber_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['tracking_email_label'])) {update_option("EWD_OTP_Tracking_Email_Label", $_POST['tracking_email_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['tracking_button_label'])) {update_option("EWD_OTP_Tracking_Button_Label", $_POST['tracking_button_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_information_label'])) {update_option("EWD_OTP_Order_Information_Label", $_POST['order_information_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_number_label'])) {update_option("EWD_OTP_Order_Number_Label", $_POST['order_number_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_name_label'])) {update_option("EWD_OTP_Order_Name_Label", $_POST['order_name_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_notes_label'])) {update_option("EWD_OTP_Order_Notes_Label", $_POST['order_notes_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['customer_notes_label'])) {update_option("EWD_OTP_Customer_Notes_Label", $_POST['customer_notes_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_status_label'])) {update_option("EWD_OTP_Order_Status_Label", $_POST['order_status_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_location_label'])) {update_option("EWD_OTP_Order_Location_Label", $_POST['order_location_label']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['order_updated_label'])) {update_option("EWD_OTP_Order_Updated_Label", $_POST['order_updated_label']);}

	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_title_font'])) {update_option("EWD_OTP_Styling_Title_Font", $_POST['otp_styling_title_font']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_title_font_size'])) {update_option("EWD_OTP_Styling_Title_Font_Size", $_POST['otp_styling_title_font_size']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_title_font_color'])) {update_option("EWD_OTP_Styling_Title_Font_Color", $_POST['otp_styling_title_font_color']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_label_font'])) {update_option("EWD_OTP_Styling_Label_Font", $_POST['otp_styling_label_font']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_label_font_size'])) {update_option("EWD_OTP_Styling_Label_Font_Size", $_POST['otp_styling_label_font_size']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_label_font_color'])) {update_option("EWD_OTP_Styling_Label_Font_Color", $_POST['otp_styling_label_font_color']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_content_font'])) {update_option("EWD_OTP_Styling_Content_Font", $_POST['otp_styling_content_font']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_content_font_size'])) {update_option("EWD_OTP_Styling_Content_Font_Size", $_POST['otp_styling_content_font_size']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_content_font_color'])) {update_option("EWD_OTP_Styling_Content_Font_Color", $_POST['otp_styling_content_font_color']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_title_margin'])) {update_option("EWD_OTP_Styling_Title_Margin", $_POST['otp_styling_title_margin']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_title_padding'])) {update_option("EWD_OTP_Styling_Title_Padding", $_POST['otp_styling_title_padding']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_body_margin'])) {update_option("EWD_OTP_Styling_Body_Margin", $_POST['otp_styling_body_margin']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_body_padding'])) {update_option("EWD_OTP_Styling_Body_Padding", $_POST['otp_styling_body_padding']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_button_font_color'])) {update_option("EWD_OTP_Styling_Button_Font_Color", $_POST['otp_styling_button_font_color']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_button_bg_color'])) {update_option("EWD_OTP_Styling_Button_Bg_Color", $_POST['otp_styling_button_bg_color']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_button_border'])) {update_option("EWD_OTP_Styling_Button_Border", $_POST['otp_styling_button_border']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_button_margin'])) {update_option("EWD_OTP_Styling_Button_Margin", $_POST['otp_styling_button_margin']);}
	if ($EWD_OTP_Full_Version == "Yes" and isset($_POST['otp_styling_button_padding'])) {update_option("EWD_OTP_Styling_Button_Padding", $_POST['otp_styling_button_padding']);}
	
}

function Update_EWD_OTP_Email_Settings() {
	$Admin_Email = $_POST['admin_email'];
	$From_Name = $_POST['from_name'];
	$Message_Body = $_POST['message_body'];
	$Subject_Line = $_POST['subject_line'];
	$Tracking_Page = $_POST['tracking_page'];
	$SMTP_Mail_Server = $_POST['smtp_mail_server'];
	$Use_SMTP = $_POST['use_smtp'];
	$Port = $_POST['port'];
	$Username = $_POST['username'];
	$Admin_Password = $_POST['admin_password'];
	$Encryption_Type = $_POST['encryption_type'];
		
	$Admin_Email = stripslashes_deep($Admin_Email);
	$From_Name = stripslashes_deep($From_Name);
	$Message_Body = stripslashes_deep($Message_Body);
	$Subject_Line = stripslashes_deep($Subject_Line);
	$Tracking_Page = stripslashes_deep($Tracking_Page);
	$SMTP_Mail_Server = stripslashes_deep($SMTP_Mail_Server);
	$Use_SMTP = stripslashes_deep($Use_SMTP);
	$Port = stripslashes_deep($Port);
	$Username = stripslashes_deep($Username);
	$Admin_Password = stripslashes_deep($Admin_Password);
	$Encryption_Type = stripslashes_deep($Encryption_Type);
		
	$key = 'EWD_OTP';
	if (function_exists('mcrypt_decrypt')) {$Encrypted_Admin_Password = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $Admin_Password, MCRYPT_MODE_CBC, md5(md5($key))));}
	else {$Encrypted_Admin_Password = $Admin_Password;}
		
	if (isset($_POST['admin_email'])) {update_option('EWD_OTP_Admin_Email', $Admin_Email);}
	if (isset($_POST['from_name'])) {update_option('EWD_OTP_From_Name', $From_Name);}
	if (isset($_POST['message_body'])) {update_option('EWD_OTP_Message_Body', $Message_Body);}
	if (isset($_POST['subject_line'])) {update_option('EWD_OTP_Subject_Line', $Subject_Line);}
	if (isset($_POST['tracking_page'])) {update_option('EWD_OTP_Tracking_Page', $Tracking_Page);}
	if (isset($_POST['smtp_mail_server'])) {update_option('EWD_OTP_SMTP_Mail_Server', $SMTP_Mail_Server);}
	if (isset($_POST['use_smtp'])) {update_option('EWD_OTP_Use_SMTP', $Use_SMTP);}
	if (isset($_POST['port'])) {update_option('EWD_OTP_Port', $Port);}
	if (isset($_POST['username'])) {update_option('EWD_OTP_Username', $Username);}
	if (isset($_POST['admin_password'])) {update_option('EWD_OTP_Admin_Password', $Encrypted_Admin_Password);}
	if (isset($_POST['encryption_type'])) {update_option('EWD_OTP_Encryption_Type', $Encryption_Type);}

	//Saving reminders
	$Counter = 0;
	while ($Counter < 30) {
		if (isset($_POST['Email_Message_' . $Counter . '_Name'])) {
			$Prefix = 'Email_Message_' . $Counter;
			
			$Message_Item['Name'] = stripslashes_deep(urldecode($_POST[$Prefix . '_Name']));
			$Message_Item['Message'] = stripslashes_deep(urldecode($_POST[$Prefix . '_Body']));

			$Messages[] = $Message_Item; 
			unset($Message_Item);
		}
		$Counter++;
	}

	if (isset($_POST['subject_line'])) {update_option("EWD_OTP_Email_Messages_Array", $Messages);}
}
?>