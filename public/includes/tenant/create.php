<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $property_id = $_POST['property_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = validateUser($pdo, $first_name, $last_name, $email, $password, $password);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone
            ];
            $_SESSION['input_data'] = $input_data;
            header('Location: ../../add_tenant.php?property_id=' . $property_id);
            exit;
        }

        $user_id = generateId($pdo, "users", "user_id");
        addUser($pdo, $user_id, $first_name, $last_name, $email, $phone, $password);
        $_SESSION['success'] = "Tenant Added";
        header('Location: ../../dashboard_property_detail.php?id=' . $property_id);
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
