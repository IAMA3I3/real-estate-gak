<?php

require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

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
        $maxFileSize = 300 * 1024 * 1024; // 300 MB

        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
                file_put_contents($uploadDir . '.HTACCESS', 'Options -Indexes');
            }
            $uniqueFileName = 'location_' . time() . '.' . $fileExtension;
            $destPath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $filePath = $destPath;
            } else {
                $filePath = null;
                // Handle file upload error
                $_SESSION['errors']['file_upload'] = "Error uploading file.";
                header('Location: ../../location_add.php');
                exit;
            }
        } else {
            // Handle invalid file type or size
            $_SESSION['errors']['file_upload'] = "Invalid file type or size.";
            header('Location: ../../location_add.php');
            exit;
        }
    } else {
        $filePath = null;
    }

    try {
        $errors = addLocationError($pdo, $name);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: ../../location_add.php');
            die();
        }

        $location_id = generateId($pdo, "locations", "location_id");
        addLocation($pdo, $location_id, $filePath, $name);
        $_SESSION['success'] = "Location Added";
        header('Location: ../../locations.php');
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../locations.php');
    die();
}
