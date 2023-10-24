<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VC_USERS";
$check=mysqli_connect($servername,$username,$password,$dbname);

if ($check) {
   // echo "Connection successful";
   header("locaton:index.html");
} else {
    echo "Connection Failed";
}

$email=$_POST['email'];
$pass=$_POST['pass'];

$data="SELECT * FROM registration WHERE Email='$email'&& Password='$pass'";
$execute=mysqli_query($check,$data);
$count=mysqli_num_rows($execute);

 if ($data && $count>=1) {
   // echo "Data is sent";
   header("location:mainpage.html");

 
} else {
    echo '<script>alert("Invalid Credentials")</script>' ;
}





?>