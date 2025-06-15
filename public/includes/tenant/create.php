<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $rent_start = $_POST['rent_start'];
    $rent_end = $_POST['rent_end'];
    $password = $_POST['password'];
    $property_id = $_POST['property_id'];
    $landlord_id = $_POST['landlord_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = validateUser($pdo, $first_name, $last_name, $email, $password, $password);
        if (empty($rent_start)) {
            $errors['rent_start'] = "Rent start date is required";
        }
        if (empty($rent_end)) {
            $errors['rent_end'] = "Rent end date is required";
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'rent_start' => $rent_start,
                'rent_end' => $rent_end
            ];
            $_SESSION['input_data'] = $input_data;
            $_SESSION['error'] = "Error adding tenant";
            header('Location: ../../add_tenant.php?property_id=' . $property_id);
            exit;
        }

        $user_id = generateId($pdo, "users", "user_id");
        $rent_id = generateId($pdo, "rents", "rent_id");
        addUser($pdo, $user_id, $first_name, $last_name, $email, $phone, $password);
        updateColumn($pdo, "properties", $property_id, "property_id", "availability", "occupied");
        addRent($pdo, $rent_id, $property_id, $landlord_id, $user_id, $rent_start, $rent_end);
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
