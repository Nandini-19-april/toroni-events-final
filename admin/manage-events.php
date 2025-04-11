<?php
require '../includes/db.php';
require '../includes/auth.php';
requireLogin();
requireAdmin();

// Handle event deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM events WHERE id = $id");
    header("Location: manage-events.php");
    exit;
}

// Handle event addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = $_POST['date'];
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    mysqli_query($conn, "INSERT INTO events (title, description, date, location) VALUES ('$title', '$description', '$date', '$location')");
    header("Location: manage-events.php");
    exit;
}

$events = mysqli_query($conn, "SELECT * FROM events ORDER BY date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Events - Admin</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: #f5f5f5;
    }
    header, footer {
      background: #222;
      color: white;
      text-align: center;
      padding: 15px;
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
      max-width: 800px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    form input, form textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    form button {
      background-color: #00bcd4;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    .delete-link {
      color: red;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>
<body>

<header>
  <h1>Admin - Manage Events</h1>
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
  <h2>Add New Event</h2>
  <form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="description" placeholder="Event Description" required></textarea>
    <input type="date" name="date" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit">Add Event</button>
  </form>

  <h2>All Events</h2>
  <table>
    <tr>
      <th>Title</th>
      <th>Date</th>
      <th>Location</th>
      <th>Action</th>
    </tr>
    <?php while ($event = mysqli_fetch_assoc($events)): ?>
    <tr>
      <td><?= htmlspecialchars($event['title']) ?></td>
      <td><?= $event['date'] ?></td>
      <td><?= htmlspecialchars($event['location']) ?></td>
      <td><a class="delete-link" href="?delete=<?= $event['id'] ?>" onclick="return confirm('Delete this event?')">Delete</a></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<footer>
  &copy; 2025 Toroni Events. Admin Panel.
</footer>

</body>
</html>
