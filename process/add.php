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

// ADD STAFF
if($purpose == 'addStaff') {

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


    $staffId = filter_form_input($staffId);
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
    

    $stmt = $con->prepare("SELECT staffName FROM staff WHERE staffId = ? OR staffEmail = ?");
    $errorchecking = $stmt->bind_param("ss",$staffId, $staffEmail);
    $errorchecking = $stmt->execute();
    $stmt -> bind_result($f_name);
    $stmt->store_result();
    $val = $stmt->num_rows;
    while ($stmt->fetch()) { $f_name = $f_name; }

    if($val > 0) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Email Already Exist";
        $_SESSION['icon'] = "error";
        header( "Location: ../pages/forms/addstaff.php" );
        exit();
    }
    else{
	$sql = "INSERT INTO staff (staffId, staffName,staffPnum,staffEmail,position,hireDate,gender,dob,address,
    state,city,postcode,country,password) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $staffId, $staffName, $staffPnum, $staffEmail, $position, $hireDate, $gender, $dob, 
    $address, $state, $city, $postcode, $country, $password);
    
        if(!mysqli_stmt_execute($stmt)) {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Please try again.";
            $_SESSION['icon'] = "error";
            header( "Location: ../pages/forms/addstaff.php" );
            exit();
        
        }
        else{
            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Data Saved Successfully";
            $_SESSION['icon'] = "success";
            header( "Location: ../pages/forms/addstaff.php" );
            exit();
        }
    }
}	

if($purpose == 'addClockIn') {

    $staffId = filter_input(INPUT_POST, 'staffId', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $clockIn = filter_input(INPUT_POST, 'clockIn', FILTER_SANITIZE_STRING);
	$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);


    $staffId = filter_form_input($staffId);
	$date = filter_form_input($date);
    $clockIn = filter_form_input($clockIn);
	$status = filter_form_input($status);
    

    $stmt = $con->prepare("SELECT clockIn FROM attendance WHERE staffId = ?");
    $errorchecking = $stmt->bind_param("s",$staffId);
    $errorchecking = $stmt->execute();
    $stmt -> bind_result($clock_In);
    $stmt->store_result();
    $val = $stmt->num_rows;
    while ($stmt->fetch()) { $clock_In = $clock_In; }

    if($val > 0) {
        $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Data Saved Successfully";
            $_SESSION['icon'] = "success";
        header( "Location: ../pages/forms/clockIn.php" );
        exit();
    }
    else{
	$sql = "INSERT INTO attendance (staffId, date, clockIn, status) VALUES ( ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $staffId, $date, $clockIn, $status);
    
        if(!mysqli_stmt_execute($stmt)) {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Please try again.";
            $_SESSION['icon'] = "error";
            header( "Location: ../pages/forms/clockIn.php" );
            exit();
        
        }
        else{
            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Data Saved Successfully";
            $_SESSION['icon'] = "success";
            header( "Location: ../pages/forms/clockIn.php" );
            exit();
        }
    }
}	

?>