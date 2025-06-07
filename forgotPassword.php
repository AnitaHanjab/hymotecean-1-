<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="wrapper">
    <div class="form-box">
        <form method="post" action="resetPassRequest.php">
            <div class="login-container">
                <div class="top">
                    <header>Forgot Password</header>
                    <p>Enter your email to receive a reset link.</p>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Send Reset Link">
                </div>
                <div style="margin-top: 10px; text-align: center;">
                    <a href="logins.php">Back to Login</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!--SweetAlert2-->
<script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === 'emailnotfound') {
        Swal.fire({
            icon: 'error',
            title: 'Email Not Found!',
            text: 'We couldn’t find an account with that email.',
            confirmButtonText: 'Try Again'
        });
    }
</script>
</body>
</html>
