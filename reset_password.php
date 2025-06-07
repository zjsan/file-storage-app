<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $newPassword = $_POST['new_password'];

    if (empty($username) || empty($newPassword)) {
        header("Location: forgot.php?error=Please fill in all fields");
        exit;
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() === 0) {
        header("Location: forgot.php?error=Username not found");
        exit;
    }

    // Update the password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    
    if ($update->execute([$hashedPassword, $username])) {
        header("Location: forgot.php?success=Password reset successfully");
    } else {
        header("Location: forgot.php?error=Failed to reset password");
    }
    exit;
}
?>
