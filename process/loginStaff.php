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

// LOGIN
if($purpose == 'loginStaff') {
     
     $user = filter_input(INPUT_POST, 'staffEmail', FILTER_SANITIZE_STRING);
     $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
 
      $user = filter_form_input($user);
      $pass = filter_form_input($pass);
      
     // OTHER
     $status = 'Active';
 
     // CHECK EXISTENCE
     $stmt = $con->prepare("SELECT password FROM staff WHERE staffEmail = ? AND status = ?");
     $errorchecking = $stmt->bind_param("ss", $user, $status);
     $errorchecking = $stmt->execute();
     $stmt -> bind_result($password);
     $stmt->store_result();
     $val = $stmt->num_rows;
     while ($stmt->fetch()) { $password = $password; }
     $hash = password_hash($pass, PASSWORD_DEFAULT);
     
 
     // CHECK PASSWORD
      if(($val > 0) && ($pass != '')) {
      
           if(password_verify($pass, $hash)) { 
 
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['staffEmail'] =  $user;
 
                header( "Location: ../emp.php" );
                exit();
 
           } else {
 
                $_SESSION['message'] =  "You entered the wrong password!";
                $_SESSION['result'] =  "Please re-enter!";
                   $_SESSION['icon'] =  "Error";
                header( "Location: ../pages/login/login.php" );
                exit();
 
           }
      } else {
 
           $_SESSION['message'] =  "Email does not registered!";
           $_SESSION['result'] =  "Please re-enter!";
             $_SESSION['icon'] =  "Error";
           header( "Location: ../pages/login/login.php" );
           exit();
 
      }
 }
 // END LOGIN

else
{
     session_destroy();
    header('Location: ../pages/login/login.php');
     exit();
}

?>