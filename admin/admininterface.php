<?php
include("signcon.php");
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { 
            font-family: Arial, sans-serif; text-align: center; background: #f4f4f4;
            background-image: url('https://images.rawpixel.com/image_800/czNmcy1wcml2YXRlL3Jhd3BpeGVsX2ltYWdlcy93ZWJzaXRlX2NvbnRlbnQvbHIvdjg3MC10YW5nLTM2XzEuanBn.jpg');
         }
        .container { width: 80%; margin: auto; }
        .nav { display: flex; justify-content: space-around; background: #35424a; padding: 15px; }
        .nav a { color: white; text-decoration: none; font-size: 18px; }
        .nav a:hover { background-color: #e8491d; padding: 5px 10px; border-radius: 5px; }
        .content { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="doctors.php">Doctors</a> <!-- Assuming doctors.php exists -->
        <a href="appointments.php">Appointments</a> <!-- Assuming appointments.php exists -->
        <a href="admin/Usersignin/usersignupdetails.php">New Users</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h2>Welcome to the Admin Dashboard</h2>
    </div>

</body>
</html>
