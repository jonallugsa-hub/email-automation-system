<?php

use PHPMailer\PHPMailer\PHPMailer;

function createMailer($config) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_user'];
    $mail->Password   = $config['smtp_pass'];
    $mail->SMTPSecure = 'tls';
    $mail->Port       = $config['smtp_port'];

    $mail->CharSet = 'UTF-8';

    return $mail;
}