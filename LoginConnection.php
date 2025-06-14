<?php
include 'connect.php';
session_start();

function showAlertAndRedirect($message) {
    echo "
    <html><head>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head><body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '$message'
        }).then(function() {
            window.history.back();
        });
    </script>
    </body></html>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Email']) && isset($_POST['Password'])) {
    $recaptchaSecret = '6LdLRl4rAAAAANn3IEdslD1i6Iw0fyUfVrQVSM9Y';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        header("Location: logins.php?status=recaptchafail");
        exit();
    }

    $Email = trim(strtolower($_POST['Email']));
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM username WHERE LOWER(Email) = '$Email'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($Password, $row['Password'])) {
            $_SESSION['Email'] = $row['Email'];
            header("Location: front.php");
            exit();
        } else {
            header("Location: logins.php?status=wrongpassword");
            exit();
        }
    } else {
        header("Location: logins.php?status=emailnotfound");
        exit();
    }
}
?>
