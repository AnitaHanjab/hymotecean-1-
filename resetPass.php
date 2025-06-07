<?php
session_start();
require 'connect.php';

$errors = [];
$password = '';
$confirmPassword = '';

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST["token"] ?? '';
    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM username WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $errors[] = "Invalid or expired token.";
    } elseif (strtotime($user["reset_token_expiry"]) <= time()) {
        $errors[] = "Token has expired.";
    } else {
        $password = $_POST["password"];
        $confirmPassword = $_POST["password_confirmation"];

        if (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters.";
        }
        if (!preg_match("/[a-z]/i", $password)) {
            $errors['password'] = "Password must contain at least one letter.";
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors['password'] = "Password must contain at least one number.";
        }
        if ($password !== $confirmPassword) {
            $errors['confirm'] = "Passwords do not match.";
        }

        if (empty($errors)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE username SET Password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $password_hash, $user["Email"]);
            $stmt->execute();

            header("Location: logins.php?reset=success");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        .error { color: red; font-size: 0.9em; margin-top: 5px; }
        .form-box { max-width: 400px; margin: auto; padding: 20px; }
        input[type="password"], input[type="submit"] {
            width: 100%; padding: 10px; margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Reset Your Password</h2>

    <?php if (isset($errors[0])): ?>
        <div class="error"><?= htmlspecialchars($errors[0]) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? $_POST['token'] ?? '') ?>">

        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <?php if (isset($errors['password'])): ?>
            <div class="error"><?= htmlspecialchars($errors['password']) ?></div>
        <?php endif; ?>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <?php if (isset($errors['confirm'])): ?>
            <div class="error"><?= htmlspecialchars($errors['confirm']) ?></div>
        <?php endif; ?>

        <input type="submit" value="Reset Password">
    </form>
</div>
</body>
</html>
