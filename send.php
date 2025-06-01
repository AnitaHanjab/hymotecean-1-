<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lagos.p.bscs@gmail.com';
        $mail->Password   = 'lgtotkbikfijdffi';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom($_POST["Email"], $_POST["Name"]);
        $mail->addAddress('lagos.p.bscs@gmail.com');
        $mail->addReplyTo($_POST["Email"], $_POST["Name"]);

        $mail->isHTML(true);
        $mail->Subject = $_POST["Projects"]; 
        $mail->Body    = $_POST["Message"];  

        $mail->send();
        header("Location: contact.php?status=sent");
        exit;

    } catch (Exception $e) {
        header("Location: contact.php?status=error");
        exit;
    }
}
?>
