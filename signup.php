<?php
session_start(); // Ensure session starts before checking messages
?>

<script>
<?php if (isset($_SESSION['success'])): ?>
  alert("<?= $_SESSION['success']; ?>");
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
  alert("<?= $_SESSION['error']; ?>");
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>
</script>



<?php if (isset($_SESSION['error'])): ?>
  <div class="error" style="color: red; font-size: 0.9rem; margin-bottom: 1rem;">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    echo '<script>alert("Fail")</script>';
  </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - KeepUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/body.css">
  <link rel="stylesheet" href="./css/form-signup.css">
  <link rel="stylesheet" href="./css/form-container.css">
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
