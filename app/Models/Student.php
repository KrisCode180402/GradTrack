<?php
// app/Models/Student.php
require_once __DIR__ . '/../../includes/config.php';

class Student
{
    private $conn;

    // The constructor expects a PDO instance.
    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    // Retrieve all student records.
    public function getAllStudents()
    {
        $sql = "SELECT id, profile_picture, name, email, total_mark, percentage, grade FROM gradtrack ORDER BY id ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new student record.
    public function addStudent($profilePicture, $name, $email, $totalMark, $percentage, $grade)
    {
        $sql = "INSERT INTO gradtrack (profile_picture, name, email, total_mark, percentage, grade) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$profilePicture, $name, $email, $totalMark, $percentage, $grade])) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Insertion failed: " . $errorInfo[2];
        }
    }

    // Update an existing student record.
    public function updateStudent($id, $name, $email, $totalMark, $percentage, $grade)
    {
        $sql = "UPDATE gradtrack SET name = ?, email = ?, total_mark = ?, percentage = ?, grade = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$name, $email, $totalMark, $percentage, $grade, $id])) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Update failed: " . $errorInfo[2];
        }
    }

    // Delete a student record.
    public function deleteStudent($id)
    {
        $sql = "DELETE FROM gradtrack WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            return "Deletion failed: " . $errorInfo[2];
        }
    }

    // Calculate the average marks from an array of student records.
    public function calculateAverageMarks($students)
    {
        $total = 0;
        $count = count($students);
        if ($count === 0) return 0;
        foreach ($students as $student) {
            $total += $student['total_mark'];
        }
        return $total / $count;
    }

    // Method to search for students by name or email.
    public function searchStudents($search)
    {
        // Prepare the search term with wildcard characters.
        $searchTerm = '%' . $search . '%';
        $sql = "SELECT id, name, email FROM gradtrack WHERE name LIKE ? OR email LIKE ?";
        $stmt = $this->conn->prepare($sql);

        // Execute the query with the search term for both name and email
        $stmt->execute([$searchTerm, $searchTerm]);

        // Return all matching rows as an associative array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

