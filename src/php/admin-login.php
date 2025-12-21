<?php
session_start();
require_once 'admin-config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (password_verify($password, $ADMIN_PASSWORD_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin-dashboard.php');
        exit;
    } else {
        header('Location: admin-login.html?error=1');
        exit;
    }
} else {
    header('Location: admin-login.html');
    exit;
}
