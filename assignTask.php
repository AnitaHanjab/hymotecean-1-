<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $department = $_POST["Department"];
    $title = $_POST["ProjectTitle"];
    $message = $_POST["Message"];
    $recipient = $_POST["RecipientEmail"];

    $attachmentName = '';
    if (isset($_FILES['Attachment']) && $_FILES['Attachment']['error'][0] === 0) {
        $attachmentName = $_FILES['Attachment']['name'][0];
        move_uploaded_file($_FILES['Attachment']['tmp_name'][0], "uploads/" . $attachmentName);
    }

    $sql = "INSERT INTO assigned_tasks (department, project_title, attachment, message, recipient_email)
            VALUES ('$department', '$title', '$attachmentName', '$message', '$recipient')";

    $conn->query($sql);
    header("Location: tasks.php");
    exit;
}
?>
