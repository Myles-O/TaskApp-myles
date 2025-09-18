<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$conn = new mysqli("localhost", "root", "1234", "pro");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email format");
    }

   
    $sql = "INSERT INTO users (username, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);

    if ($stmt->execute()) {
        // Send Welcome Email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'myles.otieno@strathmore.edu';   // replace with your Gmail
            $mail->Password   = 'jqxq ozmn yqus ahck';      // replace with Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('myles.otieno@strathmore.edu', 'Task App');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = "Welcome to BBIT";  // ✅ matches assignment screenshot
            $mail->Body    = "This is a new semester. <b>Let’s enjoy coding</b>";
            $mail->AltBody = "This is a new semester. Let's enjoy coding";

            $mail->send();
            echo "<div style='font-family: Arial; margin:20px;'>
                    ✅ Signup successful. Welcome email sent! <br>
                    <a href='users.php'>View Users</a>
                  </div>";
        } catch (Exception $e) {
            echo "⚠️ User saved, but email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ Error: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
