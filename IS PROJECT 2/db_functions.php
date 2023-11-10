<?php

function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "VC_USERS";
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connection; // Return the database connection
}

function getUserRole($email, $connection) {
    $email = mysqli_real_escape_string($connection, $email);
    $query = "SELECT Role FROM registration WHERE Email='$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Role'];
    }

    return 'unknown'; // Default role if not found
}

function getDoctorName($email, $connection) {
    $email = mysqli_real_escape_string($connection, $email);
    $query = "SELECT `Full Name` FROM doctors WHERE Email='$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Full Name'];
    }

    return 'Unknown'; // Return a default value if the doctor's name is not found
}
function getAppointmentsFromDatabase($connection) {
    $query = "SELECT * FROM appointments"; // Replace 'appointments' with the actual table name if different
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    $appointments = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $appointment = array(
            'date' => $row['Date'],
            'time' => $row['Time'],
            'patient_name' => $row['Name'],
            'meet_link' => $row['Meet Link']
        );

        $appointments[] = $appointment;
    }

    if (empty($appointments)) {
        return array('error' => 'No appointments found');
    }

    return $appointments;
}



// Add more functions if needed for your specific application

?>
