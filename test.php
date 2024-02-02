<?php 

$to = 'mosami7400@gmail.com';
$subject = 'Test Email';
$message = 'This is a test email sent from the XAMPP server.';
$headers = 'From: cf.egypt789@gmail.com' . "\r\n" .
    'Reply-To: cf.egypt789@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);



?>