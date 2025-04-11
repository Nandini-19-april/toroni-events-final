<?php
require 'includes/db.php';
require 'includes/auth.php';
requireLogin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $sql = "INSERT INTO bookings (user_id, event_id, name) VALUES ('$user_id', '$event_id', '$name')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking successful!');
        window.location.href='events.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit;
}

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Event - Toroni Events</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      margin: 0;
    }
    header, footer {
      background-color: #222;
      color: white;
      text-align: center;
      padding: 15px;
    }
    nav {
      background-color: #222;
      text-align: center;
      padding: 15px;
    }
    nav a {
      color: white;
      text-decoration: none;
      margin: 0 20px;
      font-weight: bold;
    }
    header img {
      height: 80px;
    }
    .container {
      max-width: 400px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      text-align: center;
    }
    input, button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #00bcd4;
      color: white;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0097a7;
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
</nav>

<div class="container">
  <h2>Book This Event</h2>
  <form method="POST">
    <input type="hidden" name="event_id" value="<?= htmlspecialchars($event_id) ?>">
    <input name="name" placeholder="Your Name" required>
    <button type="submit">Confirm Booking</button>
  </form>
</div>

<footer>
  &copy; 2025 Toroni Events. All rights reserved.
</footer>

</body>
</html>
