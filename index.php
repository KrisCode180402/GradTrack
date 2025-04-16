<?php
// index.php
session_start();
require_once __DIR__ . '/includes/config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "dashboard.php");
    exit;
} else {
    header("Location: " . BASE_URL . "login.php");
    exit;
}
?>