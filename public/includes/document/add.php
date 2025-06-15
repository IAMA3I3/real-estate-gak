<?php

require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $rent_id = $_POST['rent_id'];

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define allowed file extensions and max file size
        $allowedExtensions = array('pdf', 'docx', 'doc');
        $maxFileSize = 50 * 1024 * 1024; // 50 MB

        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
                file_put_contents($uploadDir . '.htaccess', 'Options -Indexes');
            }
            $uniqueFileName = 'doc_' . time() . '_' . uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $filePath = $destPath;
            } else {
                $filePath = null;
                // Handle file upload error
                $_SESSION['errors']['file'] = "Error uploading document.";
                header('Location: ../../upload_rent_document.php?rent_id=' . urlencode($rent_id));
                exit;
            }
        } else {
            // Handle invalid file type or size
            if (!in_array($fileExtension, $allowedExtensions)) {
                $_SESSION['errors']['file'] = "Invalid file type. Only PDF, DOCX, and DOC files are allowed.";
            } else {
                $_SESSION['errors']['file'] = "File size too large. Maximum size is 50MB.";
            }
            header('Location: ../../upload_rent_document.php?rent_id=' . urlencode($rent_id));
            exit;
        }
    } else {
        // Handle no file uploaded or upload error
        if (!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
            $_SESSION['errors']['file'] = "Please select a document to upload.";
        } else {
            $_SESSION['errors']['file'] = "Error uploading document. Please try again.";
        }
        header('Location: ../../upload_rent_document.php?rent_id=' . urlencode($rent_id));
        exit;
    }

    try {
        // Validate document data
        $errors = validateDocumentData($name, $filePath);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'name' => $name
            ];
            $_SESSION['input_data'] = $input_data;
            header('Location: ../../upload_rent_document.php?rent_id=' . urlencode($rent_id));
            die();
        }

        // Generate document ID and add to database
        $document_id = generateId($pdo, "documents", "document_id");
        addDocument($pdo, $document_id, $rent_id, $name, $filePath);
        
        $_SESSION['success'] = "Document uploaded successfully";
        header('Location: ../../rent_documents.php?rent_id=' . urlencode($rent_id));
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        // Clean up uploaded file if database insertion fails
        if (isset($filePath) && file_exists($filePath)) {
            unlink($filePath);
        }
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../rent_history.php');
    die();
}