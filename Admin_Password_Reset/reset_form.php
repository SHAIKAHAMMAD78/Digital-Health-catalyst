<?php $email = $_GET['email']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Set New Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #4f46e5;
      --primary-dark: #4338ca;
      --error: #ef4444;
      --success: #10b981;
      --text: #1f2937;
      --light-bg: #f9fafb;
      --white: #ffffff;
      --gray-light: #e5e7eb;
      --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: var(--light-bg);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: var(--text);
      line-height: 1.5;
    }

    .password-reset-card {
      background: var(--white);
      border-radius: 12px;
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 480px;
      padding: 2.5rem;
      text-align: center;
      position: relative;
      overflow: hidden;
      animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .password-reset-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 6px;
      background: linear-gradient(90deg, var(--primary), #7c3aed);
    }

    .password-reset-card h2 {
      font-size: 1.75rem;
      margin-bottom: 1.5rem;
      color: var(--primary);
      font-weight: 600;
    }

    .password-reset-card p {
      margin-bottom: 2rem;
      color: #6b7280;
    }

    .input-group {
      position: relative;
      margin-bottom: 1.5rem;
      text-align: left;
    }

    .input-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--text);
    }

    .input-container {
      position: relative;
    }

    .input-group i.fa-lock {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      transition: var(--transition);
    }

    .password-reset-card input[type="password"],
    .password-reset-card input[type="text"] {
      width: 100%;
      padding: 14px 44px 14px 44px;
      border: 2px solid var(--gray-light);
      border-radius: 8px;
      font-size: 1rem;
      transition: var(--transition);
      background-color: var(--light-bg);
    }

    .password-reset-card input[type="password"]:focus,
    .password-reset-card input[type="text"]:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
      outline: none;
      background-color: var(--white);
    }

    .password-strength {
      height: 4px;
      background: var(--gray-light);
      border-radius: 2px;
      margin-top: 0.5rem;
      overflow: hidden;
      position: relative;
    }

    .strength-meter {
      height: 100%;
      width: 0;
      background: var(--error);
      transition: var(--transition);
    }

    .password-reset-card input[type="submit"] {
      width: 100%;
      padding: 14px;
      background: var(--primary);
      color: var(--white);
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      margin-top: 1rem;
    }

    .password-reset-card input[type="submit"]:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .password-reset-card input[type="submit"]:active {
      transform: translateY(0);
    }

    .password-toggle {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      cursor: pointer;
      transition: var(--transition);
    }

    .password-toggle:hover {
      color: var(--primary);
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
      .password-reset-card {
        padding: 1.8rem;
        margin: 0 15px;
      }
    }
  </style>
</head>
<body>
  <form action="update_password.php" method="POST" class="password-reset-card">
    <h2>Set New Password</h2>
    <p>Create a strong, unique password to secure your account.</p>
    
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    
    <div class="input-group">
      <label for="new_password">New Password</label>
      <div class="input-container">
        <i class="fas fa-lock"></i>
        <input type="password" name="new_password" id="new_password" placeholder="Enter new password" required>
        <i class="fas fa-eye password-toggle" id="toggleNewPassword"></i>
      </div>
      <div class="password-strength">
        <div class="strength-meter" id="passwordStrength"></div>
      </div>
    </div>
    
    <div class="input-group">
      <label for="confirm_password">Confirm Password</label>
      <div class="input-container">
        <i class="fas fa-lock"></i>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
      </div>
    </div>
    
    <input type="submit" value="Update Password">
    <a href="http://localhost/final%20year%20project-2025/admin_login.php" style="display: block; margin-top: 1rem; color: var(--primary); text-decoration: none;">Back to Login</a>
  </form>

  <script>
    // Password strength indicator
    const newPassword = document.getElementById('new_password');
    const strengthMeter = document.getElementById('passwordStrength');
    
    newPassword.addEventListener('input', function() {
      const strength = calculatePasswordStrength(this.value);
      updateStrengthMeter(strength);
    });
    
    function calculatePasswordStrength(password) {
      let strength = 0;
      
      // Length check
      if (password.length > 7) strength += 1;
      if (password.length > 11) strength += 1;
      
      // Character variety checks
      if (/[A-Z]/.test(password)) strength += 1;
      if (/[0-9]/.test(password)) strength += 1;
      if (/[^A-Za-z0-9]/.test(password)) strength += 1;
      
      return Math.min(strength, 5);
    }
    
    function updateStrengthMeter(strength) {
      const percent = strength * 20;
      strengthMeter.style.width = `${percent}%`;
      
      if (strength <= 2) {
        strengthMeter.style.backgroundColor = 'var(--error)';
      } else if (strength <= 4) {
        strengthMeter.style.backgroundColor = '#f59e0b';
      } else {
        strengthMeter.style.backgroundColor = 'var(--success)';
      }
    }
    
    // Password visibility toggle
    document.getElementById('toggleNewPassword').addEventListener('click', function() {
      togglePasswordVisibility('new_password', this);
    });
    
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
      togglePasswordVisibility('confirm_password', this);
    });
    
    function togglePasswordVisibility(inputId, icon) {
      const input = document.getElementById(inputId);
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>
</body>
</html>