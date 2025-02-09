<?php
include("signcon.php");
$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; }
    </style>
</head>
<body>
    <h2>Admin Panel - Registered Users</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Mobile</th><th>Email</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['email']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
