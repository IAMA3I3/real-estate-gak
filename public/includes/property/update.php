<?php

require_once '../db.php';
require_once '../functions.php';
require_once '../session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $property_id = $_POST['property_id'];
    $images = $_POST['images'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $landlord_id = $_POST['landlord'];
    $price = $_POST['price'];
    $location_id = $_POST['location'];
    $address = $_POST['address'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $livingroom = $_POST['livingroom'];
    $bedroom = $_POST['bedroom'];
    $bathroom = $_POST['bathroom'];
    $property_condition = $_POST['property_condition'];
    $features = $_POST['features'];
    $filePaths = [];

    // Handle multiple file uploads (images and videos)
    if (isset($_FILES['files']) && is_array($_FILES['files']['name'])) {
        $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $allowedVideoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm'];
        $allowedExtensions = array_merge($allowedImageExtensions, $allowedVideoExtensions);

        $maxFileSize = 500 * 1024 * 1024; // 500MB to accommodate videos
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
                $fileType = in_array($ext, $allowedImageExtensions) ? 'image' : 'video';
                $uniqueFileName = 'property_' . $fileType . '_' . time() . '_' . $index . '.' . $ext;
                $destPath = $uploadDir . $uniqueFileName;

                if (move_uploaded_file($tmpPath, $destPath)) {
                    $filePaths[] = $destPath;
                } else {
                    $_SESSION['errors']['file_upload'] = "Failed to upload one or more files.";
                    header('Location: ../../property_add.php');
                    exit;
                }
            } elseif ($error !== UPLOAD_ERR_NO_FILE) {
                if ($file_size > $maxFileSize) {
                    $_SESSION['errors']['file_upload'] = "File too large. Maximum file size is 500MB.";
                } else {
                    $_SESSION['errors']['file_upload'] = "Invalid file type. Only images (JPEG, PNG, GIF, WebP) and videos (MP4, AVI, MOV, WMV, FLV, WebM) are allowed.";
                }
                header('Location: ../../property_add.php');
                exit;
            }
        }
    }

    try {
        $errors = addPropertyErrors($name, $description, $landlord_id, $price, $address, $latitude, $longitude, $status, $type, $size);
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $input_data = [
                'name' => $name,
                'description' => $description,
                'landlord' => $landlord_id,
                'price' => $price,
                'location' => $location_id,
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
            header('Location: ../../property_edit.php?id=' . $property_id);
            exit;
        }

        if (empty($latitude)) {
            $latitude = null;
        }
        if (empty($longitude)) {
            $longitude = null;
        }

        if (empty($filePaths)) {
            $filePathString = $images;
        } else {
            $filePathString = implode(', ', $filePaths); // Combine all file paths
        }

        updateProperty($pdo, $property_id, $filePathString, $name, $description, $landlord_id, $price, $location_id, $address, $latitude, $longitude, $status, $type, $size, $livingroom, $bedroom, $bathroom, $property_condition, $features);

        $_SESSION['success'] = "Property Updated";
        header('Location: ../../dashboard_property_detail.php?id=' . $property_id);
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../index.php');
    die();
}
