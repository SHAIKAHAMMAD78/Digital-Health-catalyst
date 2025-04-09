<?php
require 'db_connect.php';

$sql = "SELECT * FROM pcos_tests ORDER BY created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - PCOS Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }.back-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #0056b3;}
    </style>
</head>
<body>
    <h2> PCOS Test Appointment Records</h2>
    <a href="http://localhost/final%20year%20project-2025/Diagnosis_Appointments.html" class="back-btn">⬅ Back</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Test Name</th>
            <th>Center Name</th> 
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Booked At</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["patient_name"] ?></td>
            <td><?= $row["patient_age"] ?></td>
            <td><?= $row["patient_phone"] ?></td>
            <td><?= $row["patient_email"] ?></td>
            <td><?= $row["test_type"] ?></td>
            <td><?= $row["test_center"] ?></td>
            
            
            <td><?= $row["test_date"] ?></td>
            <td><?= $row["test_time"] ?></td>
            <td><?= $row["payment_method"] ?></td>
            <td>₹<?= $row["amount"] ?></td>
            <td><?= $row["created_at"] ?></td>
            
        </tr>
        
        <?php endwhile;
         ?>
    </table>
    <?php


    if ($result->num_rows == 0) {
        echo "<p>No appointments found.</p>";
    }
    ?>
</body>
</html>

<?php $conn->close(); ?>
