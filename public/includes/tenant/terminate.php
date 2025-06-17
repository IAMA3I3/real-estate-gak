<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rent_id = $_POST['rent_id'];
    $property_id = $_POST['property_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        updateColumn($pdo, "properties", $property_id, "property_id", "availability", "vacant");
        deleteItem($pdo, "rents", "rent_id", $rent_id);
        $_SESSION['info'] = "Rent terminated";
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
