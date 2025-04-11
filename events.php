<?php
require 'includes/db.php';
require 'includes/auth.php';
requireLogin();

$result = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upcoming Events - Toroni Events</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #fdfbfb, #ebedee);
      margin: 0;
    }
    header, footer {
      background-color: #222;
      color: white;
      text-align: center;
      padding: 15px;
    }
    header img {
      height: 80px;
    }
    nav {
      background-color: #222;
      padding: 15px;
      text-align: center;
    }
    nav a {
      color: white;
      margin: 0 20px;
      font-weight: bold;
      text-decoration: none;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .event {
      margin-bottom: 30px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
    }
    .event h2 {
      color: #333;
    }
    .event p {
      color: #555;
    }
    .event a {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 15px;
      background-color: #00bcd4;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    .event a:hover {
      background-color: #008c9e;
    }
  </style>
</head>
<body>

<header>
  <img src="img/t.jpg" alt="Toroni Events Logo">
</header>

<nav>
  <a href="index.html">Home</a>
  <a href="events.php">Events</a>
  <a href="book.php">Book</a>
  <a href="review.php">Review</a>
  <a href="login.php">Login</a>
  <a href="signup.php">Sign Up</a>
</nav>

<div class="container">
  <h1>Upcoming Events</h1>
  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="event">
      <h2><?= htmlspecialchars($row['title']) ?></h2>
      <p><?= htmlspecialchars($row['description']) ?></p>
      <p><strong>Date:</strong> <?= $row['date'] ?> | <strong>Location:</strong> <?= $row['location'] ?></p>
      <a href="book.php?event_id=<?= $row['id'] ?>">Book Now</a>
    </div>
  <?php endwhile; ?>
</div>

<footer>
  &copy; 2025 Toroni Events. All rights reserved.
</footer>

</body>
</html>
