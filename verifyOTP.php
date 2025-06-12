<?php
include 'connect.php';
session_start();

// --- Common OTP function ---
function generateAndSendOTP($email, $conn) {
    $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $expiry = date("Y-m-d H:i:s", strtotime('+5 minutes'));

    // Update user with OTP and expiry
    $stmt = $conn->prepare("UPDATE username SET otp = ?, otp_expiry = ? WHERE Email = ?");
    $stmt->bind_param("sss", $otp, $expiry, $email);
    $stmt->execute();
    $stmt->close();

    // Send the OTP
    $subject = "Your Verification Code";
    $message = "Your verification code is: $otp\nIt will expire in 5 minutes.";
    $headers = "From: no-reply@hymetocean.com";
    mail($email, $subject, $message, $headers);
}

// --- Registration Logic ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Register'])) {
    $firstname = $_POST['Firstname'];
    $lastname = $_POST['Lastname'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM username WHERE Email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        header("Location: logins.php?status=emailalreadyexists");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO username (Firstname, Lastname, Email, Password, is_verified) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
    $stmt->execute();
    $stmt->close();

    generateAndSendOTP($email, $conn);
    $_SESSION['old_email'] = $email;

    header("Location: verifyOTP.php?email=" . urlencode($email));
    exit();
}

// --- Login Logic with OTP ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn'])) {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $result = mysqli_query($conn, "SELECT * FROM username WHERE Email = '$email'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (!password_verify($password, $row['Password'])) {
            header("Location: logins.php?status=wrongpassword");
            exit();
        }

        if (!$row['is_verified']) {
            generateAndSendOTP($email, $conn);
            header("Location: verifyOTP.php?email=" . urlencode($email));
            exit();
        }

        $_SESSION['Email'] = $email;
        header("Location: front.php");
        exit();
    } else {
        header("Location: logins.php?status=emailnotfound");
        exit();
    }
}

// --- OTP Verification Submission ---
$error = '';
$success = '';
$email = isset($_POST['email']) ? $_POST['email'] : (isset($_GET['email']) ? $_GET['email'] : '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    $enteredOtp = implode('', $_POST['otp']);
    $query = "SELECT otp, otp_expiry FROM username WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $correctOtp = $row['otp'];
        $otpExpiry = $row['otp_expiry'];

        if (new DateTime() > new DateTime($otpExpiry)) {
            $error = "Your OTP has expired. Please try again.";
        } elseif ($enteredOtp === $correctOtp) {
            mysqli_query($conn, "UPDATE username SET is_verified = 1, otp = NULL, otp_expiry = NULL WHERE Email = '$email'");
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

<!-- HTML for OTP Input -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
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
        <p>Please enter the verification code sent to <strong><?php echo htmlspecialchars($email); ?></strong></p>
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
        window.location.href = 'front.php';
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
