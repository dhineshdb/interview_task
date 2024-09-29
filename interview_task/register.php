<?php
session_start();

include 'db.php';

// CSRF Protection
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed");
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    $errors = [];

    // Check minimum length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    // Check for uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    }

    // Check for special character
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $errors[] = "Password must contain at least one special character";
    }

    if (empty($errors)) {
        return ["valid" => true, "message" => "Password is strong."];
    } else {
        return ["valid" => false, "errors" => $errors];
    }
}

// Receiving form values using super global variable '$_POST'
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

if (!validateEmail($email)) {
    die("Invalid email format");
}

$validate_pswd = validatePassword($password);
if($validate_pswd['valid']!=1 && $validate_pswd['valid']!=true){
    $pswd_errors = implode(' | ',$validate_pswd['errors']);
    header("Location: index.php?error='".$pswd_errors."'"); // Redirecting back with error message
    exit();
}

// Check if username and email are unique
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: index.php?error=Username Or Email Already Exists Kindly Login"); // Redirecting back with error message
    exit();
}

// Password encryption
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    $_SESSION['loggedin'] = true;
    header("Location: home.php"); // Redirect to home page
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
