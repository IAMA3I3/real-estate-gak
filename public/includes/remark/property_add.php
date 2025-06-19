<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $property_id = $_POST['property_id'];
    $remark = $_POST['remark'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        $errors = [];
        if (empty($remark)) {
            $errors['remark'] = "Remark is required";
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            header('Location: ../../property_remark_add.php?property_id=' . $property_id);
            exit;
        }

        $remark_id = generateId($pdo, "remarks", "remark_id");
        addPropertyRemark($pdo, $remark_id, $property_id, $remark);
        $_SESSION['success'] = "Remark Added";
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
