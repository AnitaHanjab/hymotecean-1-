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
        $mail->Username   = 'hymetoceanpeersco@gmail.com';
        $mail->Password   = 'ceiyafsfjacqczyu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom($_POST["Email"], $_POST["Name"]);
        $mail->addAddress('hymetoceanpeersco@gmail.com');
        $mail->addReplyTo($_POST["Email"], $_POST["Name"]);

        $mail->isHTML(true);
        $mail->Subject = 'New Consultation Request from ' . $_POST["Name"];

        $mail->Body = '
            <h2>Consultation Request</h2>
            <p><strong>Name:</strong> ' . htmlspecialchars($_POST["Name"]) . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($_POST["Email"]) . '</p>
            <p><strong>Organization:</strong> ' . htmlspecialchars($_POST["Organization"]) . '</p>
            <p><strong>Type of Project:</strong> ' . htmlspecialchars($_POST["Type"]) . '</p>
            <p><strong>Project Description:</strong><br>' . nl2br(htmlspecialchars($_POST["Projects"])) . '</p>
            <p><strong>Preferred Consultation Date:</strong> ' . htmlspecialchars($_POST["Appointment"]) . '</p>
        ';

        $mail->send();

        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                .swal2-popup {
                    font-family: 'Poppins', sans-serif !important;
                }
            </style>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent!',
                    text: 'Your consultation request has been sent successfully.',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'about.html';
                });
                setTimeout(() => {
                    window.location.href = 'about.html';
                }, 3000);
            </script>
        </body>
        </html>";
        exit;

    } catch (Exception $e) {
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap' rel='stylesheet'>
            <style>
                .swal2-popup {
                    font-family: 'Poppins', sans-serif !important;
                }
            </style>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Failed to send the consultation request. Please try again.'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit;
    }
}
?>
