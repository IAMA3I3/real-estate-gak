<?php

session_start();

if (isset($_SESSION['user'])) {
    switch ($_SESSION['user']['user_type']) {
        case 'admin':
            header('Location: ./admin_dashboard.php');
            exit;

        case 'landlord':
            header('Location: ./landlord_dashboard.php');
            exit;

        case 'user':
            header('Location: ./user_dashboard.php');
            exit;

        default:
            session_unset();
            session_destroy();
            header('Location: ./sign_in.php');
            break;
    }
} else {
    session_unset();
    session_destroy();
    header('Location: ./sign_in.php');
    exit;
}
exit;
