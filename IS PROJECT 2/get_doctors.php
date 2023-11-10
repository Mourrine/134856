<?php
// Include your database connection code here

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "VC_USERS";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve the list of doctors from the "doctors" table
$sql = "SELECT `Full Name`, `Specialization` FROM doctors";

// Execute the query
$result = mysqli_query($con, $sql);

// Generate the options for the dropdown
$options = array();
while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['Full Name'])) {
        $optionText = $row['Full Name'];
        // Check if a specialization is available and append it to the option text
        if (!empty($row['Specialization'])) {
            $optionText .= " - " . $row['Specialization'];
        }
        $options[] = $optionText;
    }
}

// Close the database connection
mysqli_close($con);

// Send the options as JSON
echo json_encode($options);
?>
