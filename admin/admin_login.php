<?php
include("signcon.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['email'];
            header("Location: admin.php");
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f4f4f4; }
        .login-container { width: 300px; margin: auto; padding: 20px; border-radius: 10px; background: #eee; }
        input, button { width: 100%; padding: 10px; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>


<?php
  //hashed_password = password_hash("shaik123", PASSWORD_DEFAULT);
  //$sql = "INSERT INTO admin (email, password) VALUES ('shaik@gmail.com', '$hashed_password')";
  //$conn->query($sql);
?>