<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = updateNameError($first_name, $last_name);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'first_name' => $first_name,
                'last_name' => $last_name
            ];
            $_SESSION['input_data'] = $input_data;
            header('Location: ../../edit_name.php');
            exit;
        }

        updateName($pdo, $user_id, $first_name, $last_name);
        $_SESSION['user'] = fetchById($pdo, $user_id, "users", "user_id");
        $_SESSION['success'] = "Name Updated";
        header('Location: ../../profile.php');
        
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