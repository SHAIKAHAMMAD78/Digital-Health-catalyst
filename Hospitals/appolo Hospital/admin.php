<?php
require 'db_connect.php';

$sql = "SELECT * FROM appolohospital ORDER BY created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Appointments</title>
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
        }
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
    </style>
</head>
<body>
    <h2>Appointment Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Service</th>
            <th>Doctor Name</th> <!-- Only Doctor Name -->
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
            
            <td><?= $row["doctor_name"] ?></td>
            
            <td><?= $row["appointment_date"] ?></td>
            <td><?= $row["appointment_time"] ?></td>
            <td><?= $row["payment_method"] ?></td>
            <td>₹<?= $row["amount"] ?></td>
            <td><?= $row["created_at"] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <center><a href="http://localhost/final%20year%20project-2025/Hospital_Appointments.html" class="back-button">Back</a></center>
</body>
</html>

<?php $conn->close(); ?>
