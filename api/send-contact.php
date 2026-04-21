<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$config = require '../config/config.php';
require '../config/mailer.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

try {

    $mail = createMailer($config);

    $mail->setFrom($config['smtp_user'], 'Contact Form');
    $mail->addAddress('info@tadec.com.ec');

    $mail->Subject = "New Contact Message from " . ($data['name'] ?? '');

    $mail->Body =
        "Name: " . ($data['name'] ?? '') . "\n" .
        "Email: " . ($data['email'] ?? '') . "\n" .
        "Message: " . ($data['message'] ?? '');

    $mail->send();

    echo json_encode(["status" => true]);

} catch (Exception $e) {
    echo json_encode(["status" => false, "error" => $e->getMessage()]);
}