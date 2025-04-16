<?php
// includes/auth_check.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isAuthenticated()
{
    return isset($_SESSION['user_id']);
}

function ensureAuthenticated()
{
    if (!isAuthenticated()) {
        header('Location: ' . BASE_URL . 'login.php');
        exit();
    }
}
?>