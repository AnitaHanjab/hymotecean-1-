<?php
include 'connect.php';
session_start();

// Function to show a SweetAlert2 
function showAlertAndRedirect($message) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '$message'
        }).then(function() {
            window.history.back();
        });
    </script>";
    exit();
}

// REGISTER 
if (isset($_POST['Register'])) {
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $checkEmail = "SELECT * FROM username WHERE Email = '$Email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        showAlertAndRedirect("Email Address Already Exists!");
    } else {
        $insertQuery = "INSERT INTO username (Firstname, Lastname, Email, Password)
                        VALUES ('$Firstname', '$Lastname', '$Email', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            header("Location: logins.php");
            exit();
        } else {
            showAlertAndRedirect("Registration failed. Please try again.");
        }
    }
}

// LOGIN 
if (isset($_POST['signIn'])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM username WHERE Email = '$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($Password, $row['Password'])) {
            $_SESSION['Email'] = $row['Email'];
            header("Location: front.php");
            exit();
        } else {
            // Incorrect password
            header("Location: logins.php?status=wrongpassword");
            exit();
        }
    } else {
        // Email not found
        header("Location: logins.php?status=emailnotfound");
        exit();
    }
}
?>
