<?php
include 'connect.php';
session_start();

$error = '';
$success = '';

if (isset($_POST['verify'])) {
    $email = $_POST['email'];
    $enteredOtp = $_POST['otp'];

    $query = "SELECT otp, otp_expiry FROM username WHERE Email = '$email' AND is_verified = 0";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $correctOtp = $row['otp'];
        $otpExpiry = $row['otp_expiry'];

        if (new DateTime() > new DateTime($otpExpiry)) {
            $error = "Your OTP has expired. Please try again later.";
        } elseif ($enteredOtp == $correctOtp) {
            $updateQuery = "UPDATE username SET is_verified = 1 WHERE Email = '$email'";
            mysqli_query($conn, $updateQuery);

            $_SESSION['Email'] = $email;
            $success = "Verification successful!";
        } else {
            $error = "Incorrect OTP. Please try again.";
        }
    } else {
        $error = "Invalid or already verified email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="form-box">
        <form method="post" action="">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            <div class="input-box">
                <input type="text" class="input-field" name="otp" placeholder="Enter 6-digit OTP" required maxlength="6" pattern="\d{6}" inputmode="numeric">
            </div>
            <div class="input-box">
                <input type="submit" class="submit" name="verify" value="Verify OTP">
            </div>
        </form>
    </div>

    <script>
        <?php if (!empty($success)): ?>
            Swal.fire({
                icon: 'success',
                title: 'Verification Successful!',
                text: '<?php echo $success; ?>',
                confirmButtonColor: '#3085d6',
            }).then(() => {
                window.location.href = 'logins.php';
            });
        <?php elseif (!empty($error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Verification Failed!',
                text: '<?php echo $error; ?>',
                confirmButtonColor: '#d33',
            });
        <?php endif; ?>
    </script>
</body>
</html>
