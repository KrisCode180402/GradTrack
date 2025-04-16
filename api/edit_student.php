<?php
// GradTrack/api/edit_student.php

// Include configuration and database connection
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php'; 
require_once __DIR__ . '/../app/Models/Student.php';

// Set the content type to JSON for the AJAX response
header('Content-Type: application/json');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;
}

// Retrieve and sanitize POST data
$id         = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name       = isset($_POST['name']) ? trim($_POST['name']) : '';
$email      = isset($_POST['email']) ? trim($_POST['email']) : '';
$totalMark  = isset($_POST['total_mark']) ? floatval($_POST['total_mark']) : 0;
$percentage = isset($_POST['percentage']) ? floatval($_POST['percentage']) : 0;
$grade      = isset($_POST['grade']) ? trim($_POST['grade']) : '';

// Validate required fields
if ($id <= 0 || empty($name) || empty($email)) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Missing required fields.'
    ]);
    exit;
}

// Get the database connection (PDO instance)
$db = Database::getInstance();
$pdo = $db->getConnection();
// Create a new instance of the Student model
$studentModel = new Student($pdo);

// Attempt to update the student record
$result = $studentModel->updateStudent($id, $name, $email, $totalMark, $percentage, $grade);

if ($result === true) {
    echo json_encode([
        'status'  => 'success',
        'message' => 'Student updated successfully.'
    ]);
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => $result 
    ]);
}
?>
