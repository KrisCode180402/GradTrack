<!-- app/Views/auth/register.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GradTrack | Register</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
    <div class="register-container mx-auto">
        <h2 class="text-center">GradTrack! Register</h2>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?= implode("<br>", $errors); ?>
            </div>
        <?php endif; ?>
        <form action="<?= BASE_URL ?>register.php" method="post">
            <div class="form-group">
                <label for="username"><i class="fa fa-user"></i> Username</label>
                <input type="text" name="username" class="form-control" placeholder="Choose a username" required />
            </div>
            <div class="form-group">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required />
            </div>
            <div class="form-group">
                <label for="password"><i class="fa fa-lock"></i> Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required />
            </div>
            <div class="form-group">
                <label for="confirm_password"><i class="fa fa-lock"></i> Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <p class="mt-3 text-center">Already have an account? <a href="<?= BASE_URL ?>login.php">Login here</a></p>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>