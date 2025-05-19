<?php

date_default_timezone_set('Africa/Lagos');

include_once './includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="assets/ic.png" type="image/x-icon">
    <title>G. Ade Kelani Chambers</title>
</head>

<body>

    <!-- info alert -->
    <?php if (isset($_SESSION['info'])) { ?>
        <!-- info alert -->
        <div id="info-alert" class=" transition-all duration-500 fixed top-0 opacity-0 invisible left-[50%] -translate-x-[50%] py-2 px-6 rounded-full bg-yellow-500 text-white z-[100000]"><?php echo $_SESSION['info'] ?></div>
        <!-- end info alert -->
    <?php unset($_SESSION['info']);
    } ?>

    <!-- success alert -->
    <?php if (isset($_SESSION['success'])) { ?>
        <!-- info alert -->
        <div id="info-alert" class=" transition-all duration-500 fixed top-0 opacity-0 invisible left-[50%] -translate-x-[50%] py-2 px-6 rounded-full bg-green-500 text-white z-[100000]"><?php echo $_SESSION['success'] ?></div>
        <!-- end info alert -->
    <?php unset($_SESSION['success']);
    } ?>

    <!-- error alert -->
    <?php if (isset($_SESSION['error'])) { ?>
        <!-- info alert -->
        <div id="info-alert" class=" transition-all duration-500 fixed top-0 opacity-0 invisible left-[50%] -translate-x-[50%] py-2 px-6 rounded-full bg-red-500 text-white z-[100000]"><?php echo $_SESSION['error'] ?></div>
        <!-- end info alert -->
    <?php unset($_SESSION['error']);
    } ?>