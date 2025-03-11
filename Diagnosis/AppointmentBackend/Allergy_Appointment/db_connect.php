<?php
$servername = "localhost"; // Change if using a remote server
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$database = "allergy_test_db"; // Must match the created database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
