<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $file = $_POST['file'];

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';

        if ($file && $file != '') {
            unlink('./' . $file);
        }

        deleteItem($pdo, "team", "id", $id);
        $_SESSION['info'] = 'Team Member Deleted';
        header('Location: ../../dashboard_team.php');
        $stmt = null;
        $pdo = null;
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../index.php');
    die();
}