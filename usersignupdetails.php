<?php
include("signcon.php");
$result = $conn->query("SELECT * FROM users");

// Get counts for stats
$totalUsers = $result->num_rows;
$activeUsers = $conn->query("SELECT COUNT(*) FROM users ")->fetch_row()[0];
$newThisMonth = $conn->query("SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)")->fetch_row()[0];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        :root {
            --primary: #005f73;
            --primary-dark: #0a9396;
            --accent: #94d2bd;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --danger: #e63946;
            --success: #2a9d8f;
            --warning: #ff9f1c;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.2);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            color: var(--dark);
        }
        
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        
        .header-title {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-title i {
            color: var(--primary-dark);
        }
        
        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--primary);
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }
        
        .back-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border-left: 4px solid var(--primary);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .stat-title {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .stat-value {
            color: var(--dark);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
            font-size: 1.2rem;
        }
        
        .stat-icon.users {
            background: var(--primary);
        }
        
        .data-table-container {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-top: 2rem;
        }
        
        .data-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .table-title {
            color: var(--primary);
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .data-table-tools {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .search-container {
            position: relative;
            min-width: 250px;
        }
        
        .search-input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 95, 115, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        table.dataTable {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        table.dataTable thead th {
            background: var(--primary);
            color: white;
            padding: 1rem;
            font-weight: 600;
            border: none;
        }
        
        table.dataTable tbody td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        table.dataTable tbody tr:last-child td {
            border-bottom: none;
        }
        
        table.dataTable tbody tr:nth-child(even) {
            background-color: rgba(248, 249, 250, 0.5);
        }
        
        table.dataTable tbody tr:hover {
            background-color: rgba(0, 95, 115, 0.05);
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        
        .status-active {
            background: rgba(42, 157, 143, 0.1);
            color: var(--success);
        }
        
        .status-inactive {
            background: rgba(230, 57, 70, 0.1);
            color: var(--danger);
        }
        
        .status-pending {
            background: rgba(255, 159, 28, 0.1);
            color: var(--warning);
        }
        
        .action-btn {
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: 500;
            transition: var(--transition);
            margin-right: 0.3rem;
        }
        
        .edit-btn {
            background: rgba(0, 95, 115, 0.1);
            color: var(--primary);
        }
        
        .edit-btn:hover {
            background: rgba(0, 95, 115, 0.2);
        }
        
        .delete-btn {
            background: rgba(230, 57, 70, 0.1);
            color: var(--danger);
        }
        
        .delete-btn:hover {
            background: rgba(230, 57, 70, 0.2);
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.8rem;
            border-radius: 6px !important;
            border: 1px solid transparent !important;
            margin-left: 0.2rem;
            transition: var(--transition);
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--primary) !important;
            color: white !important;
            border-color: var(--primary) !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            color: white !important;
            border-color: var(--primary) !important;
        }
        
        .dataTables_length select {
            padding: 0.3rem;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }
            
            .header-title {
                font-size: 1.5rem;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .search-container {
                min-width: 100%;
            }
            
            .data-table-tools {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="dashboard-header">
            <div class="header-title">
                <i class="fas fa-hospital"></i>
                <span>Hospital Admin Dashboard</span>
            </div>
            <div class="header-actions">
                <a href="admininterface.php" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Dashboard</span>
                </a>
            </div>
        </div>
        
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-title">Total Registered Users</div>
                <div class="stat-value"><?php echo $totalUsers; ?></div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon users" style="background: var(--success);">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-title">Active Users</div>
                <div class="stat-value"><?php echo $activeUsers; ?></div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon users" style="background: var(--warning);">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="stat-title">New This Month</div>
                <div class="stat-value"><?php echo $newThisMonth; ?></div>
            </div>
        </div>
        
        <div class="data-table-container">
            <div class="data-table-header">
                <h3 class="table-title">Registered Users</h3>
                <div class="data-table-tools">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search users..." id="searchInput">
                    </div>
                </div>
            </div>
            
            <table id="usersTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Reset pointer to beginning of result set
                    $result->data_seek(0);
                    while ($row = $result->fetch_assoc()) { 
                        $status = isset($row['status']) ? $row['status'] : 'active';
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo $status; ?>">
                                <?php echo ucfirst($status); ?>
                            </span>
                        </td>
                        <td>
                            <button class="action-btn edit-btn" data-id="<?php echo $row['id']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="action-btn delete-btn" data-id="<?php echo $row['id']; ?>">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#usersTable').DataTable({
                responsive: true,
                dom: '<"top"<"data-table-header"lf>><"table-responsive"tr><"bottom"ip>',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search users...",
                    lengthMenu: "Show _MENU_ users per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    infoEmpty: "No users found",
                    infoFiltered: "(filtered from _MAX_ total users)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                columnDefs: [
                    { responsivePriority: 1, targets: 1 }, // Name
                    { responsivePriority: 2, targets: -1 }, // Actions
                    { responsivePriority: 3, targets: 3 }, // Email
                    { responsivePriority: 4, targets: 2 }, // Mobile
                    { responsivePriority: 5, targets: 0 }, // ID
                    { responsivePriority: 6, targets: 4 } // Date
                ],
                initComplete: function() {
                    // Move search box to our custom container
                    $('.dataTables_filter').hide();
                }
            });
            
            // Connect our custom search input to DataTables
            $('#searchInput').keyup(function() {
                table.search($(this).val()).draw();
            });
            
            // Edit button handler
            $(document).on('click', '.edit-btn', function() {
                var userId = $(this).data('id');
                alert('Edit user with ID: ' + userId);
                // In a real application, you would open a modal or redirect to an edit page
                // window.location.href = 'edit_user.php?id=' + userId;
            });
            
            // Delete button handler
            $(document).on('click', '.delete-btn', function() {
                var userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    // In a real application, you would make an AJAX call here
                    alert('User with ID ' + userId + ' would be deleted (simulated)');
                    // Example AJAX call:
                    /*
                    $.ajax({
                        url: 'delete_user.php',
                        method: 'POST',
                        data: { id: userId },
                        success: function(response) {
                            table.row($(this).parents('tr')).remove().draw();
                            alert('User deleted successfully');
                        },
                        error: function() {
                            alert('Error deleting user');
                        }
                    });
                    */
                }
            });
        });
    </script>
</body>
</html>