<?php
require '../includes/db.php';
require '../includes/auth.php';
requireLogin();
requireAdmin();

$reviews = mysqli_query($conn, "SELECT r.*, u.name as user_name, e.title as event_title
  FROM reviews r
  JOIN users u ON r.user_id = u.id
  JOIN events e ON r.event_id = e.id
  ORDER BY r.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Moderate Reviews - Admin</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; margin: 0; background: #f5f5f5; }
    header, footer { background: #222; color: white; text-align: center; padding: 15px; }
    nav { background: #333; text-align: center; padding: 10px; }
    nav a { color: white; margin: 0 15px; font-weight: bold; text-decoration: none; }
    .container { max-width: 900px; margin: 30px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    h2 { text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>

<header><h1>Admin - Review Moderation</h1></header>
<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="manage-events.php">Manage Events</a>
  <a href="manage-users.php">Manage Users</a>
  <a href="manage-bookings.php">Bookings</a>
  <a href="review-moderation.php">Reviews</a>
</nav>

<div class="container">
  <h2>User Reviews</h2>
  <table>
    <tr><th>User</th><th>Event</th><th>Rating</th><th>Comment</th></tr>
    <?php while ($r = mysqli_fetch_assoc($reviews)): ?>
    <tr>
      <td><?= htmlspecialchars($r['user_name']) ?></td>
      <td><?= htmlspecialchars($r['event_title']) ?></td>
      <td><?= $r['rating'] ?></td>
      <td><?= htmlspecialchars($r['comment']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<footer>&copy; 2025 Toroni Events</footer>
</body>
</html>
