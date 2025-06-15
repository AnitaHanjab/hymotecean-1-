<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $project = $_POST['Projects'];
    $message = $_POST['Message'];

    $uploadDir = 'uploads/';
    $uploadedFiles = [];

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle multiple files
    foreach ($_FILES['Project']['name'] as $key => $filename) {
        $tmpName = $_FILES['Project']['tmp_name'][$key];
        $targetFile = $uploadDir . time() . '_' . basename($filename);

        if (move_uploaded_file($tmpName, $targetFile)) {
            $uploadedFiles[] = $targetFile;
        }
    }

    $attachments = implode(',', $uploadedFiles); // Combine file paths into a string

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, project, message, attachments) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $project, $message, $attachments);

    if ($stmt->execute()) {
        header("Location: contact.php?status=sent");
        exit();
    } else {
        header("Location: contact.php?status=error");
        exit();
    }
}
?>
