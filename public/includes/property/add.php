<?php

require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $landlord_id = $_POST['landlord'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $livingroom = $_POST['livingroom'];
    $bedroom = $_POST['bedroom'];
    $bathroom = $_POST['bathroom'];
    $property_condition = $_POST['property_condition'];
    $features = $_POST['features'];
    $filePaths = [];

    // Handle multiple file uploads
    if (isset($_FILES['files']) && is_array($_FILES['files']['name'])) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $maxFileSize = 300 * 1024 * 1024; // 300MB
        $uploadDir = 'uploads/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
            file_put_contents($uploadDir . '.HTACCESS', 'Options -Indexes');
        }

        foreach ($_FILES['files']['name'] as $index => $file_name) {
            $tmpPath = $_FILES['files']['tmp_name'][$index];
            $file_size = $_FILES['files']['size'][$index];
            $error = $_FILES['files']['error'][$index];

            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if ($error === UPLOAD_ERR_OK && in_array($ext, $allowedExtensions) && $file_size <= $maxFileSize) {
                $uniqueFileName = 'property_' . time() . '_' . $index . '.' . $ext;
                $destPath = $uploadDir . $uniqueFileName;

                if (move_uploaded_file($tmpPath, $destPath)) {
                    $filePaths[] = $destPath;
                } else {
                    $_SESSION['errors']['file_upload'] = "Failed to upload one or more files.";
                    header('Location: ../../property_add.php');
                    exit;
                }
            } elseif ($error !== UPLOAD_ERR_NO_FILE) {
                $_SESSION['errors']['file_upload'] = "Invalid file or file too large.";
                header('Location: ../../property_add.php');
                exit;
            }
        }
    }

    try {
        $errors = addPropertyErrors($name, $description, $landlord_id, $price, $address, $status, $type, $size);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'name' => $name,
                'description' => $description,
                'landlord' => $landlord_id,
                'price' => $price,
                'address' => $address,
                'status' => $status,
                'type' => $type,
                'size' => $size,
                'livingroom' => $livingroom,
                'bedroom' => $bedroom,
                'bathroom' => $bathroom,
                'property_condition' => $property_condition,
                'features' => $features
            ];
            $_SESSION['input_data'] = $input_data;
            header('Location: ../../property_add.php');
            exit;
        }

        $property_id = generateId($pdo, "properties", "property_id");
        $filePathString = implode(', ', $filePaths); // Combine all file paths

        addProperty($pdo, $property_id, $filePathString, $name, $description, $landlord_id, $price, $address, $status, $type, $size, $livingroom, $bedroom, $bathroom, $property_condition, $features);

        $_SESSION['success'] = "Property Added";
        header('Location: ../../dashboard_properties.php');
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../property_add.php');
    die();
}
