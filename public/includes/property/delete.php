<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $property_id = $_POST['property_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        deleteItem($pdo, "properties", "property_id", $property_id);
        deleteItem($pdo, "rents", "property_id", $property_id);
        $_SESSION['info'] = "Property deleted";
        header('Location: ../../dashboard_properties.php');
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
