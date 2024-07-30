<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = 'ronaldabel1996@gmail.com';
        $subject = 'New Contact Request';
        $message = "Email: $email";
        $headers = 'From: noreply@yourdomain.com' . "\r\n" .
                   'Reply-To: ' . $email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo "Message sent successfully!";
        } else {
            error_log("Mail sending failed for email: $email", 0);
            echo "Failed to send message. Please try again later.";
        }
    } else {
        echo "Invalid email address.";
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "405 Method Not Allowed. Please use POST method.";
}
