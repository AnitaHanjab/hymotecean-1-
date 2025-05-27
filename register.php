<?php
include 'connect.php';
session_start();

// --- REGISTER ---
if (isset($_POST['Register'])) {
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $checkEmail = "SELECT * FROM username WHERE Email = '$Email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO username (Firstname, Lastname, Email, Password)
                        VALUES ('$Firstname', '$Lastname', '$Email', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            header("Location: logins.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// --- LOGIN ---
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
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }
}
?>
