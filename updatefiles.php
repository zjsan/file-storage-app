<?php
session_start();
require_once './config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Delete file logic
if (isset($_GET['delete'])) {
    $fileId = $_GET['delete'];

    // Fetch the file path
    $stmt = $conn->prepare("SELECT file_path FROM files WHERE id = :id AND user_id = :user_id");
    $stmt->execute([':id' => $fileId, ':user_id' => $userId]);
    $file = $stmt->fetch();

    if ($file) {
        $filePath = $file['file_path'];

        // Delete file from filesystem
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete from database
        $stmt = $conn->prepare("DELETE FROM files WHERE id = :id AND user_id = :user_id");
        $stmt->execute([':id' => $fileId, ':user_id' => $userId]);
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
    <link rel="stylesheet" href="styles.css">
    <style>
        .file-list { max-width: 800px; margin: 20px auto; padding: 10px; }
        .file-row {
            display: flex;
            justify-content: space-between;
            background: #f5f5f5;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 6px;
            flex-wrap: wrap;
        }
        .file-actions a {
            margin-left: 10px;
            color: red;
            text-decoration: none;
        }
        @media (max-width: 600px) {
            .file-row { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

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
                        <a href="?delete=<?= $file['id'] ?>" onclick="return confirm('Delete this file?');">Delete</a>
                        <!-- Future: Edit / Rename / Re-upload -->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
