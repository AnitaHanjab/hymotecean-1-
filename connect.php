<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "logins";
$conn = new mysqli($host, $user, $pass, $db);
    if($conn->connect_error){
        echo "Failed to connect db".$conn->connect_error;
    }
?>

