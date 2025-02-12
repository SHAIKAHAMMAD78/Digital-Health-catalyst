<?php
include("signcon.php");
session_start();

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['reset_email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Update password
    $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
    
    if ($conn->query($sql) === TRUE) {
        session_destroy();
        echo "<script>alert('Password changed successfully!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error updating password!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            background: #7bbee8;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #66aee1;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Reset Password</h2>
    <form method="POST" action="">
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <button type="submit" class="btn">Change Password</button>
    </form>
</div>

</body>
</html>
