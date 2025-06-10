<?php
include 'connect.php';
session_start();

// Function SweetAlert2 
function showAlertAndRedirect($message) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '$message'
            }).then(function() {
                window.history.back();
            });
        </script>
    </body>
    </html>";
    exit();
}


// REGISTER 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['Register'])) {
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Generate OTP and expiry
    $otp = rand(100000, 999999);
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    // Check if email already exists
    $checkEmail = mysqli_query($conn, "SELECT * FROM username WHERE Email = '$Email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        showAlertAndRedirect("Email already in use");
    }

    $insertQuery = "INSERT INTO username (Firstname, Lastname, Email, Password, otp, otp_expiry, is_verified)
                    VALUES ('$Firstname', '$Lastname', '$Email', '$hashedPassword', '$otp', '$otp_expiry', 0)";
    $result = mysqli_query($conn, $insertQuery);

    if ($result) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'hymetoceanpeersco@gmail.com';
            $mail->Password   = 'ceiyafsfjacqczyu'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('hymetoceanpeersco@gmail.com', 'Hymetocean Peers Co.');
            $mail->addAddress($Email, $Firstname); 

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Hymetocean Registration';
            $mail->Body    = "
                Hi $Firstname,<br><br>
                Your OTP code is: <strong>$otp</strong><br>
                Please enter this code to verify your account.
            ";

            $mail->send();

            header("Location: verifyOTP.php?email=$Email");
            exit();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "Database insert failed: " . mysqli_error($conn);
    }
}

if (isset($_POST['signIn'])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM username WHERE Email = '$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($Password, $row['Password'])) {
            $_SESSION['Email'] = $row['Email'];
            header("Location: front.php");
            exit();
        } else {
            header("Location: logins.php?status=wrongpassword");
            exit();
        }
    } else {
        header("Location: logins.php?status=emailnotfound");
        exit();
    }
}
?>
