<?php
// app/Models/User.php

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';

class User
{
    private $db;

    public function __construct($pdo)
    {
        // $pdo should be a PDO instance provided by your Database singleton.
        $this->db = $pdo;
    }

    // Check if a username already exists
    public function isUsernameTaken($username)
    {
        $query = "SELECT id FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        return ($stmt->rowCount() > 0);
    }

    // Register a new user using PDO prepared statements
    public function register($username, $email, $password)
    {
        if ($this->isUsernameTaken($username)) {
            return "Username is already taken.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if ($stmt->execute([$username, $email, $hashedPassword])) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Registration failed: " . $errorInfo[2];
        }
    }

    // Login user; returns true if successful, or false with error passed by reference
    public function login($username, $password, &$error = null)
    {
        $query = "SELECT id, password FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);

        if (!$stmt->execute([$username])) {
            $error = "Execution failed: " . implode(" ", $stmt->errorInfo());
            return false;
        }

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                return true;
            } else {
                $error = "Invalid password.";
                return false;
            }
        } else {
            $error = "Username not found.";
            return false;
        }
    }

    // Get user details by id
    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile
    public function updateProfile($userId, $data)
    {
        $query = "UPDATE users SET email = ?, full_name = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute([$data['email'], $data['full_name'], $userId])) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Profile update failed: " . $errorInfo[2];
        }
    }

    // Reset user password
    public function resetPassword($email, $new_password)
    {
        // Check if user exists
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);

        if ($stmt->rowCount() == 0) {
            throw new Exception("Email not found");
        }

        // Update password
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute([$hashedPassword, $email])) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Password reset failed: " . $errorInfo[2];
        }
    }

    // Logout user
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>