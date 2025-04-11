<?php
require '../includes/db.php';
require '../includes/auth.php';
requireLogin();
requireAdmin();

$bookings = mysqli_query($conn, "SELECT b.*, u.name as user_name, e.title as event_title
  FROM bookings b
  JOIN users u ON b.user_id = u.id
  JOIN events e ON b.event_id = e.id
  ORDER BY b.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Bookings - Admin</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; margin: 0; background: #f5f5f5; }
    header, footer { background: #222; color: white; text-align: center; padding: 15px; }
    nav { background: #333; text-align: center; padding: 10px; }
    nav a { color: white; margin: 0 15px; font-weight: bold; text-decoration: none; }
    .container { max-width: 800px; margin: 30px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    h2 { text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>

<header><h1>Admin - Manage Bookings</h1></header>
<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="manage-events.php">Manage Events</a>
  <a href="manage-users.php">Manage Users</a>
  <a href="manage-bookings.php">Bookings</a>
  <a href="review-moderation.php">Reviews</a>
</nav>

<div class="container">
  <h2>All Bookings</h2>
  <table>
    <tr><th>User</th><th>Event</th><th>Name</th></tr>
    <?php while ($b = mysqli_fetch_assoc($bookings)): ?>
    <tr>
      <td><?= htmlspecialchars($b['user_name']) ?></td>
      <td><?= htmlspecialchars($b['event_title']) ?></td>
      <td><?= htmlspecialchars($b['name']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<footer>&copy; 2025 Toroni Events</footer>
</body>
</html>
