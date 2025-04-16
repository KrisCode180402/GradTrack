<?php
// api/search_student.php

// Include configuration and required model files.
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../app/Models/Database.php';
require_once __DIR__ . '/../app/Models/Student.php';

// Get the search query from the GET parameter, trim whitespace.
$search = isset($_GET['query']) ? trim($_GET['query']) : '';

// Check if the search term is empty.
if (empty($search)) {
    echo "<div style='padding:10px; text-align:center;'>Please enter a search term.</div>";
    exit;
}

// Get the database connection.
$database = Database::getInstance();
$conn = $database->getConnection();

// Create a new Student model instance and perform the search.
$studentModel = new Student($conn);
$students = $studentModel->searchStudents($search);

// If no matching students are found, output a "No data found" message.
if (empty($students)) {
    echo "<div style='padding:10px; text-align:center;'>No data found.</div>";
    exit;
}

// Output each matching student as a suggestion div.
foreach ($students as $student) {
    echo "<div data-student-id='" . htmlspecialchars($student['id']) . "' style='border-bottom:1px solid #ddd; padding:8px; cursor:pointer;' onclick='selectStudent(" . htmlspecialchars($student['id']) . ")'>";
    echo "<strong>" . htmlspecialchars($student['name']) . "</strong> (" . htmlspecialchars($student['email']) . ")";
    echo "</div>";
}
