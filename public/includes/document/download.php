<?php
require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if (isset($_POST['document'])) {
    $document = $_POST['document'];

    if ($document) {
        $filePath = $document;

        if (file_exists($filePath)) {
            // Set headers to download the file
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Invalid certificate ID.";
    }
} else {
    echo "No certificate ID provided.";
}