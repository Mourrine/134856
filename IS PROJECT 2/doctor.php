<?php

// Start a session to access session variables
session_start();

// Check if the user is authenticated and the doctor's name is stored in the session
if (isset($_SESSION['doctor_name'])) {
    $doctor_name = $_SESSION['doctor_name'];
} else {
    // If not authenticated, redirect to the login page or show an error message
    header("Location: login_check.php"); // Redirect to your login page
    exit;
}

// Include the doctor.html file and pass the doctor's name as a variable
include("doctor.html");
?>
