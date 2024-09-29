<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>


<!DOCTYPE html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<head>
    <title>Registration Form</title>
</head>
<body>
    <div class = "container justify-content-center">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="username">Username</label>
                    <input type="username" class="form-control" id="username" name = "username" placeholder="Username" required><br>
                </div>
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name = "email" placeholder="Email" required><br>
                </div>
                <div class="form-group col-md-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name = "password" placeholder="password" required><br>
                </div>
                <?php
                    if (isset($_GET['error'])) {
                        echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
                    }
                ?>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
        <p>Already have an account? <a href="login_form.php">Login</a></p>
    </div>
</body>
</html>

