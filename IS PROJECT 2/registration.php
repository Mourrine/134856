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
$role = $_POST['role']; 

$query = "INSERT INTO registration (`Full Name`, Email, Password, role) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);

// Bind the parameters
mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $pass, $role);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    // Registration data inserted successfully
    $user_id = mysqli_insert_id($con); // Get the inserted user's ID

    if ($role === 'doctor') {
        // Prepare an INSERT statement for the doctors table
        $queryDoctors = "INSERT INTO doctors (`Full Name`, Specialization, Email, user_id) VALUES (?, ?, ?, ?)";
        $stmtDoctors = mysqli_prepare($con, $queryDoctors);

        $specialization = $_POST['specialization']; // Change this to your form input name

        // Bind the parameters
        mysqli_stmt_bind_param($stmtDoctors, "sssi", $name, $specialization, $email, $user_id);

        if (mysqli_stmt_execute($stmtDoctors)) {
            // Doctor data inserted successfully
            header("location: doctor.html");
        } else {
            echo "Error inserting into doctors table: " . mysqli_error($con);
        }
    } elseif ($role === 'patient') {
        header("location: mainpage.html");
    } else {
        // Handle other roles or scenarios
        header("location: default_dashboard.php");
    }
} else {
    echo "Error inserting into registration table: " . mysqli_error($con);
}

mysqli_close($con);


?>