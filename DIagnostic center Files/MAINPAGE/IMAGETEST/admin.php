<?php
require 'db_connect.php';

$sql = "SELECT * FROM image_tests ORDER BY created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Image Test Appointments</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #4cc9f0;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --text-dark: #2b2d42;
            --text-light: #8d99ae;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text-dark);
        }
        
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            margin: 0;
        }
        
        .back-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            transition: all 0.3s;
        }
        
        .back-btn i {
            margin-right: 8px;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        }
        
        /* Search and filter section */
        .action-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 400px;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: none;
            border-radius: 30px;
            font-size: 0.95rem;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }
        
        /* Table styles */
        .data-table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            overflow-x: auto;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }
        
        .data-table thead {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .data-table th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            position: relative;
        }
        
        .data-table th:after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 60%;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .data-table th:last-child:after {
            display: none;
        }
        
        .data-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .data-table tr:last-child td {
            border-bottom: none;
        }
        
        .data-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        .data-table tbody tr:nth-child(even) {
            background-color: var(--light);
        }
        
        /* Status badges */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-success {
            background-color: rgba(40, 167, 69, 0.15);
            color: var(--success);
        }
        
        .badge-warning {
            background-color: rgba(255, 193, 7, 0.15);
            color: #d39e00;
        }
        
        .badge-danger {
            background-color: rgba(220, 53, 69, 0.15);
            color: var(--danger);
        }
        
        /* Action buttons */
        .action-btn {
            border: none;
            background: none;
            cursor: pointer;
            padding: 5px;
            margin: 0 3px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .action-btn i {
            font-size: 0.9rem;
        }
        
        .edit-btn {
            color: var(--primary);
        }
        
        .delete-btn {
            color: var(--danger);
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .admin-container {
                padding: 20px 15px;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .back-btn {
                position: static;
                margin-bottom: 15px;
            }
            
            .search-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h2><i class="fas fa-allergies"></i> Image Test Appointments</h2>
            <a href="http://localhost/final%20year%20project-2025/Diagnosis_Appointments.html" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Tests
            </a>
        </div>
        
        <div class="action-bar">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search appointments..." id="searchInput">
            </div>
        </div>
        
        <div class="data-table-container">
            <?php if ($result->num_rows > 0) : ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Test Details</th>
                        <th>Appointment</th>
                        <th>Payment</th>
                        <th>Booked At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($row["patient_name"]) ?></strong><br>
                            <small><?= htmlspecialchars($row["patient_email"]) ?></small>
                        </td>
                        <td><?= $row["patient_age"] ?></td>
                        <td><?= $row["patient_phone"] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($row["test_type"]) ?></strong><br>
                            <small><?= htmlspecialchars($row["test_center"]) ?></small>
                        </td>
                        <td>
                            <?= date('d M Y', strtotime($row["test_date"])) ?><br>
                            <small><?= $row["test_time"] ?></small>
                        </td>
                        <td>
                            <span class="badge badge-success">₹<?= $row["amount"] ?></span><br>
                            <small><?= $row["payment_method"] ?></small>
                        </td>
                        <td><?= date('d M Y h:i A', strtotime($row["created_at"])) ?></td>
                        <td>
                            <button class="action-btn edit-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn delete-btn" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else : ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h3>No Appointments Found</h3>
                <p>There are currently no allergy test appointments in the system.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr');
            
            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Confirm before delete
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this appointment?')) {
                    // Add your delete logic here
                    alert('Appointment deleted (simulated)');
                }
            });
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
