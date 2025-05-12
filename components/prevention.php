<?php

// $role_id = $_SESSION['role_id'];

if (
    isset($_SESSION['user_id']) &&
    isset($_SESSION['username']) &&
    isset($_SESSION['role_id']) &&
    isset($_SESSION['mall_id'])
) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $role_id = $_SESSION['role_id'];
    $mall_id = $_SESSION['mall_id'];
} else {
    $user_id = '';
    $username = '';
    $role_id = '';
    $mall_id = '';
    header('location: ../login.php');
    exit();
};


