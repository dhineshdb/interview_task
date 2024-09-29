<!DOCTYPE html>
<head>
    <title>Login Form</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php
    if (isset($_GET['error'])) {
        echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
    }
?>

<body>
    <div class = "container justify-content-center">
    <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="username_or_email">Username / Email:</label>
                    <input type="text" id="username_or_email" name="username_or_email" required><br><br>
                </div>
                <div class="form-group col-md-12">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br>
                </div>
                <?php
                    if (isset($_GET['error'])) {
                        echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
                    }
                ?>
            <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
