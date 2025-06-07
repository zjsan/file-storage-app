<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect if already logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - File Storage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/body.css">
  <link rel="stylesheet" href="./css/form-signup.css">
</head>
<body>

<div class= "container">
  <div class="hero">
  <h1>KeepUp</h1>
  <p>A cozy, secure digital space</p>
</div>
<div class="form-container">
  <h2>Create Account</h2>
  <form method="POST" action="signup_process.php">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required minlength="6"/>

    <div class="form-buttons">
      <button type="submit">Sign Up</button>
      <span><a href="login.php">Login</a></span>
    </div>
  
  </form>
</div>
</div>


</body>
</html>
