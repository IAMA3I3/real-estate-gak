<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $user = fetchUserByEmail($pdo, $email);

        $errors = loginError($email, $password, $user);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: ../../sign_in.php');
            exit;
        }
        $_SESSION['user'] = $user;
        $_SESSION['success'] = "Welcome Back";
        if (isset($_SESSION['page'])) {
            header('Location: ../../' . $_SESSION['page']);
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
?>