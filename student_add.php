<?php
// student_add.php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/app/Controllers/StudentController.php';

$studentController = new StudentController();
$studentController->addStudent();
?>