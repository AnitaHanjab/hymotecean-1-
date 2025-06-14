<?php
include 'connect.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// SweetAlert2 Error Function
function showAlertAndRedirect($message) {
    echo "
    <html><head>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head><body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '$message'
        }).then(function() {
            window.history.back();
        });
    </script>
    </body></html>";
    exit();
}

// Registration 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Firstname'])) {

    $recaptchaSecret = '6LdLRl4rAAAAANn3IEdslD1i6Iw0fyUfVrQVSM9Y';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        showAlertAndRedirect("reCAPTCHA verification failed. Please try again.");
    }

    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Email = trim(strtolower($_POST['Email']));
    $Password = $_POST['Password'];
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $otp = rand(100000, 999999);
    $otp_expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

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
                This code will expire in 5 minutes.<br><br>
                Please enter this code on the verification page to activate your account.<br><br>
                Regards,<br>
                Hymetocean Peers Co.
            ";

            $mail->send();

            header("Location: verifyOTP.php?email=" . urlencode($Email));
            exit();

        } catch (Exception $e) {
            showAlertAndRedirect("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    } else {
        showAlertAndRedirect("Database error: " . mysqli_error($conn));
    }
} else {
    showAlertAndRedirect("Invalid registration request.");
}


// LOGIN 
if (isset($_POST['Email']) && isset($_POST['Password']) && !isset($_POST['Register'])) {
    $recaptchaSecret = '6LdLRl4rAAAAANn3IEdslD1i6Iw0fyUfVrQVSM9Y';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        header("Location: logins.php?status=recaptchafail");
        exit();
    }

    $Email = trim(strtolower($_POST['Email']));
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM username WHERE LOWER(Email) = '$Email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

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