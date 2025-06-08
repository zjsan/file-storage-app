<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include './config/db.php'; //DB connection file

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['files'])) {
    $userId = $_SESSION['user_id'];
    $uploadDir = "uploads/";

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['files']['name'][$key]);
        $fileSize = $_FILES['files']['size'][$key];
        $fileType = $_FILES['files']['type'][$key];
        $fileTmp = $_FILES['files']['tmp_name'][$key];

        $targetPath = $uploadDir . time() . '_' . $fileName;

        // Optional: limit file types and size
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'video/mp4', 'video/mpeg', 'txt'];
        if (!in_array($fileType, $allowedTypes)) {
            $message .= "<p style='color:red;'>File type not allowed: $fileName</p>";
            continue;
        }

        if ($fileSize > 25 * 1024 * 1024) { // 25MB max
            $message .= "<p style='color:red;'>File too large: $fileName</p>";
            continue;
        }

        if (move_uploaded_file($fileTmp, $targetPath)) {
            // Insert metadata into DB
             // With this (PDO version):
            $sql = "INSERT INTO files (user_id, file_name, file_type, file_size, file_path, uploaded_at) 
                    VALUES (:user_id, :file_name, :file_type, :file_size, :file_path, NOW())";

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':file_name' => $fileName,
                ':file_type' => $fileType,
                ':file_size' => $fileSize,
                ':file_path' => $targetPath
            ]);

            echo "<script>alert('Uploaded successfully: $fileName');</script>";
        } else {
            echo "<script>alert('Failed to upload: $fileName');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - KeepUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/upload.css">
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


<div class="main-container">
    <main>
    <div class="card">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
        <p>Securely manage your documents, images, and videos across any device. Use the links above to start uploading or managing your files.</p>
    </div>
    
    </main>
</div>
    


<div class="container">
    <h2>📤 Upload Your Files</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple required><br>
        <button type="submit">Upload</button>
    </form>

    <div class="message">
        <?= $message ?>
    </div>
</div>




<script src="./js/hamburger.js"></script>
</body>

</body>
</html>
