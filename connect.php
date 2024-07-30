<?php
// Set the email address where the form submissions will be sent
$webmaster_email = "ronaldabel1996@gmail.com";

// Load form field data into variables
$email_address = $_REQUEST['email'];
$msg = "Email: " . $email_address . "\r\n";

/*
The following function checks for email injection.
Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
*/
function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}


// If the form fields are empty, display an error message
if (empty($email_address)) {
    echo "Error: Email address is required.";
    exit;
}

// If email injection is detected, display an error message
elseif (isInjected($email_address)) {
    echo "Error: Invalid email address.";
    exit;
}

// If all previous tests are passed, send the email
else {
    if(mail($webmaster_email, "Contact Form Submission", $msg)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Error: Your message could not be sent. Please try again later.";
    }
}
?>
