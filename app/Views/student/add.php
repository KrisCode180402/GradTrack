
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student | GradTrack</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="form-container">
        <h2 class="text-center">Add New Student</h2>
        <form action="<?= BASE_URL ?>student_add.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Student Name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Student Email" required>
            </div>
            <div class="form-group">
                <label>Total Mark</label>
                <input type="number" name="total_mark" class="form-control" placeholder="Total Mark" step="any" required>
            </div>
            <div class="form-group">
                <label>Percentage</label>
                <input type="number" name="percentage" class="form-control" placeholder="Percentage" step="any" required>
            </div>
            <div class="form-group">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control" placeholder="Grade" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Student</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>