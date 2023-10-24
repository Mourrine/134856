<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VC_USERS";
$con = mysqli_connect($servername,$username,$password,$dbname);

if ($con) {
   // echo "Connection Successful";
} else {
    echo "Connection failed";
}

$name=$_POST['Full_Name'];
$email=$_POST['email'];
$pass=$_POST['pass'];

$query = "INSERT INTO registration VALUES('','$name','$email','$pass')";
$data=mysqli_query($con,$query);
if ($data) {
   // echo "Data is sent";
   header("location:mainpage.html");


} else {
    echo "Data is not sent";
}








?>