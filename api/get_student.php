<?php
// api/get_student.php

// Include configuration and database files
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../app/Models/Student.php';

// Get the student ID from the GET parameter; default to 0 if not provided
$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;
if ($student_id === 0) {
    if (isset($_GET['format']) && $_GET['format'] == 'json') {
        header('Content-Type: application/json');
        echo json_encode(["error" => "Student not found."]);
        exit;
    } else {
        echo "<tr><td colspan='9'>Student not found.</td></tr>";
        exit;
    }
}

$database = Database::getInstance();
$pdo = $database->getConnection();
$studentModel = new Student($pdo);

// Fetch student record using prepared statement.
$sql = "SELECT id, profile_picture, name, email, total_mark, percentage, grade FROM gradtrack WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// If JSON format requested, output JSON and exit immediately.
if (isset($_GET['format']) && $_GET['format'] === 'json') {
    header('Content-Type: application/json');
    if ($student) {
        echo json_encode($student);
    } else {
        echo json_encode(["error" => "Student not found."]);
    }
    exit;
}

// (For non-JSON output, output HTML as before)
if ($student):
?>
    <tr id="studentRow-<?= htmlspecialchars($student['id']) ?>">
        <td><?= htmlspecialchars($student['id']) ?></td>
        <td><img src="<?= htmlspecialchars($student['profile_picture']) ?>" alt="Profile Picture" class="profile-img" /></td>
        <td><?= strtoupper(htmlspecialchars($student['name'])) ?></td>
        <td><?= htmlspecialchars($student['email']) ?></td>
        <td><?= htmlspecialchars($student['total_mark']) ?></td>
        <td><?= number_format($student['percentage'], 2) . '%' ?></td>
        <td><?= htmlspecialchars($student['grade']) ?></td>
        <td><a href="<?= BASE_URL ?>dashboard.php?edit_id=<?= htmlspecialchars($student['id']) ?>" class="btn btn-sm btn-warning">Edit</a></td>
        <td><a href="<?= BASE_URL ?>dashboard.php?delete_id=<?= htmlspecialchars($student['id']) ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-sm btn-danger">Delete</a></td>
    </tr>
<?php
else:
    echo "<tr><td colspan='9'>Student not found.</td></tr>";
endif;
?>