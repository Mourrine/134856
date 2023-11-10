<!DOCTYPE html>
<html>
<head>
    <title>Appointment Booked Successfully</title>
</head>
<body>
    <h1>Appointment Booked Successfully</h1>
    <p>Your appointment with <?php echo $doctorName; ?>  has been confirmed.</p>
    <?php
    // Retrieve the Google Meet link from the database based on the doctor's name
    $doctorName = $_GET['doctor'];

    // Query the database to get the Google Meet link
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "VC_USERS";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT google_meet_link FROM appointments WHERE doctor = '$doctorName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $googleMeetLink = $row['google_meet_link'];
        echo '<p>Join the meeting <a href="' . $googleMeetLink . '">here</a></p>';
    }

    $conn->close();
    ?>
</body>
</html>
