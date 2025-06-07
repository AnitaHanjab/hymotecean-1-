<?php
session_start();
require 'connect.php';

function showAlertAndRedirect($message, $type = 'error') {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: '$type',
            title: '".($type === 'success' ? 'Success!' : 'Oops...')."',
            text: '$message',
            confirmButtonText: 'OK'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit;
}

if (!isset($_POST["token"])) {
    showAlertAndRedirect("Invalid request.");
}

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

// Get user by token
$sql = "SELECT * FROM username WHERE reset_token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    showAlertAndRedirect("Token not found.");
}

// Check if token is expired
if (strtotime($user["reset_token_expiry"]) <= time()) {
    showAlertAndRedirect("This reset link has expired.");
}

// Validate password
if (strlen($_POST["password"]) < 8) {
    showAlertAndRedirect("Password must be at least 8 characters.");
}
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    showAlertAndRedirect("Password must contain at least one letter.");
}
if (!preg_match("/[0-9]/", $_POST["password"])) {
    showAlertAndRedirect("Password must contain at least one number.");
}
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    showAlertAndRedirect("Passwords must match.");
}

// Hash new password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Update password and clear token
$sql = "UPDATE username SET Password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $password_hash, $user["Email"]);
$stmt->execute();

// Success popup and redirect to login
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Password Reset Successful',
        text: 'You can now log in with your new password.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'logins.php';
    });
</script>";
exit;
?>
