<?php
// app/Controllers/DashboardController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../Models/Student.php';
require_once __DIR__ . '/../../includes/auth_check.php';

class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        // Ensure the user is authenticated
        ensureAuthenticated();

        // Create Student model using the database connection
        $studentModel = new Student($this->db);

        // Get search term from GET if present
        $search = isset($_GET['search']) ? trim($_GET['search']) : "";

        // Fetch students either by search or all
        if (!empty($search)) {
            $students = $studentModel->searchStudents($search);
        } else {
            $students = $studentModel->getAllStudents();
        }

        // Compute average mark for dashboard
        $averageMarks = $studentModel->calculateAverageMarks($students);

        // Load the dashboard view
        require_once __DIR__ . '/../Views/dashboard.php';
    }
}
?>