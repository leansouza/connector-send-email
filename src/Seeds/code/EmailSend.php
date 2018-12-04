<?php
$to      = $config['targetName'] . '<' . $config=['email'] . '>';
$subject = $config['subject'];
$message = 'hello world';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

return [];
