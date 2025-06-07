<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Basic validation
    if (empty($username) || empty($password)) {
        die("All fields are required.");
    }

    // Check if username exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        die("Username already exists.");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($insert->execute([$username, $hashedPassword])) {
        header("Location: login.php?signup=success");
        exit;
    } else {
        die("Error creating account.");
    }
}
?>
