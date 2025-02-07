<?php
   require_once('dbs/db.php');
   $query="select * from signup";
   $result=mysqli_query($con,$query);

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
