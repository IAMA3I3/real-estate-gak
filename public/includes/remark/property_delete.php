<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remark_id = $_POST['remark_id'];
    $property_id = $_POST['property_id'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        deleteItem($pdo, "remarks", "remark_id", $remark_id);
        $_SESSION['info'] = "Remark deleted";
        header('Location: ../../property_remarks.php?id=' . $property_id);
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
