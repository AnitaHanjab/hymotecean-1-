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
        $mail->Subject = 'New Contact Submission from ' . $_POST["Name"];

        $mail->Body = '
            <h2>Contact Request</h2>
            <p><strong>Name:</strong> ' . htmlspecialchars($_POST["Name"]) . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($_POST["Email"]) . '</p>
            <p><strong>Project Description:</strong> ' . nl2br(htmlspecialchars($_POST["Projects"])) . '</p>
            <p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($_POST["Message"])) . '</p>
        ';

        // Max size (5MB)
        $maxFileSize = 5 * 1024 * 1024;

        if (!empty($_FILES['Project']['name'][0])) {
            foreach ($_FILES['Project']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['Project']['error'][$key] === UPLOAD_ERR_OK) {
                    if ($_FILES['Project']['size'][$key] <= $maxFileSize) {
                        $mail->addAttachment($tmp_name, $_FILES['Project']['name'][$key]);
                    }
                }
            }
        }

        $mail->send();
        header("Location: contact.php?status=sent");
        exit;

    } catch (Exception $e) {
        header("Location: contact.php?status=error");
        exit;
    }
}
?>
