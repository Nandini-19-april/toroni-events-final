<?php
require '../includes/db.php';
require '../includes/auth.php';
requireLogin();
requireAdmin();

$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - Admin</title>
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

<header><h1>Admin - Manage Users</h1></header>
<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="manage-events.php">Manage Events</a>
  <a href="manage-users.php">Manage Users</a>
  <a href="manage-bookings.php">Bookings</a>
  <a href="review-moderation.php">Reviews</a>
</nav>

<div class="container">
  <h2>All Registered Users</h2>
  <table>
    <tr><th>Name</th><th>Email</th><th>Role</th></tr>
    <?php while ($user = mysqli_fetch_assoc($users)): ?>
    <tr>
      <td><?= htmlspecialchars($user['name']) ?></td>
      <td><?= htmlspecialchars($user['email']) ?></td>
      <td><?= $user['role'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<footer>&copy; 2025 Toroni Events</footer>
</body>
</html>
