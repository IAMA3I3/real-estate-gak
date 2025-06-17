<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['tenant'];
    $rent_start = $_POST['rent_start_2'];
    $rent_end = $_POST['rent_end_2'];
    $property_id = $_POST['property_id'];
    $landlord_id = $_POST['landlord_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = [];
        if (empty($user_id)) {
            $errors['tenant'] = "Tenant is required";
        }
        if (empty($rent_start)) {
            $errors['rent_start_2'] = "Rent start date is required";
        }
        if (empty($rent_end)) {
            $errors['rent_end_2'] = "Rent end date is required";
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'tenant' => $user_id,
                'rent_start_2' => $rent_start,
                'rent_end_2' => $rent_end
            ];
            $_SESSION['input_data'] = $input_data;
            $_SESSION['error'] = "Error adding tenant";
            header('Location: ../../add_tenant.php?property_id=' . $property_id);
            exit;
        }

        $rent_id = generateId($pdo, "rents", "rent_id");
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
