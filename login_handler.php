<?php
session_start();
require 'connect.php'; // your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $captcha_input = $_POST['captcha_input'];

    // Server-side CAPTCHA check (optional but recommended)
    if (!isset($_SESSION['captcha_code']) || strtolower($captcha_input) !== strtolower($_SESSION['captcha_code'])) {
        header("Location: logins.php?status=captchaerror");
        exit();
    }

    // Email check
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        header("Location: logins.php?status=emailnotfound");
        exit();
    }

    $user = $res->fetch_assoc();

    // Password check
    if (!password_verify($password, $user['Password'])) {
        header("Location: logins.php?status=wrongpassword");
        exit();
    }

    // Login successful
    $_SESSION['user_id'] = $user['id'];
    header("Location: front.php");
    exit();
}
?>
