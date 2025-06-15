<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['tasksSend'])) { // ✅ MATCHES the form's submit button name

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hymetoceanpeersco@gmail.com';  
        $mail->Password   = 'ceiyafsfjacqczyu';        
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // FROM: Admin (you), TO: user (recipient)
        $mail->setFrom('hymetoceanpeersco@gmail.com', 'Hymetocean Peers Co.');
        $mail->addAddress($_POST["RecipientEmail"]);
        $mail->addReplyTo('hymetoceanpeersco@gmail.com', 'Hymetocean Admin');

        $mail->isHTML(true);
        $mail->Subject = 'Task Assigned: ' . $_POST["ProjectTitle"];

        $mail->Body = '
            <h2>You Have a New Task</h2>
            <p><strong>Department:</strong> ' . htmlspecialchars($_POST["Department"]) . '</p>
            <p><strong>Project Title:</strong> ' . htmlspecialchars($_POST["ProjectTitle"]) . '</p>
            <p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($_POST["Message"])) . '</p>
        ';

        $maxFileSize = 5 * 1024 * 1024; // 5MB per file

        if (!empty($_FILES['Attachment']['name'][0])) {
            foreach ($_FILES['Attachment']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['Attachment']['error'][$key] === UPLOAD_ERR_OK) {
                    if ($_FILES['Attachment']['size'][$key] <= $maxFileSize) {
                        $mail->addAttachment($tmp_name, $_FILES['Attachment']['name'][$key]);
                    }
                }
            }
        }

        $mail->send();
        header("Location: tasks.php?status=sent");
        exit;

    } catch (Exception $e) {
        header("Location: tasks.php?status=error");
        exit;
    }
}
?>
