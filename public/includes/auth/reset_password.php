<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = $_POST['location'];
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = changePasswordErrors($password, $confirm_password);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            if ($location === 'users') {
                header('Location: ../../reset_user_password.php?id=' . $user_id);
                exit;
            } elseif ($location === 'profile') {
                header('Location: ../../reset_password.php');
                exit;
            } else {
                header('Location: ../../dashboard.php');
                exit;
            }
        }

        changePassword($pdo, $user_id, $password);
        $_SESSION['success'] = "Password Changed";
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
