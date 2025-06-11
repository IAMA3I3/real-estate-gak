<?php

function userAccess($user_types)
{
    if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['user_type'], $user_types)){
        $_SESSION['info'] = "Access denied";
        header('Location: ./sign_in.php');
        exit;
    }
}

function activeUsers()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['status'] !== 'active') {
        $_SESSION['info'] = "Access denied";
        header('Location: ./sign_in.php');
        exit;
    }
}