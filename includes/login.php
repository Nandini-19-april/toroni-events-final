<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            // Password matched
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../events.php");
            }
            exit;
        } else {
            echo "<script>alert('Invalid password.'); window.location.href='../login.php';</script>";
        }
    } else {
        echo "<script>alert('Account not found. Please sign up first.'); window.location.href='../signup.php';</script>";
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
