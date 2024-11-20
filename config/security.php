<?php

if (!isset($_SESSION['loggedin'])) {
   session_destroy();
   header("Location : ../pages/login/loginStaff.php");
   exit();
}

$user = $_SESSION['staffEmail'];

?>