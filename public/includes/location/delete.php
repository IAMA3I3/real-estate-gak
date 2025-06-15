<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location_id = $_POST['location_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        deleteItem($pdo, "locations", "location_id", $location_id);
        $_SESSION['info'] = "Location deleted";
        header('Location: ../../locations.php');
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
