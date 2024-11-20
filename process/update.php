<?php

	session_start();
	require('../config/database.php');
	
	// FILTER INPUT
	function filter_form_input($FInput) {
		$FInput = filter_var($FInput, FILTER_UNSAFE_RAW); 
		$FInput = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $FInput);
		
		return $FInput;
	}
	
	
$purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);

// update STAFF
if($purpose == 'editStaff') {

    $staffId = filter_input(INPUT_POST, 'staffId', FILTER_SANITIZE_STRING);
    $staffName = filter_input(INPUT_POST, 'staffName', FILTER_SANITIZE_STRING);
	$staffPnum = filter_input(INPUT_POST, 'staffPnum', FILTER_SANITIZE_STRING);
    $staffEmail = filter_input(INPUT_POST, 'staffEmail', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
	$hireDate = filter_input(INPUT_POST, 'hireDate', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $postcode = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
	$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


	$staffName = filter_form_input($staffName);
    $staffPnum = filter_form_input($staffPnum);
	$staffEmail = filter_form_input($staffEmail);
	$position = filter_form_input($position);
    $hireDate = filter_form_input($hireDate);
    $gender = filter_form_input($gender);
    $dob = filter_form_input($dob);
    $address = filter_form_input($address);
    $state = filter_form_input($state);
    $city = filter_form_input($city);
	$postcode = filter_form_input($postcode);
    $country = filter_form_input($country);
    $password = filter_form_input($password);

    //OTHER
    $hash = password_hash($password, PASSWORD_DEFAULT);
    

    $date = date("Y-m-d");
	$previous = $_SERVER['HTTP_REFERER'];

	if($stmt = $con->prepare("UPDATE staff SET staffName = ?, staffPnum = ?, staffEmail = ?, position = ?, hireDate = ?, gender = ?, dob = ?,
     address = ?, state = ?, city = ?, postcode = ?, country = ?, password = ? WHERE staffId = ?"));
    {	
        $stmt->bind_param( "ssssssssssssss", $staffName, $staffPnum, $staffEmail, $position, $hireDate, $gender, $dob, $address, $state, $city, $postcode, $country, $password, $staffId);
            
		if(!$stmt->execute()) {

			$_SESSION['result'] = "Failed!"; 
			$_SESSION['message'] = "Data not saved.Please try again.";
			$_SESSION['icon'] = "error";
			header( "Location: $previous" );
			exit();
			
		} else {
			
			$stmt->close();
			$con->close();
		
			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Update save successfully.";
			$_SESSION['icon'] = "success";
			header( "Location: $previous" );
			exit();
		}
	}
}	
// update STAFF
if($purpose == 'updateClockOut') {

    $staffId = filter_input(INPUT_POST, 'staffId', FILTER_SANITIZE_STRING);
    $clockOut = filter_input(INPUT_POST, 'clockOut', FILTER_SANITIZE_STRING);

	$clockOut = filter_form_input($clockOut);

    $date = date("Y-m-d");
	$previous = $_SERVER['HTTP_REFERER'];

	if($stmt = $con->prepare("UPDATE attendance SET clockOut = ? WHERE staffId = ?"));
    {	
        $stmt->bind_param( "ss", $clockOut, $staffId);
            
		if(!$stmt->execute()) {

			$_SESSION['result'] = "Failed!"; 
			$_SESSION['message'] = "Clock out failed";
			$_SESSION['icon'] = "error";
			header( "Location: $previous" );
			exit();
			
		} else {
			
			$stmt->close();
			$con->close();
		
			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Clock Out successfully.";
			$_SESSION['icon'] = "success";
			header( "Location: $previous" );
			exit();
		}
	}
}	 

?>