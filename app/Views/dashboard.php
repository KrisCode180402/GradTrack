<!-- app/Views/dashboard.php -->
<?php
require_once __DIR__ . '/../../includes/auth_check.php';
ensureAuthenticated();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradTrack | Dashboard</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <!-- Bootstrap 4.5 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Gradient background and global settings */
        body {
            background: linear-gradient(135deg, #6c5ce7, #00b894);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Dashboard header styles with animation */
        .dashboard-header {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 0.8s ease-in-out;
        }

        .dashboard-header h2 {
            font-size: 2.5rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .dashboard-header h2:hover {
            transform: scale(1.05);
        }

        /* Search container styling */
        .search-container {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
            padding: 15px;
            transition: transform 0.3s ease;
        }

        .search-container:hover {
            transform: translateY(-3px);
        }

        .search-container button {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .search-container button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Scrollable table container */
        .table-container {
            overflow-x: auto;
            background: #ffffffcc;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            animation: fadeIn 1s ease;
        }

        /* Table row hover effects */
        .table-container table tbody tr {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .table-container table tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Modal enhancements */
        .modal-content {
            border-radius: 10px;
            animation: fadeIn 0.5s ease;
        }

        /* Footer styling */
        footer {
            background: #343a40;
            color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            animation: fadeInUp 0.8s ease;
        }

        /* Animations */
        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Suggestion box styling */
        #suggestionBox {
            background: #fff;
            border: 1px solid #ccc;
            position: absolute;
            width: 100%;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            display: none;
        }

        #suggestionBox div:hover {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="dashboard-header">
            <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></h2>
            <a href="<?= BASE_URL ?>logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="dashboard-content">
            <div class="search-container mb-3">
                <input type="text" id="searchBox" class="form-control" placeholder="Search student by name...">
                <button id="searchBtn" class="btn btn-primary ml-2">
                    <i class="fa fa-search"></i> Search
                </button>
                <div id="suggestionBox"></div>
            </div>

            <div class="table-container">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Mark</th>
                            <th>Percentage</th>
                            <th>Grade</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="studentData">
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                                <tr id="studentRow-<?= $student['id'] ?>">
                                    <td><?= $student['id'] ?></td>
                                    <td>
                                        <img src="<?= htmlspecialchars($student['profile_picture']) ?>" alt="Profile Picture" class="profile-img" style="width:50px; height:50px; border-radius:50%;">
                                    </td>
                                    <td><?= strtoupper(htmlspecialchars($student['name'])) ?></td>
                                    <td><?= htmlspecialchars($student['email']) ?></td>
                                    <td><?= $student['total_mark'] ?></td>
                                    <td><?= number_format($student['percentage'], 2) . '%' ?></td>
                                    <td><?= htmlspecialchars($student['grade']) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-button-link" data-student-id="<?= $student['id'] ?>">Edit</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger delete-button-link" data-student-id="<?= $student['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">No student records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center">
                                <a href="<?= BASE_URL ?>student_add.php" class="btn btn-success">Add New Student</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-center mt-3">
                <h4>Average Grade: <?= number_format($averageMarks, 2) ?></h4>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editStudentForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Total Mark</label>
                            <input type="number" name="total_mark" class="form-control" step="any" required>
                        </div>
                        <div class="form-group">
                            <label>Percentage</label>
                            <input type="number" name="percentage" class="form-control" step="any" required>
                        </div>
                        <div class="form-group">
                            <label>Grade</label>
                            <input type="text" name="grade" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/student.js"></script>

    <!-- Additional JavaScript for Interactivity & Animations -->
    <script>
        // Smooth scroll for internal anchor links (if needed)
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener("click", function(e) {
                    e.preventDefault();
                    var targetElement = document.querySelector(this.getAttribute("href"));
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: "smooth"
                        });
                    }
                });
            });
        });

        // Edit Button Click Handler: use AJAX to load student data into the modal
        $(".edit-button-link").click(function() {
            var studentId = $(this).data("student-id");
            $.ajax({
                url: "<?= BASE_URL ?>api/get_student.php",
                method: "GET",
                data: {
                    student_id: studentId,
                    format: 'json'
                },
                dataType: "json",
                success: function(data) {
                    if (data.error) {
                        alert("Error: " + data.error);
                    } else {
                        // Populate modal fields with student data
                        $("#editStudentForm input[name='id']").val(data.id);
                        $("#editStudentForm input[name='name']").val(data.name);
                        $("#editStudentForm input[name='email']").val(data.email);
                        $("#editStudentForm input[name='total_mark']").val(data.total_mark);
                        $("#editStudentForm input[name='percentage']").val(data.percentage);
                        $("#editStudentForm input[name='grade']").val(data.grade);
                        // Open modal
                        $("#editStudentModal").modal("show");
                    }
                },
                error: function() {
                    alert("Error retrieving student data.");
                }
            });
        });
    </script>
</body>

</html>