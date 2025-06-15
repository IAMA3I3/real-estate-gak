<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $document_id = $_POST['document_id'];
    $rent_id = $_POST['rent_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        deleteItem($pdo, "documents", "document_id", $document_id);
        $_SESSION['info'] = "Document deleted";
        header('Location: ../../rent_documents.php?rent_id=' . $rent_id);
        $pdo = null;
        $stmt = null;
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../index.php');
    exit;
}
