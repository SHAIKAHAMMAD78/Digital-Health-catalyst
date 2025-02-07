<?php
require 'dbs/db.php'; // Include the database connection
$query="select * from signup";
$result=mysqli_query($con,$query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile_number'];
    $email = $_POST['email'];
    // Hash the password for security

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO signup (name, mobile, email) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $mobile, $email])) {
        echo json_encode(['status' => 'success', 'message' => 'User registered successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User registration failed.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Example</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>mobile</th>
                <th>time</th>
            </tr>
            <tr>
                <?php
                  while($row=mysqli_fetch_assoc($result)){

                ?>

                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['mobile_number']; ?></td>
                <td><?php echo $row['time']; ?></td>
            </tr>
                <?php
                  }
                ?>
        </thead>
        <tbody>
            <!-- Table data will go here -->
        </tbody>
    </table>
</body>
</html>
