<?php
include("signcon.php");
session_start();

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['reset_email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate that passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update password
        $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        
        if ($conn->query($sql) === TRUE) {
            session_destroy();
            echo "<script>alert('Password changed successfully!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error updating password!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Medical Portal</title>
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
        
        .reset-container {
            display: flex;
            width: 800px;
            height: 550px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }
        
        .reset-image {
            flex: 1;
            background: url('https://images.unsplash.com/photo-1581093450021-4a7360e9a6a5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80') center/cover no-repeat;
            position: relative;
        }
        
        .reset-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(74, 144, 226, 0.7), rgba(74, 144, 226, 0.3));
        }
        
        .reset-form {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
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
        
        .form-group i.fa-lock {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--secondary);
            z-index: 2;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 40px 12px 40px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--secondary);
            transition: all 0.3s;
            z-index: 2;
        }
        
        .password-toggle:hover {
            color: var(--primary);
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
            margin-bottom: 15px;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }
        
        .btn-back {
            background-color: var(--light);
            color: var(--secondary);
            border: 1px solid #e9ecef;
        }
        
        .btn-back:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
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
        
        .password-requirements {
            margin-top: 10px;
            font-size: 0.8rem;
            color: var(--secondary);
        }
        
        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .requirement i {
            margin-right: 5px;
            font-size: 0.7rem;
        }
        
        .requirement.valid {
            color: var(--success);
        }
        
        .match-error {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
        
        @media (max-width: 768px) {
            .reset-container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            
            .reset-image {
                height: 200px;
            }
            
            .reset-form {
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
    <div class="reset-container">
        <div class="reset-image"></div>
        <div class="reset-form">
            <div class="logo">
                <i class="fas fa-key"></i>
                <h2>Create New Password</h2>
                <p>Enter a strong password to secure your account</p>
            </div>
            
            <form method="POST" action="">
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword1"></i>
                    <div class="password-strength">
                        <div class="strength-meter" id="strengthMeter"></div>
                    </div>
                    <div class="password-requirements">
                        <div class="requirement" id="lengthReq">
                            <i class="fas fa-circle"></i> At least 8 characters
                        </div>
                        <div class="requirement" id="upperReq">
                            <i class="fas fa-circle"></i> At least 1 uppercase letter
                        </div>
                        <div class="requirement" id="numberReq">
                            <i class="fas fa-circle"></i> At least 1 number
                        </div>
                        <div class="requirement" id="specialReq">
                            <i class="fas fa-circle"></i> At least 1 special character
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword2"></i>
                    <div class="match-error" id="passwordMatchError">
                        <i class="fas fa-exclamation-circle"></i> Passwords do not match
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Reset Password</button>
                <a href="login.php" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>
            </form>
        </div>
    </div>

    <script>
        // Password strength and requirements checker
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('confirm_password');
        const passwordMatchError = document.getElementById('passwordMatchError');
        
        newPassword.addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('strengthMeter');
            let strength = 0;
            
            // Check requirements
            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);
            
            // Update requirement indicators
            updateRequirement('lengthReq', hasLength);
            updateRequirement('upperReq', hasUpper);
            updateRequirement('numberReq', hasNumber);
            updateRequirement('specialReq', hasSpecial);
            
            // Calculate strength
            if (hasLength) strength += 1;
            if (hasUpper) strength += 1;
            if (hasNumber) strength += 1;
            if (hasSpecial) strength += 1;
            
            // Update strength meter
            switch(strength) {
                case 0:
                    strengthMeter.style.width = '0%';
                    strengthMeter.style.backgroundColor = 'var(--danger)';
                    break;
                case 1:
                    strengthMeter.style.width = '25%';
                    strengthMeter.style.backgroundColor = 'var(--danger)';
                    break;
                case 2:
                    strengthMeter.style.width = '50%';
                    strengthMeter.style.backgroundColor = 'var(--warning)';
                    break;
                case 3:
                    strengthMeter.style.width = '75%';
                    strengthMeter.style.backgroundColor = 'var(--warning)';
                    break;
                case 4:
                    strengthMeter.style.width = '100%';
                    strengthMeter.style.backgroundColor = 'var(--success)';
                    break;
            }
            
            if (password.length > 0) {
                strengthMeter.classList.add('pulse');
                setTimeout(() => strengthMeter.classList.remove('pulse'), 500);
            }
            
            // Check password match if confirm password has value
            if (confirmPassword.value.length > 0) {
                checkPasswordMatch();
            }
        });
        
        // Password match checker
        confirmPassword.addEventListener('input', checkPasswordMatch);
        
        function checkPasswordMatch() {
            if (newPassword.value !== confirmPassword.value) {
                passwordMatchError.style.display = 'block';
                confirmPassword.style.borderColor = 'var(--danger)';
            } else {
                passwordMatchError.style.display = 'none';
                confirmPassword.style.borderColor = 'var(--success)';
            }
        }
        
        function updateRequirement(id, isValid) {
            const element = document.getElementById(id);
            if (isValid) {
                element.classList.add('valid');
                element.querySelector('i').className = 'fas fa-check-circle';
            } else {
                element.classList.remove('valid');
                element.querySelector('i').className = 'fas fa-circle';
            }
        }
        
        // Toggle password visibility
        document.getElementById('togglePassword1').addEventListener('click', function() {
            togglePasswordVisibility(newPassword, this);
        });
        
        document.getElementById('togglePassword2').addEventListener('click', function() {
            togglePasswordVisibility(confirmPassword, this);
        });
        
        function togglePasswordVisibility(inputField, icon) {
            if (inputField.type === 'password') {
                inputField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                inputField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>