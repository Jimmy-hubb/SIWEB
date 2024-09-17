<?php
// Database configuration
$host = 'localhost';
$db   = 'user_system';
$user = 'root'; // Change to your MySQL username
$pass = '';     // Change to your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
