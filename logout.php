<?php
// logout.php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Models/User.php';


$auth = new AuthController();
$auth->logout();
?>