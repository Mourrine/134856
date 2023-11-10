<?php

session_start();

require_once('db_functions.php');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VC_USERS";
$check=mysqli_connect($servername,$username,$password,$dbname);

if (!$check) {
    die("Connection failed: " . mysqli_connect_error());
}

$email=$_POST['email'];
$pass=$_POST['pass'];

$data="SELECT * FROM registration WHERE Email='$email'&& Password='$pass'";
$execute=mysqli_query($check,$data);
if (!$execute) {
    die("Query failed: " . mysqli_error($check));
}
$count=mysqli_num_rows($execute);

 if ($count>=1) {
   // echo "Data is sent";
   $user_role = getUserRole($email, $check); // Call the getUserRole function
   echo "User logged in as $user_role";

    if ($user_role === 'doctor') {
        $doctor_name = getDoctorName($email, $check); // Fetch the doctor's name from your database
        $_SESSION['doctor_name'] = $doctor_name; 
        // Set the doctor's name in the session
        header("location: doctor.html");
    } elseif ($user_role === 'patient') {
        header("location: mainpage.html");
    } else {
        // Handle other roles or scenarios
        header("location: default_dashboard.php");
    }

 
} else {
    echo '<script>alert("Invalid Credentials")</script>' ;
}


?>