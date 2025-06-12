<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'connect.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["email"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Generate token and hash
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30); // 30 minutes

    // Update database
    $stmt = $conn->prepare("UPDATE username SET reset_token = ?, reset_token_expiry = ? WHERE Email = ?");
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
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
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "
                <p>Hello,</p>
                <p>Click the button below to reset your password:</p>
                <p><a href='http://localhost/wbproject/resetPass.php?token=$token' 
                    style='background-color:#4CAF50;color:white;padding:10px 20px;
                    text-decoration:none;border-radius:5px;'>Reset Password</a></p>
                <p>This link will expire in 30 minutes.</p>
            ";

            $mail->send();

            // Redirect to login 
            header("Location: forgotPassword.php?status=sent");
            exit;

        } catch (Exception $e) {
            echo "<script>
                alert('Email could not be sent. Mailer Error: " . addslashes($mail->ErrorInfo) . "');
                window.history.back();
            </script>";
        }
    } else {
        // Email not found  
        header("Location: forgotPassword.php?error=emailnotfound");
        exit;
    }

} else {
    // No POST data
    header("Location: forgotPassword.php");
    exit;
}
?>
