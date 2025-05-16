<?php
$conn = new mysqli("localhost", "root", "", "user_db");
if ($conn->connect_error) die("Connection failed.");

$email = $_POST['email'];
$sql = "SELECT * FROM admin WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Redirect to reset form
    header("Location: reset_form.php?email=" . urlencode($email));
} else {
    echo "<script>alert('Email not found!'); window.location='index.html';</script>";
}
?>
