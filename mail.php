<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Your email where you want to receive messages
$myEmail = 'ronaldabel1996@gmail.com';

// Sanitize and validate email input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email format.";
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration (for sending via SMTP server, you can configure your SMTP server details)
        $mail->isSMTP();
        $mail->Host = 'smtp.mailersend.net'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'MS_pHHjMg@trial-neqvygm7w2dg0p7w.mlsender.net'; // Replace with your SMTP username
        $mail->Password = 'rWmDcWHnW1JRgGpx'; // Replace with your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content
        $mail->setFrom($email, 'Website Contact');
        $mail->addAddress($myEmail);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "You have received a new message from: $email";

        // Send email
        if ($mail->send()) {
            http_response_code(200);
            echo "Thank you! Your message has been sent.";
        } else {
            http_response_code(500);
            echo "Error: Unable to send message.";
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
