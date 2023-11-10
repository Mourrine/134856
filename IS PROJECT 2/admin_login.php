<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VC_USERS";
$check = mysqli_connect($servername, $username, $password, $dbname);

if (!$check) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$enteredPassword = $_POST['pass'];

// Fetch hashed password from the database
$admin_query = "SELECT Password FROM admins WHERE Email='$email'";
$admin_result = mysqli_query($check, $admin_query);

if ($admin_result && mysqli_num_rows($admin_result) === 1) {
    // Admin exists, check the password
    $row = mysqli_fetch_assoc($admin_result);
    $hashedPasswordFromDB = $row['Password'];

    if (password_verify($enteredPassword, $hashedPasswordFromDB)) {
        // Admin credentials are correct
        $_SESSION['admin'] = true;
        header("location: admin_dashboard.html");
        exit();
    } else {
        echo '<script>alert("Invalid Admin Credentials")</script>';
    }
} else {
    // Admin does not exist, insert new admin
    $hashedPassword = password_hash($enteredPassword, PASSWORD_BCRYPT);

    $insert_query = "INSERT INTO admins (Email, Password) VALUES ('$email', '$hashedPassword')";
    $insert_result = mysqli_query($check, $insert_query);

    if ($insert_result) {
        // Admin inserted successfully, log in
        $_SESSION['admin'] = true;
        header("location: admin_dashboard.html");
        exit();
    } else {
        echo '<script>alert("Failed to insert admin")</script>';
    }
}
?>
