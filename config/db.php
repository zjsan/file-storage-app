<?php
$host = 'localhost';
$dbname = 'filestorage_db';
$username = 'root';
$password = ''; // Default for XAMPP

try {
    // PDO Connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Uncomment this for debugging success
    // echo "Connected successfully";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
