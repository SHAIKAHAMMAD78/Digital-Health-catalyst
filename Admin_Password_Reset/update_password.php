<?php
$conn = new mysqli("localhost", "root", "", "user_db");
if ($conn->connect_error) die("Connection failed.");

$email = $_POST['email'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

if ($new !== $confirm) {
    echo "<script>alert('Passwords do not match!'); history.back();</script>";
    exit();
}

$hashed = password_hash($new, PASSWORD_BCRYPT);

$sql = "UPDATE admin SET password = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hashed, $email);

if ($stmt->execute()) {
    echo "<script>alert('Password updated successfully!'); window.location='http://localhost/final%20year%20project-2025/admin_login.php';</script>";
} else {
    echo "<script>alert('Error updating password.'); history.back();</script>";
}
?>
