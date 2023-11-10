<?php
// Include your database connection code or functions
require_once('db_functions.php');

// Create a database connection
$connection = connectToDatabase();

// Fetch appointments using the function getAppointmentsFromDatabase
$appointments = getAppointmentsFromDatabase($connection);

// Close the database connection
mysqli_close($connection);

// Set the response content type to JSON
header('Content-Type: application/json');

if (isset($appointments['error'])) {
    echo json_encode($appointments);
} else {
    echo json_encode($appointments);
}
?>
