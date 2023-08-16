<?php 
	$errors = array();

	function fieldname_as_text($fieldname) {
		$fieldname = str_replace("_", " ", $fieldname);
		$fieldname = ucfirst($fieldname);
		return $fieldname;
	}

	//* presence

	function has_presence($value){
		return isset($value) && $value !== "";
	}
	
	function validate_presences($required_fields) {
		global $errors;
		foreach ($required_fields as $fields) {
			$value = trim($_POST[$fields]);
			if (!has_presence($value)) {
				$errors[$fields] = fieldname_as_text($fields) . " can't be blank.";
			}
		}
	}
	//* string length

	//maximum length
 	function max_length($value, $max) {
 		return strlen($value) <= $max;
 	}
	
	function validate_max_length($fields_with_max_lengths){
	global $errors;
	// Using an assoc. array
		foreach ($fields_with_max_lengths as $field => $max) {
			$value = trim($_POST[$field]);
			if (!max_length($value, $max)) {
				$errors[$field] = fieldname_as_text($field) . " is too long";
			}
		}
	}
	//* inclusion
	function has_inclusion($value, $set){
		return in_array($value, $set);
	}
	


	?>
	