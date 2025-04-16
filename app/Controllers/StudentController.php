<?php
// app/Controllers/StudentController.php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/Student.php';
require_once __DIR__ . '/../../includes/auth_check.php';

class StudentController extends BaseController
{
    // Show dashboard with student list and search functionality
    public function dashboard()
    {
        ensureAuthenticated();

        $studentModel = new Student($this->db);
        $search = isset($_GET['search']) ? trim($_GET['search']) : "";
        if (!empty($search)) {
            $students = $studentModel->searchStudents($search);
        } else {
            $students = $studentModel->getAllStudents();
        }
        $averageMarks = $studentModel->calculateAverageMarks($students);

        // Load the dashboard view; it expects $students and $averageMarks variables.
        require_once __DIR__ . '/../../app/Views/dashboard.php';
    }

    // Process add new student form submission and show form if not POST
    public function addStudent()
    {
        ensureAuthenticated();
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process profile picture upload
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['profile_picture']['name'];
                $fileTmp = $_FILES['profile_picture']['tmp_name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed)) {
                    $error = "Invalid file type. Only JPG, JPEG, PNG and GIF are allowed.";
                } else {
                    // Set uploads folder relative to project root
                    $uploadDir = __DIR__ . '/../../uploads/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    // Generate a unique filename for the uploaded file
                    $newFilename = uniqid() . "." . $ext;
                    $destination = $uploadDir . $newFilename;
                    if (!move_uploaded_file($fileTmp, $destination)) {
                        $error = "Failed to move uploaded file.";
                    }
                }
            } else {
                // Set a default image path if needed
                $newFilename = "default.png";
            }

            // Get form data
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $totalMark = floatval($_POST['total_mark']);
            $percentage = floatval($_POST['percentage']);
            $grade = trim($_POST['grade']);

            // Create a new student record using the Student model
            $studentModel = new Student($this->db);
            $result = $studentModel->addStudent($newFilename, $name, $email, $totalMark, $percentage, $grade);
            if ($result === true) {
                header("Location: " . BASE_URL . "dashboard.php");
                exit;
            } else {
                $error = $result;
            }
        }
        // Load the add student view. It can display any error message if needed.
        require_once __DIR__ . '/../../app/Views/student/add.php';
    }

    // Process edit student form submission and show edit form if not POST
    public function editStudent()
    {
        ensureAuthenticated();
        $error = "";
        $studentModel = new Student($this->db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id']);
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $totalMark = floatval($_POST['total_mark']);
            $percentage = floatval($_POST['percentage']);
            $grade = trim($_POST['grade']);

            $result = $studentModel->updateStudent($id, $name, $email, $totalMark, $percentage, $grade);
            if ($result === true) {
                header("Location: " . BASE_URL . "dashboard.php");
                exit;
            } else {
                $error = $result;
            }
        } else {
            // For GET request, load the student data for editing (you can add a getStudentById method or filter from all students)
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $students = $studentModel->getAllStudents();
                $edit_student = null;
                foreach ($students as $student) {
                    if ($student['id'] == $id) {
                        $edit_student = $student;
                        break;
                    }
                }
                if (!$edit_student) {
                    $error = "Student not found.";
                }
            }
        }
        require_once __DIR__ . '/../../app/Views/student/edit.php';
    }

    // Process student deletion
    public function deleteStudent()
    {
        ensureAuthenticated();
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $studentModel = new Student($this->db);
            $result = $studentModel->deleteStudent($id);
            if ($result === true) {
                header("Location: " . BASE_URL . "dashboard.php");
                exit;
            } else {
                echo $result;
            }
        }
    }
}
?>