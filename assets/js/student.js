// assets/js/student.js

// Ensure BASE_URL is defined (adjust if necessary)
if (typeof BASE_URL === 'undefined') {
    var BASE_URL = 'http://localhost/GradTrack/'; // Adjust as needed
}

$(document).ready(function() {
    // Edit button click event (delegated for dynamically added rows)
    $(document).on('click', '.edit-button-link', function(e) {
        e.preventDefault();
        var studentId = $(this).data('student-id');
        if (studentId) {
            $.ajax({
                url: BASE_URL + "api/get_student.php",
                method: "GET",
                data: { student_id: studentId, format: 'json' },
                dataType: "json",
                success: function(response) {
                    console.log("AJAX Response:", response);
                    if (response.error) {
                        alert("Error: " + response.error);
                    } else {
                        // Populate modal form fields with student data
                        $('#editStudentForm input[name="id"]').val(response.id);
                        $('#editStudentForm input[name="name"]').val(response.name);
                        $('#editStudentForm input[name="email"]').val(response.email);
                        $('#editStudentForm input[name="total_mark"]').val(response.total_mark);
                        $('#editStudentForm input[name="percentage"]').val(response.percentage);
                        $('#editStudentForm input[name="grade"]').val(response.grade);
                        // Open the modal
                        $("#editStudentModal").modal("show");
                    }
                },
                error: function() {
                    alert("Error retrieving student data.");
                }
            });
        }
    });

    // Handle edit form submission using AJAX to update student data
    $('#editStudentForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + "api/edit_student.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    alert("Student updated successfully.");
                    location.reload();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function() {
                alert("Error updating student data.");
            }
        });
    });

    // Delete button click event for student deletion
    $(document).on('click', '.delete-button-link', function(e) {
        e.preventDefault();
        if (!confirm("Are you sure you want to delete this record?")) return;
        var studentId = $(this).data('student-id');
        $.ajax({
            url: BASE_URL + "api/delete_student.php",
            method: "POST",
            data: { id: studentId },
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    alert("Student deleted successfully.");
                    location.reload();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function() {
                alert("Error deleting student.");
            }
        });
    });
});
