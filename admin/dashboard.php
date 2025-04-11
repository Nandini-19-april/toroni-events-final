<?php
require '../includes/db.php';
require '../includes/auth.php';
requireLogin();
requireAdmin(); // Only admin can access this

// Count stats
$userCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$eventCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM events"))['total'];
$bookingCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM bookings"))['total'];
$reviewCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM reviews"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Toroni Events</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #ffffff, #f7f7f7);
    }
    header, footer {
      background: #222;
      color: white;
      padding: 15px;
      text-align: center;
    }
    nav {
      background: #333;
      text-align: center;
      padding: 10px;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
    }
    .container {
      max-width: 1000px;
      margin: 40px auto;
      text-align: center;
    }
    .stat-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      margin-top: 30px;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .card h3 {
      color: #00bcd4;
      font-size: 26px;
      margin: 10px 0;
    }
    .card span {
      font-size: 40px;
      color: #333;
    }
  </style>
</head>
<body>

<header>
  <h1>Toroni Events Admin Dashboard</h1>
</header>

<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="manage-events.php">Manage Events</a>
  <a href="manage-users.php">Manage Users</a>
  <a href="manage-bookings.php">Bookings</a>
  <a href="review-moderation.php">Reviews</a>
  <a href="../index.html">Home</a>
</nav>

<div class="container">
  <h2>Quick Stats</h2>
  <div class="stat-grid">
    <div class="card">
      <h3>Total Users</h3>
      <span><?= $userCount ?></span>
    </div>
    <div class="card">
      <h3>Total Events</h3>
      <span><?= $eventCount ?></span>
    </div>
    <div class="card">
      <h3>Total Bookings</h3>
      <span><?= $bookingCount ?></span>
    </div>
    <div class="card">
      <h3>Total Reviews</h3>
      <span><?= $reviewCount ?></span>
    </div>
  </div>
</div>

<footer>
  &copy; 2025 Toroni Events. Admin Panel.
</footer>

</body>
</html>
