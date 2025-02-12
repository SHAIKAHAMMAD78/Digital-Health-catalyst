<?php
include("signcon.php");
$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { 
            font-family: Arial, sans-serif; text-align: center; 
            background-image: url('https://images.unsplash.com/photo-1551076805-e1869033e561?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8aG9zcGl0YWx8ZW58MHx8MHx8fDA%3D');
        
        }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; }
        .back-button {
    display: inline-block;
    padding: 10px 20px;
    background: #3498db; /* Blue color */
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: 0.3s ease;
}

.back-button:hover {
    background: #2980b9; /* Darker blue on hover */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #89253e;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:nth-child(odd) {
    background-color: #ffffff;
}

tr:hover {
    background-color: #ddd;
}


    </style>
</head>
<body>
    <h2><b>Registered Users</b></h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Date & Time</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="tables">
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr></div>
        <?php } ?>
    </table>
    <a href="admininterface.php" class="back-button">Back</a>

</body>
</html>
