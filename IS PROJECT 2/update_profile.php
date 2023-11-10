<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Handle profile update and user's input here

    // Retrieve the user's input
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    // Handle the uploaded profile picture
    $uploadDir = 'uploads/';

    // Check if the directory exists, and if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Handle the uploaded profile picture
    if (isset($_FILES['profile_picture'])) {
        $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);
    
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
            // File uploaded successfully
            $profile_picture = $uploadFile; // Save the file path
        } else {
            // Handle the file upload error
            echo "Error uploading profile picture.";
            exit;
        }
    } 

    // Now, you can update the user's profile information in the database
    // Use your database connection code here and an appropriate SQL UPDATE query
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // You should use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE registration SET full_name = ?, email = ?, profile_picture = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $full_name, $email, $profile_picture, $user_id); // Replace $user_id with the user's ID
    $user_id = 1; // Replace with the actual user's ID

    if ($stmt->execute()) {
        // Profile updated successfully
        $successMessage = "Profile updated successfully.";
    } else {
        // Handle the database update error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
