<?php
include 'connect.php';
session_start();

$error = '';
$success = '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    $email = $_POST['email'];
    $enteredOtp = implode('', $_POST['otp']); // Combine the 6 input values

    $query = "SELECT otp, otp_expiry FROM username WHERE Email = '$email' AND is_verified = 0";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $correctOtp = $row['otp'];
        $otpExpiry = $row['otp_expiry'];

        if (new DateTime() > new DateTime($otpExpiry)) {
            $error = "Your OTP has expired. Please try again later.";
        } elseif ($enteredOtp === $correctOtp) {
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="verifyOTP.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="opt-form">
    <div class="header-form">
        <div class="auto-icon">
            <i class="bx bxs-envelope"></i>
        </div>
        <h4>Verify Your Email</h4>
        <p>Please Enter The Verification Code We Sent <br> To <strong><?php echo htmlspecialchars($email); ?></strong></p>
    </div>

    <form method="post" action="">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="auth-pin-wrap">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <input type="text" class="code-input" name="otp[]" required maxlength="1" pattern="\d" inputmode="numeric">
            <?php endfor; ?>
        </div>

        <div class="btn-wrap">
            <button type="submit" name="verify">Confirm</button>
        </div>
    </form>
</div>

<script>
    const inputElement = [...document.querySelectorAll('input.code-input')];
    inputElement.forEach((elem, index) => {
        elem.addEventListener('keydown', (e) => {
            if (e.keyCode === 8 && e.target.value === '') {
                inputElement[Math.max(0, index - 1)].focus();
            }
        });

        elem.addEventListener('input', (e) => {
            const [first, ...rest] = e.target.value;
            e.target.value = first ?? '';
            const lastInputBox = index === inputElement.length - 1;
            const insertedContent = first !== undefined;
            if (insertedContent && !lastInputBox) {
                inputElement[index + 1].focus();
                inputElement[index + 1].value = rest.join('');
                inputElement[index + 1].dispatchEvent(new Event('input'));
            }
        });
    });
</script>

<?php if (!empty($success)): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Verification Successful!',
        text: '<?php echo $success; ?>',
        confirmButtonColor: '#3085d6'
    }).then(() => {
        window.location.href = 'logins.php';
    });
</script>
<?php elseif (!empty($error)): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Verification Failed!',
        text: '<?php echo $error; ?>',
        confirmButtonColor: '#d33'
    });
</script>
<?php endif; ?>

</body>
</html>
