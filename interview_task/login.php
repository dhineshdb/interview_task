<?php
session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Prepare statement to find user by username or email
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['loggedin'] = true;
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            header("Location: login_form.php?error=Invalid password"); // Redirecting back with error message
            exit();
        }
    } else {
        header("Location: login_form.php?error=No user found"); // Redirecting back with error message
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
