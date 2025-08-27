<?php
// Enable output buffering FIRST
ob_start();

// Session settings
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_httponly' => true,
        'use_strict_mode' => true
    ]);
}

// Initialize cart count if not set
if (!isset($_SESSION['cart_count'])) {
    $_SESSION['cart_count'] = 0;
}

// Database connection
require_once __DIR__.'/db_connect.php'; 

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");

// Helper functions
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
        exit;
    }
}
?>