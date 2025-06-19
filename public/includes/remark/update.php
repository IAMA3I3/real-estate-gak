<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $remark_id = $_POST['remark_id'];
    $rent_id = $_POST['rent_id'];
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
            header('Location: ../../remark_edit.php?id=' . $remark_id);
            exit;
        }

        updateColumn($pdo, "remarks", $remark_id, "remark_id", "comment", $remark);
        $_SESSION['success'] = "Remark updated";
        header('Location: ../../remarks.php?rent_id=' . $rent_id);
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
