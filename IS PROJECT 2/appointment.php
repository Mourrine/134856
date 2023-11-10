<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\IS PROJECT 2\phpmailer\PHPMailer-master\src/PHPMailer.php';
require 'C:\xampp\htdocs\IS PROJECT 2\phpmailer\PHPMailer-master\src/SMTP.php';
require 'C:\xampp\htdocs\IS PROJECT 2\phpmailer\PHPMailer-master\src/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $uniqueToken = md5(uniqid('', true));
    $googleMeetLink = "https://meet.google.com/ftq-aviw-nbw";

    // Establish database connection (you may have this in a separate file)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "VC_USERS";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to insert the appointment record
    $sql = "INSERT INTO appointments (name, email, doctor, date, time, `Meet Link`) VALUES ('$name', '$email', '$doctor', '$date', '$time', '$googleMeetLink')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Appointment record inserted successfully
        $successMessage = "Appointment booked successfully. Google Meet link for the virtual consultation will be sent to your email.";
        
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Configure your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = 'mourrineb@gmail.com'; // Your email address
            $mail->Password = 'cpgb tbzv ofyo zsed'; // Your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('teledoc@gmail.com', 'TeleDoc');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Your TeleDoc Appointment';
            $mail->Body = "Hello $name, your appointment has been scheduled as follows:\nDoctor: $doctor\nDate: $date\nTime: $time\nGoogle Meet link: $googleMeetLink";

            $mail->send();
        } catch (Exception $e) {
            // Handle email sending errors
            echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
       
    } else {
        // Error inserting appointment record
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>



        <!-- Display success message if set -->
        <?php if (isset($successMessage)) : ?>
            <div id="successMessage" style="background-color:lavender; color:black; font-weight: bold;">
                <?php echo $successMessage; ?>
                <br>
                <br>
                <br>
           <a href="index.html"><button id="logout-button" style="background-color: white; color:black" >Log Out</button></a> 
            </div>
        <?php endif; ?>

</body>
</html>
