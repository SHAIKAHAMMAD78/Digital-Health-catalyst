<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel | Control Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6C5CE7;
            --primary-dark: #5649C2;
            --secondary: #00CEFF;
            --accent: #FD79A8;
            --dark: #2D3436;
            --darker: #1E2225;
            --light: #F5F6FA;
            --success: #00B894;
            --warning: #FDCB6E;
            --danger: #D63031;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--light);
            overflow-x: hidden;
        }
        
        /* Animated background particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.3;
        }
        
        .particle {
            position: absolute;
            background: var(--secondary);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
        }
        
        /* Main layout */
        .container { 
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 30px;
            width: 100%;
            max-width: 1400px;
            margin: 80px auto 30px;
            padding: 0 30px;
        }
        
        /* Sidebar/Navigation */
        .nav {
            background: var(--glass);
            padding: 25px 0;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            height: fit-content;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }
        
        .nav:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .nav-header {
            padding: 0 25px 20px;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 20px;
        }
        
        .nav-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
        }
        
        .nav-title i {
            margin-right: 12px;
            color: var(--secondary);
            font-size: 1.4rem;
        }
        
        .nav a {
            color: rgba(255,255,255,0.8);
            font-size: 15px;
            font-weight: 500;
            padding: 14px 25px;
            margin: 5px 0;
            text-decoration: none;
            border-radius: 0 12px 12px 0;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .nav a:hover {
            background: linear-gradient(90deg, rgba(108, 92, 231, 0.2) 0%, rgba(0, 206, 255, 0.1) 100%);
            color: white;
            transform: translateX(8px);
        }
        
        .nav a:hover::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--secondary);
            animation: borderGrow 0.3s ease-out;
        }
        
        @keyframes borderGrow {
            0% { height: 0; }
            100% { height: 100%; }
        }
        
        .nav a.active {
            background: linear-gradient(90deg, rgba(108, 92, 231, 0.3) 0%, rgba(0, 206, 255, 0.15) 100%);
            color: white;
        }
        
        /* Main content area */
        .content {
            background: var(--glass);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }
        
        .content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        /* Header styles */
        h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }
        
        h2 span {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        
        /* Dashboard cards */
        .admin-card {
            background: linear-gradient(135deg, rgba(108, 92, 231, 0.1) 0%, rgba(0, 206, 255, 0.05) 100%);
            border-radius: 16px;
            padding: 30px;
            margin-top: 30px;
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .admin-card p {
            line-height: 1.8;
            color: rgba(255,255,255,0.7);
            font-size: 15px;
            margin-bottom: 15px;
        }
        
        /* Logout button */
        .logout-btn {
            position: fixed;
            top: 25px;
            right: 30px;
            background: linear-gradient(135deg, var(--danger) 0%, var(--accent) 100%);
            color: white;
            font-size: 15px;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(214, 48, 49, 0.3);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            z-index: 100;
        }
        
        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(214, 48, 49, 0.4);
        }
        
        .logout-btn i {
            margin-right: 8px;
        }
        
        /* Responsive design */
        @media (max-width: 992px) {
            .container {
                grid-template-columns: 1fr;
                margin-top: 70px;
            }
            
            .nav {
                width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            
            .logout-btn {
                top: 15px;
                right: 15px;
                padding: 8px 15px;
                font-size: 14px;
            }
        }
        
        /* Floating animation */
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
    </style>
</head>
<body>

    <!-- Animated background particles -->
    <div class="particles" id="particles"></div>

    <!-- Logout button -->
    <button class="logout-btn" onclick="window.location.href='first.html'">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>

    <!-- Main container -->
    <div class="container">
        <!-- Navigation sidebar -->
        <div class="nav floating">
            <div class="nav-header">
                <div class="nav-title">
                    <i class="fas fa-shield-alt"></i> Admin Portal
                </div>
            </div>
            <a href="Diagnosis_Appointments.html" class="active">
                <i class="fas fa-stethoscope"></i> Diagnosis Appointments
            </a>
            <a href="Hospital_Appointments.html">
                <i class="fas fa-hospital"></i> Hospital Appointments
            </a>
            <a href="usersignupdetails.php">
                <i class="fas fa-users"></i> User Management
            </a>
        </div>

        <!-- Main content -->
        <div class="content">
            <h2>Welcome <span>Admin</span></h2>
            
            <div class="admin-card">
                <p><i class="fas fa-info-circle" style="color: var(--secondary); margin-right: 8px;"></i> You're now accessing the administrative control center. This dashboard provides comprehensive tools to manage all system operations.</p>
                <p><i class="fas fa-chart-line" style="color: var(--success); margin-right: 8px;"></i> Select an option from the navigation panel to view appointments, manage users, or configure system settings.</p>
                <p><i class="fas fa-bell" style="color: var(--warning); margin-right: 8px;"></i> Important notifications and system alerts will appear here when available.</p>
            </div>
        </div>
    </div>

    <script>
        // Create animated particles
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random properties
                const size = Math.random() * 8 + 2;
                const posX = Math.random() * 100;
                const delay = Math.random() * 15;
                const duration = Math.random() * 20 + 10;
                const opacity = Math.random() * 0.5 + 0.1;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.bottom = `-${size}px`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.opacity = opacity;
                
                // Random color variation
                const colors = ['#00CEFF', '#6C5CE7', '#FD79A8', '#FDCB6E'];
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                particle.style.background = randomColor;
                
                particlesContainer.appendChild(particle);
            }
        });
    </script>
</body>
</html>