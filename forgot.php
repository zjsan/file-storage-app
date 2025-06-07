<!-- forgot_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/body.css">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/forgot.css">
</head>
<body>

<div class="form-box">
  <h2>Reset Your Password</h2>

  <?php if (isset($_GET['error'])): ?>
    <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
  <?php elseif (isset($_GET['success'])): ?>
    <p class="success"><?= htmlspecialchars($_GET['success']) ?></p>
  <?php endif; ?>

  <form action="reset_password.php" method="POST">
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="password" name="new_password" placeholder="New password" required minlength="6">
    <input type="password" name="confirm_password" placeholder="Confirm password" required minlength="6">
    <button type="submit">Reset Password</button>
  </form>

  <p style="margin-top: 1rem;"><a href="login.php">Back to Login</a></p>
</div>

</body>
</html>
