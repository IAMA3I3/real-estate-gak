<?php

require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $bio = $_POST['bio'];

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions and max file size
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $maxFileSize = 100 * 1024 * 1024; // 100 MB

        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
                file_put_contents($uploadDir . '.HTACCESS', 'Options -Indexes');
            }
            $uniqueFileName = 'member_' . time() . '.' . $fileExtension;
            $destPath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $filePath = $destPath;
            } else {
                $filePath = null;
                // Handle file upload error
                $_SESSION['errors']['fileUpload'] = "Error uploading file.";
                header('Location: ../../team-add.php');
                exit;
            }
        } else {
            // Handle invalid file type or size
            $_SESSION['errors']['fileUpload'] = "Invalid file type or size.";
            header('Location: ../../team-add.php');
            exit;
        }
    } else {
        $filePath = null;
    }

    try {
        $errors = addTeamMemberError($name, $bio);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $inputData = [
                'name' => $name,
                'position' => $position,
                'bio' => $bio
            ];
            $_SESSION['inputData'] = $inputData;
            header('Location: ../../team-add.php');
            exit;
        }

        addTeamMember($pdo, $filePath, $name, $position, $bio);
        $_SESSION['success'] = 'Team Member Added';
        header('Location: ../../dashboard_team.php');
        $pdo = null;
        $stmt = null;
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../index.php');
    die();
}
