<?php
session_start();
require_once './config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Delete file logic
// Rename logic
if (isset($_POST['rename_file'])) {
    $fileId = $_POST['file_id'];
    $newName = trim($_POST['new_file_name']);

    if (!empty($newName)) {
        $stmt = $conn->prepare("UPDATE files SET file_name = :new_name WHERE id = :id AND user_id = :user_id");
        $stmt->execute([
            ':new_name' => $newName,
            ':id' => $fileId,
            ':user_id' => $userId
        ]);
    }

    header("Location: myfiles.php");
    exit;
}


// Fetch all user files
$stmt = $conn->prepare("SELECT * FROM files WHERE user_id = :user_id ORDER BY uploaded_at DESC");
$stmt->execute([':user_id' => $userId]);
$files = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Files</title>
       <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/myfiles.css">
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
    <a href="myfiles.php">My Files</a>
    <a href="logout.php">Sign Out</a>
  </div>
</nav>


    <div class="file-list">
        <h2>My Uploaded Files</h2>

        <?php if (count($files) === 0): ?>
            <p>No files uploaded yet.</p>
        <?php else: ?>
            <?php foreach ($files as $file): ?>
                <div class="file-row">
                    <div>
                        <strong><?= htmlspecialchars($file['file_name']) ?></strong> (<?= $file['file_type'] ?>) – 
                        <?= round($file['file_size'] / 1024, 2) ?> KB – 
                        <em><?= $file['uploaded_at'] ?></em>
                    </div>
                    <div class="file-actions">
                        <a href="<?= $file['file_path'] ?>" download>Download</a>
                        <a href="#" onclick="toggleRename(<?= $file['id'] ?>); return false;">Rename</a>
                        <a href="?delete=<?= $file['id'] ?>" onclick="return confirm('Delete this file?');">Delete</a>
                    </div>

                    <!-- Rename Form (hidden by default) -->
                    <form class="rename-form" id="rename-form-<?= $file['id'] ?>" action="myfiles.php" method="POST" style="display: none; margin-top: 10px;">
                        <input type="hidden" name="file_id" value="<?= $file['id'] ?>">
                        <input type="text" name="new_file_name" placeholder="New file name" value="<?= htmlspecialchars($file['file_name']) ?>" required>
                        <button type="submit" name="rename_file">Save</button>
                    </form>
                    <!--- Future features ditoy nga part --->
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<script src="./js/rename.js"></script>    
</body>
</html>
