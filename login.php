<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - KeepUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/body.css">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/form-container.css">
</head>
<body>


<div class="container">
    <div class="hero">
  <h1>KeepUp</h1>
  <p>A cozy, secure digital space</p>

    <div class="form-container">
    <h2>Login</h2>
    <?php if (isset($_GET['error'])): ?>
        <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="success"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <form method="POST" action="login_process.php">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
    </form>

    <p style="margin-top: 1rem; font-size: 0.9rem;">Don't have an account? <a href="signup.php">Sign up</a></p>
    <p style="margin-top: 1rem; font-size: 0.9rem;">Forgot Password? <a href="forgot.php">Click Here</a></p>
    </div>
</div>


</body>
</html>
