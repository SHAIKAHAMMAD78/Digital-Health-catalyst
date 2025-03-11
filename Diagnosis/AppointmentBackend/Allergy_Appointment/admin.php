<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Appointments</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Test Type</th>
                <th>Test Center</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Booking Date</th>
            </tr>

            <?php
            $result = $conn->query("SELECT * FROM appointments ORDER BY id ASC");
            
            $counter = 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Decode JSON if stored as JSON
                    $centerData = json_decode($row['testCenter'], true);

                    // Extract center name & price
                    if (is_array($centerData) && isset($centerData['name'])) {
                        $centerName = $centerData['name'];  // ✅ Only center name
                    } else {
                        $centerName = $row['testCenter'];  // ✅ If not JSON, use direct value
                    }

                    echo "<tr>
                        <td>{$counter}</td>  
                        <td>{$row['patientName']}</td>
                        <td>{$row['patientAge']}</td>
                        <td>{$row['patientPhone']}</td>
                        <td>{$row['patientEmail']}</td>
                        <td>{$row['testType']}</td>
                        <td>{$centerName}</td>  <!-- ✅ Only center name -->
                        <td>₹{$row['amount']}</td>
                        <td>{$row['testDate']}</td>
                        <td>{$row['testTime']}</td>
                        <td>{$row['paymentMethod']}</td>
                        <td>{$row['bookingDate']}</td>
                    </tr>";

                    $counter++;
                }
            } else {
                echo "<tr><td colspan='10' style='text-align:center;'>No appointments found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
