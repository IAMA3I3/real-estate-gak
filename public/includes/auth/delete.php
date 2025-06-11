<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = $_POST['location'];
    $user_id = $_POST['user_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        deleteItem($pdo, "users", "user_id", $user_id);
        $_SESSION['info'] = "User Deleted";
        if ($location === 'users') {
            header('Location: ../../users.php');
        } elseif ($location === 'profile') {
            header('Location: ../../profile.php');
        } else {
            header('Location: ../../dashboard.php');
        }

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
