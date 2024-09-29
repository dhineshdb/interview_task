<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Welcome!</h2>
    <p>Logged In Successfully!</p>
    
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
