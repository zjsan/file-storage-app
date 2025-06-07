<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - KeepUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>

<header>
  <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
</header>

<main>
  <div class="card">
    <h2>📁 KeepUp</h2>
    <p>A cozy, secure digital space where you can upload, view, and manage your documents, images, and videos — anytime, anywhere.</p>
  </div>

  <div class="actions">
    <a href="upload.php">Upload Files</a>
    <a href="myfiles.php">My Files</a>
    <a href="logout.php" class="logout">Sign Out</a>
  </div>
</main>

</body>
</html>
