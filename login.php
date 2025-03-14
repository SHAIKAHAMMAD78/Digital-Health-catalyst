<?php
include("signcon.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['name'];
            header("Location: front.html");
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(119, 208, 243);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .form-container {
            background: #ffffff;
            background-image: url('https://st4.depositphotos.com/3441621/28233/i/450/depositphotos_282336788-stock-photo-smiling-medical-doctor-woman-with.jpg');
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 400px;
            width: 100%; /* Make sure it takes up 100% of available space up to max-width */
            text-align: center;
        }
        input {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .att {
            padding: 10px;
            background: #7bbee8;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .att:hover {
            background-color: #66aee1;
        }
        .signup-link, .forgot-password {
            margin-top: 15px;
            display: block;
            color: #35424a;
            text-decoration: none;
            font-weight: bold;
        }
        .forgot-password {
            background-color: skyblue;
            padding: 5px 10px; /* Reduced padding to make it smaller */
            border-radius: 5px;
            color: white;
            font-size: 14px; /* Reduced font size */
            margin: 10px 0;
        }
        .forgot-password:hover {
            background-color: #66aee1;
        }
        .signup-btn {
            padding: 10px;
            background: #7bbee8;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .signup-btn:hover {
            background-color: #66aee1;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login to Your Account</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="att">Log in</button>

            <!-- Forgot Password link placed between Login and Sign Up buttons -->
            <a href="forgot_password.php" class="forgot-password">Forgot Password</a>

            <!-- Sign Up Button -->
            <button class="signup-btn" onclick="window.location.href='signup.php'">Don't have an account? Sign Up</button>
        </form>
    </div>
</body>
</html>




