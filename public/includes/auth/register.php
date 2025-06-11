<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = validateUser($pdo, $first_name, $last_name, $email, $password, $confirm_password);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ];
            $_SESSION['input_data'] = $input_data;
            header('Location: ../../sign_up.php');
            exit;
        }

        $user_id = generateId($pdo, "users", "user_id");
        addUser($pdo, $user_id, $first_name, $last_name, $email, $password);
        $user = fetchUserByEmail($pdo, $email);
        $_SESSION['user'] = $user;
        $_SESSION['success'] = "Welcome";
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
