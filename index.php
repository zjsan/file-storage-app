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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<nav>
  <div class="logo">📁 KeepUp</div>

    <div class="hamburger" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
    </div>
  <div class="nav-links">
    <a href="index.php">Home</a>
    <a href="upload.php">Upload</a>
    <a href="myfiles.php">My Files</a>
    <a href="logout.php">Sign Out</a>
  </div>
</nav>

<main>
  <div class="card">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
    <p>Securely manage your documents, images, and videos across any device. Use the links above to start uploading or managing your files.</p>
  </div>
</main>



<script src="./js/hamburger.js"></script>
</body>

</body>
</html>
