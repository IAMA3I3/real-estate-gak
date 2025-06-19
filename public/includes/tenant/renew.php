<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rent_id = $_POST['rent_id'];
    $rent_end = $_POST['rent_end'];
    $property_id = $_POST['property_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = [];
        if (empty($rent_end)) {
            $errors['rent_end'] = "Rent end date is required";
        } elseif (strtotime($rent_end) < strtotime(date('Y-m-d'))) {
            $errors['rent_end'] = "Rent end date cannot be in the past";
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: ../../renew_rent.php?rent_id=' . $rent_id);
            exit;
        }

        updateColumn($pdo, "properties", $property_id, "property_id", "availability", "occupied");
        updateColumn($pdo, "rents", $rent_id, "rent_id", "status", "active");
        updateColumn($pdo, "rents", $rent_id, "rent_id", "rent_end", $rent_end);
        $_SESSION['success'] = "Rent Extended";
        header('Location: ../../rent_history.php');
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
