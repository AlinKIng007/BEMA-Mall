<?php

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['username']) &&
    isset($_SESSION['role_id']) &&
    isset($_SESSION['mall_id'])
) {
    $role_id = $_SESSION['role_id'];
    // Check if the URL already contains "admin"
    if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false) {
        // If role is not 4 or 5, redirect to home.php
        if ($role_id <= 1) {
            header('location: ../home.php');
            exit();
        }
    } elseif ($role_id === 5 || $role_id === 4) {
        // If role is 4 or 5, and URL doesn't contain "admin", redirect to admin dashboard
        header('location: ../admin/dashboard.php');
        exit();
    }
    elseif($role_id === 1){
        header('location: ../cashier.php');
        exit();
    }
    elseif($role_id === 2 &&$role_id === 3){
        header('location: ../home.php');
        exit();
    }
} else {
    // If user is not logged in, redirect to login page
    header('location: ../home.php');
    exit();
}
?>
