<?php
require 'includes/db.php';

$emails = [];
$result = mysqli_query($conn, "SELECT email FROM users");
while ($row = mysqli_fetch_assoc($result)) {
    $emails[] = $row['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Toroni Events</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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
      margin: 0 20px;
      text-decoration: none;
      font-weight: bold;
    }
    header img {
      height: 200px;
    }
    .container {
      max-width: 400px;
      margin: 30px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      text-align: center;
    }
    .alert {
      display: none;
      background: #ffdddd;
      color: red;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid red;
      border-radius: 6px;
    }
    input, button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      background: #00bcd4;
      color: white;
      border: none;
    }
    button:hover {
      background: #0097a7;
    }
  </style>
</head>
<body>

<header>
  <img src="img/t.jpg" alt="Logo">
</header>

<nav>
  <a href="index.html">Home</a>
  <a href="login.php">Login</a>
  <a href="signup.php">Sign Up</a>
  <a href="events.php">Events</a>
  <a href="services.html">Services</a>
  <a href="review.php">Review</a>
</nav>

<div class="container">
  <div id="emailAlert" class="alert">
    ⚠️ This email is not registered.<br>
    <a href="signup.php" style="color:#007BFF;">Click here to sign up</a>
  </div>

  <form id="loginForm" method="POST" action="includes/login.php">
    <h2>Login</h2>
    <input type="email" name="email" id="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</div>

<footer>
  &copy; 2025 Toroni Events. All rights reserved.
</footer>

<script>
  const existingEmails = <?php echo json_encode($emails); ?>;
  const form = document.getElementById('loginForm');
  const emailInput = document.getElementById('email');
  const alertBox = document.getElementById('emailAlert');

  form.addEventListener('submit', function (e) {
    const email = emailInput.value.trim().toLowerCase();
    if (!existingEmails.includes(email)) {
      e.preventDefault();
      alertBox.style.display = 'block';
    }
  });
</script>

</body>
</html>
