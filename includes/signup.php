<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check for duplicate email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered. Please log in.');
        window.location.href='../login.php';</script>";
        exit;
    }

    // Insert new user
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Sign up successful. You can now log in.');
        window.location.href='../login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../signup.php");
    exit;
}
?>
