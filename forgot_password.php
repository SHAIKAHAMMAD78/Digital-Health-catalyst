<?php
include("signcon.php"); // Database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['reset_email'] = $email; // Store email in session for next step
        header("Location: reset_password.php"); // Redirect to password reset page
    } else {
        echo "<script>alert('Email not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Medical Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #4a90e2;
            --primary-dark: #357abd;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2, #80deea);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--dark);
        }
        
        .password-container {
            display: flex;
            width: 800px;
            height: 500px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }
        
        .password-image {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80') center/cover no-repeat;
            position: relative;
        }
        
        .password-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(74, 144, 226, 0.7), rgba(74, 144, 226, 0.3));
        }
        
        .password-form {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .logo h2 {
            font-size: 1.8rem;
            color: var(--primary);
            font-weight: 600;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--secondary);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        
        .btn {
            display: inline-block;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }
        
        .links {
            text-align: center;
            margin-top: 20px;
        }
        
        .link {
            color: var(--secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        
        .link:hover {
            color: var(--primary);
        }
        
        @media (max-width: 768px) {
            .password-container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            
            .password-image {
                height: 200px;
            }
            
            .password-form {
                padding: 40px 30px;
            }
        }
        
        /* Animation for error messages */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="password-image"></div>
        <div class="password-form">
            <div class="logo">
                <i class="fas fa-key"></i>
                <h2>Reset Password</h2>
                <p>Enter your email to reset your password </p>
            </div>
            
            <form method="POST" action="">
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Verify Email</button>
                
                <div class="links">
                    <a href="login.php" class="link">Remember your password? Log In</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add shake animation to form when there's an error
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            
            <?php if(isset($_POST['email'])): ?>
                form.classList.add('shake');
                setTimeout(() => {
                    form.classList.remove('shake');
                }, 500);
            <?php endif; ?>
            
            // Add focus effects
            const input = document.querySelector('.form-control');
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = 'var(--primary)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = 'var(--secondary)';
            });
        });
    </script>
</body>
</html>