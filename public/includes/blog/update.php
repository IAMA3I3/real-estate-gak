<?php

require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blog_id = $_POST['blog_id'];
    $title = $_POST['title'];
    $body = $_POST['body'];

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
            $uniqueFileName = 'blog_' . time() . '.' . $fileExtension;
            $destPath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $filePath = $destPath;
            } else {
                $filePath = null;
                // Handle file upload error
                $_SESSION['errors']['file_upload'] = "Error uploading file.";
                header('Location: ../../blog_edit.php?id=' . $blog_id);
                exit;
            }
        } else {
            // Handle invalid file type or size
            $_SESSION['errors']['file_upload'] = "Invalid file type or size.";
            header('Location: ../../blog_edit.php?id=' . $blog_id);
            exit;
        }
    } else {
        $filePath = null;
    }

    try {
        $errors = addBlogError($title, $body);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'title' => $title,
                'body' => $body
            ];
            $_SESSION['input_data'] = $input_data;
            header('Location: ../../blog_edit.php?id=' . $blog_id);
            die();
        }

        updateBlog($pdo, $blog_id, $filePath, $title, $body);
        $_SESSION['success'] = "Blog Updated";
        header('Location: ../../dashboard_blog_detail.php?id=' . $blog_id);
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../blog_add.php');
    die();
}
