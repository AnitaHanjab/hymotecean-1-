<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotPassword.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <form method="post" action="resetPassRequest.php"> 
            <h2>Forgot Password</h2>
            <p style="color: #ccc; margin-bottom: 20px;">Enter your email to receive a reset link.</p>

            <div class="input-text">
                <input type="email" name="email" required>
                <label>Enter your email</label>
            </div>

            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    <p>Remember me</p>
                </label>
            </div>

            <button type="submit">Send Reset Link</button>

            <div class="register">
                <p>Back to <a href="logins.php">Login</a></p>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 error handler -->
<script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === 'emailnotfound') {
        Swal.fire({
            icon: 'error',
            title: 'Email Not Found!',
            text: 'We couldn’t find an account with that email.',
            confirmButtonText: 'Try Again'
        });
    } else if (urlParams.get('status') === 'sent') {
        Swal.fire({
            icon: 'success',
            title: 'Email Sent!',
            text: 'A password reset link has been sent to your email.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'logins.php';
        });
    }
</script>

</body>
</html>
