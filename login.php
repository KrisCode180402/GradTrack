<?php
// GradTrack/login.php

// Correctly include the configuration file
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Models/User.php';


// Create an instance of the AuthController and call the login method
$auth = new AuthController();
$auth->login();
?>


