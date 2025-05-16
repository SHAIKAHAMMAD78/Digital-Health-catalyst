<?php
include("signcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if all fields are filled
    if (empty($name) || empty($mobile) || empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
        exit;
    }

    // Validate mobile number (ensure it's numeric and 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "<script>alert('Please enter a valid 10-digit mobile number.'); window.history.back();</script>";
        exit;
    }

    // Check if email already exists
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();
    if ($check_email->num_rows > 0) {
        echo "<script>alert('Email is already registered! Please use another email.'); window.history.back();</script>";
        exit;
    }
    $check_email->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (name, mobile, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $mobile, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to register. Please try again later.');</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Medical Portal</title>
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
        
        .signup-container {
            display: flex;
            width: 900px;
            height: 600px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }
        
        .signup-image {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80') center/cover no-repeat;
            position: relative;
        }
        
        .signup-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(74, 144, 226, 0.7), rgba(74, 144, 226, 0.3));
        }
        
        .signup-form {
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
            margin-bottom: 20px;
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
            margin-top: 10px;
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
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
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
        
        .password-strength {
            height: 5px;
            background: #e9ecef;
            border-radius: 5px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            background: var(--danger);
            transition: all 0.3s;
        }
        
        @media (max-width: 768px) {
            .signup-container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            
            .signup-image {
                height: 200px;
            }
            
            .signup-form {
                padding: 40px 30px;
            }
        }
        
        /* Animation for password strength */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-image"></div>
        <div class="signup-form">
            <div class="logo">
                <i class="fas fa-user-plus"></i>
                <h2>Create Account</h2>
            </div>
            
            <form id="signupForm" method="POST" action="signup.php">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-mobile-alt"></i>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required pattern="[0-9]{10}" title="Enter a 10-digit mobile number">
                </div>
                
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <div class="password-strength">
                        <div class="strength-meter" id="strengthMeter"></div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Sign Up</button>
                
                <div class="links">
                    <a href="login.php" class="link">Already have an account? Log In</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Email.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <script>
        // Initialize EmailJS
        (function() {
            emailjs.init("l3PaM_Eo2GAz9P0lE"); // Replace with your actual Email.js Public Key
        })();

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('strengthMeter');
            let strength = 0;
            
            // Check for length
            if (password.length > 7) strength += 1;
            if (password.length > 10) strength += 1;
            
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) strength += 1;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength += 1;
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Update strength meter
            switch(strength) {
                case 0:
                    strengthMeter.style.width = '0%';
                    strengthMeter.style.backgroundColor = 'var(--danger)';
                    break;
                case 1:
                    strengthMeter.style.width = '20%';
                    strengthMeter.style.backgroundColor = 'var(--danger)';
                    break;
                case 2:
                    strengthMeter.style.width = '40%';
                    strengthMeter.style.backgroundColor = 'var(--warning)';
                    break;
                case 3:
                    strengthMeter.style.width = '60%';
                    strengthMeter.style.backgroundColor = 'var(--warning)';
                    break;
                case 4:
                    strengthMeter.style.width = '80%';
                    strengthMeter.style.backgroundColor = 'var(--success)';
                    break;
                case 5:
                    strengthMeter.style.width = '100%';
                    strengthMeter.style.backgroundColor = 'var(--success)';
                    break;
            }
            
            if (password.length > 0) {
                strengthMeter.classList.add('pulse');
                setTimeout(() => strengthMeter.classList.remove('pulse'), 500);
            }
        });

        // Enhanced form submission with EmailJS
        document.getElementById("signupForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Stop form from submitting immediately

            let userName = document.getElementById("name").value;
            let userEmail = document.getElementById("email").value;
            let userMobile = document.getElementById("mobile").value;

            let templateParams = {
                from_email: "ahammadshaik608@gmail.com", // Replace with your actual service email
                to_email: userEmail, // Send to the user's email
                from_name: "Medical Portal Team",
                user_name: userName,
                user_email: userEmail,
                user_mobile: userMobile,
                message: `Welcome ${userName},\n\nThank you for signing up to our Medical Portal!\n\nYour account details:\nEmail: ${userEmail}\nMobile: ${userMobile}\n\nWe're excited to have you on board.\n\nBest Regards,\nMedical Portal Team`
            };

            emailjs.send("service_3xzr6jg", "template_ewzvjdi", templateParams)
                .then(response => {
                    alert("Signup successful! A welcome email has been sent to your address.");
                    document.getElementById("signupForm").submit(); // Submit form after email is sent
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Account created! We couldn't send the welcome email. You can now login.");
                    document.getElementById("signupForm").submit(); // Submit form even if email fails
                });
        });
    </script>
</body>
</html>