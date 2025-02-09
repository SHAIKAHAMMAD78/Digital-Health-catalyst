<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f4f4f4; }
        .container { margin: auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0px 0px 10px #aaa; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
        <p>You are now logged in.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
