<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require 'vendor/autoload.php';
require "vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "vendor/phpmailer/phpmailer/src/Exception.php";
require "vendor/phpmailer/phpmailer/src/OAuth.php";

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;               // Enable verbose debug output
    $mail->isSMTP();                                       // Send using SMTP
    $mail->Host       = 'mail.ciudadhive.com';             // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                              // Enable SMTP authentication
    $mail->Username   = 'info@ciudadhive.com';             // SMTP username
    $mail->Password   = 'ceph7065079';                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                               // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	//PHPMailer::ENCRYPTION_SMTPS;
    //Recipients
    $mail->setFrom('info@ciudadhive.com', 'Mailer');
    $mail->addAddress('carlosperazavz@hotmail.com', 'Carlos Peraza');  // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Aqui el texto del subject....';
    $mail->Body    = 'Aqui esta el cuerpo del email <b>En negrilla! ya en strasourcing</b>';
    $mail->AltBody = 'Este texto se coloca en plano como alternativa para clientes tipo non-HTML-mail';

    $mail->send();
    echo 'el mensaje ha sido enviado...';
} catch (Exception $e) {
    echo "no se pudo enviar el mensaje por este Error: {$mail->ErrorInfo}";
}