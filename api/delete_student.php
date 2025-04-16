<?php
// api/delete_student.php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../app/Models/Student.php';

$database = Database::getInstance();
$conn = $database->getConnection();

$studentModel = new Student($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $result = $studentModel->deleteStudent($id);
    if ($result === true) {
        echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $result]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>