<?php
session_start();
require 'connect.php';

$errors = [];
$password = '';
$confirmPassword = '';

$token = $_GET['token'] ?? $_POST['token'] ?? '';
$token_hash = hash("sha256", $token);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("SELECT * FROM username WHERE reset_token = ?");
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $errors['token'] = "Invalid or expired token.";
    } elseif (strtotime($user["reset_token_expiry"]) <= time()) {
        $errors['token'] = "Token has expired.";
    } else {
        $password = $_POST["password"];
        $confirmPassword = $_POST["password_confirmation"];

        if (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters.";
        } elseif (!preg_match("/[a-z]/i", $password)) {
            $errors['password'] = "Password must contain at least one letter.";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $errors['password'] = "Password must contain at least one number.";
        }

        if ($password !== $confirmPassword) {
            $errors['confirm'] = "Passwords do not match.";
        }

        if (empty($errors)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE username SET Password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE Email = ?");
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password</title>
  <link rel="stylesheet" href="resetPass.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    .error { color: salmon; font-size: 0.9rem; margin-top: 5px; text-align: left; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Reset Password</h2>

    <?php if (isset($errors['token'])): ?>
      <div class="error"><?= htmlspecialchars($errors['token']) ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

      <div class="input-text">
        <input type="password" name="password" id="password" required value="<?= htmlspecialchars($password) ?>" />
        <label for="password">New Password</label>
      </div>
      <?php if (isset($errors['password'])): ?>
        <div class="error"><?= htmlspecialchars($errors['password']) ?></div>
      <?php endif; ?>

      <div class="input-text">
        <input type="password" name="password_confirmation" id="confirmPassword" required value="<?= htmlspecialchars($confirmPassword) ?>" />
        <label for="confirmPassword">Confirm Password</label>
      </div>
      <?php if (isset($errors['confirm'])): ?>
        <div class="error"><?= htmlspecialchars($errors['confirm']) ?></div>
      <?php endif; ?>

      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>
