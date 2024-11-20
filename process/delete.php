<?php
    session_start();
    require('../config/database.php');

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $id = base64_decode($id);
    $previous = $_SERVER['HTTP_REFERER'];

    // START PROCESSING
    if($stmt = $con->prepare("DELETE FROM staff WHERE staffId = ?"))
    {   
        $stmt->bind_param( "s", $id );
            
        if(!$stmt->execute()) {
            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Please try again.";
            $_SESSION['icon'] = "error";
            header( "Location: $previous" );
            exit();
        } else {
            $stmt->close();
            $con->close();
        
            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Staff details successfully deleted.";
            $_SESSION['icon'] = "success";
            header( "Location: $previous" );
            exit();
        }
    } else{
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Please try again.";
        $_SESSION['icon'] = "error";
        header( "Location: ../pages/forms/addStaff.php" );
        exit();
    }
?>