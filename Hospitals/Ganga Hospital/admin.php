<?php
require 'db_connect.php';

$sql = "SELECT * FROM gangahospital ORDER BY created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6c5ce7;
            --secondary: #a29bfe;
            --success: #00b894;
            --warning: #fdcb6e;
            --danger: #d63031;
            --info: #0984e3;
            --light: #f5f6fa;
            --dark: #2d3436;
            --purple-gradient: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%);
            --blue-gradient: linear-gradient(135deg, #0984e3 0%, #74b9ff 100%);
            --green-gradient: linear-gradient(135deg, #00b894 0%, #55efc4 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f1f2f6;
            color: var(--dark);
            min-height: 100vh;
        }
        
        .container {
            max-width: 95%;
            margin: 30px auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            background: var(--purple-gradient);
            color: white;
        }
        
        h2 {
            font-size: 28px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .search-filter {
            display: flex;
            gap: 15px;
        }
        
        .search-box {
            padding: 10px 15px;
            border-radius: 30px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 250px;
            transition: all 0.3s;
        }
        
        .search-box:focus {
            outline: none;
            box-shadow: 0 2px 15px rgba(108, 92, 231, 0.3);
            transform: translateY(-2px);
        }
        
        .filter-btn {
            padding: 10px 20px;
            border-radius: 30px;
            border: none;
            background: white;
            color: var(--primary);
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .filter-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            position: relative;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        thead {
            background: var(--blue-gradient);
            color: white;
        }
        
        th {
            padding: 18px;
            text-align: left;
            font-weight: 500;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
        }
        
        th:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 1px;
            background: rgba(255,255,255,0.3);
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            color: #555;
            font-weight: 400;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:nth-child(even) {
            background-color: rgba(0,0,0,0.01);
        }
        
        tr:hover {
            background-color: rgba(108, 92, 231, 0.05);
            transform: scale(1.005);
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            gap: 5px;
        }
        
        .status-confirmed {
            background: rgba(0, 184, 148, 0.1);
            color: var(--success);
        }
        
        .status-pending {
            background: rgba(253, 203, 110, 0.1);
            color: #e17055;
        }
        
        .action-btns {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
            color: white;
            font-weight: 500;
        }
        
        .view-btn {
            background: var(--info);
        }
        
        .edit-btn {
            background: var(--success);
        }
        
        .delete-btn {
            background: var(--danger);
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background: var(--purple-gradient);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 30px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
            margin-top: 30px;
            gap: 8px;
        }
        
        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
            background: var(--primary);
        }
        
        .center {
            text-align: center;
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        table tr {
            animation: fadeIn 0.5s ease forwards;
        }
        
        table tr:nth-child(1) { animation-delay: 0.1s; }
        table tr:nth-child(2) { animation-delay: 0.2s; }
        table tr:nth-child(3) { animation-delay: 0.3s; }
        table tr:nth-child(4) { animation-delay: 0.4s; }
        table tr:nth-child(5) { animation-delay: 0.5s; }
        
        /* Pulse animation for new entries */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        
        .highlight {
            animation: pulse 2s infinite;
            background: rgba(155, 89, 182, 0.05);
            border-left: 3px solid var(--primary);
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 1000px;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .search-filter {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Floating action button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 5px 20px rgba(214, 48, 49, 0.3);
            cursor: pointer;
            transition: all 0.3s;
            z-index: 100;
        }
        
        .fab:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 8px 25px rgba(214, 48, 49, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><i class="fas fa-calendar-alt"></i> Appointment Dashboard</h2>
            <div class="search-filter">
                <input type="text" class="search-box" placeholder="Search appointments...">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Service</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment</th>
                        <th>Amount</th>
                        <th>Booked At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr class="<?= $row['id'] % 5 === 0 ? 'highlight' : '' ?>">
                        <td>#<?= $row["id"] ?></td>
                        <td>
                            <div style="font-weight:500"><?= $row["patient_name"] ?></div>
                            <div style="font-size:12px;color:#7f8c8d"><?= $row["patient_email"] ?></div>
                        </td>
                        <td><?= $row["patient_age"] ?></td>
                        <td><?= $row["patient_phone"] ?></td>
                        <td>
                            <span class="status-badge <?= $row['test_type'] === 'Emergency' ? 'status-pending' : 'status-confirmed' ?>">
                                <?= $row["test_type"] ?>
                            </span>
                        </td>
                        <td><?= $row["doctor_name"] ?></td>
                        <td><?= date('M j, Y', strtotime($row["appointment_date"])) ?></td>
                        <td><?= date('h:i A', strtotime($row["appointment_time"])) ?></td>
                        <td><?= $row["payment_method"] ?></td>
                        <td style="font-weight:500">₹<?= $row["amount"] ?></td>
                        <td><?= date('M j, h:i A', strtotime($row["created_at"])) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <div class="center">
            <a href="http://localhost/final%20year%20project-2025/Hospital_Appointments.html" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="fab" title="Add New Appointment">
        <i class="fas fa-plus"></i>
    </div>

    <script>
        // Interactive elements
        document.querySelectorAll('tbody tr').forEach(row => {
            // Add hover effect
            row.addEventListener('mouseenter', () => {
                row.style.transform = 'scale(1.01)';
                row.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
                row.style.transition = 'all 0.3s ease';
            });
            
            row.addEventListener('mouseleave', () => {
                row.style.transform = 'scale(1)';
                row.style.boxShadow = 'none';
            });
            
            // Click effect
            row.addEventListener('click', () => {
                document.querySelectorAll('tbody tr').forEach(r => {
                    r.style.background = '';
                });
                row.style.background = 'rgba(108, 92, 231, 0.1)';
            });
        });
        
        // Search functionality
        const searchBox = document.querySelector('.search-box');
        searchBox.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
        
        // FAB click action
        document.querySelector('.fab').addEventListener('click', () => {
            alert('Redirecting to new appointment form...');
            // window.location.href = 'new_appointment.html';
        });
        
        // Highlight new rows (every 5th row for demo)
        setInterval(() => {
            document.querySelectorAll('.highlight').forEach(row => {
                row.classList.toggle('pulse');
            });
        }, 2000);
    </script>
</body>
</html>

<?php $conn->close(); ?>