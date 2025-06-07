<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
    <title>Hymetocean Peers Co. | Login & Registration Form</title>
</head>
<body>
<div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img src="img/logo.png" alt="Logo" class="logo">
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="front.php" class="link">Home</a></li>
                <li><a href="about.html" class="link">About Us</a></li>
                <li><a href="project.php" class="link">Project</a></li>
                <li><a href="contact.php" class="link">Contact</a></li>
                <li><a href="logins.php" class="link">Login</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

    <div class="form-box">

        <!-- Login Form -->
        <form method="post" action="front.php">
            <div class="login-container" id="login">
                <div class="top">
                    <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                    <header>Login</header>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" id="email" placeholder="Email" name="Email" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" id="password" placeholder="Password" name="Password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Sign In" name="signIn">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="forgotPassword.php">Forgot password?</a></label>
                    </div>
                </div>
            </div>
        </form>

        <!-- Registration Form -->
        <form method="post" action="register.php">
            <div class="register-container" id="register">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" class="input-field" name="Firstname" placeholder="Firstname" required>
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" name="Lastname" placeholder="Lastname" required>
                        <i class="bx bx-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" name="Email" placeholder="Email" required>
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="Password" placeholder="Password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Register" name="Register">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Scripts -->
<script>
    function myMenuFunction() {
        var i = document.getElementById("navMenu");
        if (i.className === "nav-menu") {
            i.className += " responsive";
        } else {
            i.className = "nav-menu";
        }
    }

    var loginBtn = document.getElementById("loginBtn");
    var registerBtn = document.getElementById("registerBtn");
    var loginBox = document.getElementById("login");
    var registerBox = document.getElementById("register");

    function login() {
        loginBox.style.left = "4px";
        registerBox.style.right = "-520px";
        loginBtn.className += " white-btn";
        registerBtn.className = "btn";
        loginBox.style.opacity = 1;
        registerBox.style.opacity = 0;
    }

    function register() {
        loginBox.style.left = "-510px";
        registerBox.style.right = "5px";
        loginBtn.className = "btn";
        registerBtn.className += " white-btn";
        loginBox.style.opacity = 0;
        registerBox.style.opacity = 1;
    }
</script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'wrongpassword') {
        Swal.fire({
            icon: 'error',
            title: 'Incorrect Password!',
            text: 'The password you entered is incorrect.',
            confirmButtonColor: '#3085d6',
        });
    } else if (status === 'emailnotfound') {
        Swal.fire({
            icon: 'error',
            title: 'Email Not Found!',
            text: 'We couldn’t find an account with that email.',
            confirmButtonColor: '#3085d6',
        });
    }

    const reset = urlParams.get('reset');
    if (reset === 'sent') {
        Swal.fire({
            icon: 'success',
            title: 'Reset Link Sent!',
            text: 'Please check your email.',
            confirmButtonText: 'OK'
        });
    } else if (reset === 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Password Reset Successful!',
            text: 'You can now log in with your new password.',
            confirmButtonText: 'Login Now'
        });
    }
</script>

</body>
</html>
