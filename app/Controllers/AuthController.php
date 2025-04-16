<?php
// app/Controllers/AuthController.php

// Define a simple redirect helper if not already defined
if (!function_exists('redirect')) {
    function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}

// Include required files using the correct relative paths
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';

class AuthController extends BaseController
{
    public function login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                $errors[] = "Both username and password are required.";
            } else {
                $userModel = new User($this->db);
                $errorMsg = "";
                if ($userModel->login($username, $password, $errorMsg)) {
                    redirect(BASE_URL . "dashboard.php");
                } else {
                    $errors[] = $errorMsg;
                }
            }
        }
        // Load the login view (ensure this file exists at the specified path)
        require_once __DIR__ . '/../../app/Views/auth/login.php';
    }

    public function register()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
                $errors[] = "All fields are required.";
            } elseif ($password !== $confirmPassword) {
                $errors[] = "Passwords do not match.";
            } else {
                $userModel = new User($this->db);
                $result = $userModel->register($username, $email, $password);
                if ($result === true) {
                    redirect(BASE_URL . "dashboard.php");
                } else {
                    $errors[] = $result;
                }
            }
        }
        // Load the register view (ensure this file exists at the specified path)
        require_once __DIR__ . '/../../app/Views/auth/register.php';
    }

    public function logout()
    {
        $userModel = new User($this->db);
        $userModel->logout();
        redirect(BASE_URL . "login.php");
    }
}
