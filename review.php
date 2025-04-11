<?php
require 'includes/db.php';
require 'includes/auth.php';
requireLogin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $event_id = $_POST['event_id'];
    $rating = $_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "INSERT INTO reviews (user_id, event_id, rating, comment) VALUES ('$user_id', '$event_id', '$rating', '$comment')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Review submitted successfully!'); window.location.href='events.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit;
}

// Fetch event options
$event_options = mysqli_query($conn, "SELECT id, title FROM events");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit a Review - Toroni Events</title>
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
      max-width: 500px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      text-align: center;
    }
    input, select, textarea, button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    textarea {
      resize: vertical;
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
  <img src="images/logo.png" alt="Toroni Events Logo">
</header>

<nav>
  <a href="index.html">Home</a>
  <a href="events.php">Events</a>
  <a href="book.php">Book</a>
  <a href="review.php">Review</a>
</nav>

<div class="container">
  <h2>Leave a Review</h2>
  <form method="POST">
    <select name="event_id" required>
      <option value="">-- Select an Event --</option>
      <?php while ($event = mysqli_fetch_assoc($event_options)): ?>
        <option value="<?= $event['id'] ?>"><?= htmlspecialchars($event['title']) ?></option>
      <?php endwhile; ?>
    </select>

    <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" required>
    <textarea name="comment" placeholder="Write your review..." required></textarea>
    <button type="submit">Submit Review</button>
  </form>
</div>

<footer>
  &copy; 2025 Toroni Events. All rights reserved.
</footer>

</body>
</html>
