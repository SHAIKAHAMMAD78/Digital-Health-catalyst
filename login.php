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
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .form-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 400px;
            margin: auto;
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
        .signup-link {
            margin-top: 15px;
            display: block;
            color: #35424a;
            text-decoration: none;
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
        </form>
        <a href="signup.php" class="signup-link">Don't have an account? Sign Up</a>
    </div>
</body>
</html>


