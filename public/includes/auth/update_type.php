<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        updateUserType($pdo, $user_id, $user_type);
        $_SESSION['success'] = "User Type Updated";
        header('Location: ../../users.php');
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
?>