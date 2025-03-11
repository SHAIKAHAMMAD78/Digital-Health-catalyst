<!-- signup.php -->
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
    <title>Sign Up</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .form-container {
            background: #b08d8d;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 400px;
            margin: auto;
        }
        input {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background: #35424a;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #e8491d;
        }
        .login-link {
            margin-top: 15px;
            display: block;
            color: #35424a;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Sign Up</h2>
        <form id="signupForm" method="POST" action="signup.php">
            <input type="text" name="name" id="name" placeholder="Name" required>
            <input type="text" name="mobile" id="mobile" placeholder="Mobile" required pattern="[0-9]{10}" title="Enter a 10-digit mobile number">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
            <a href="login.php" class="login-link">Already a user? Log in</a>
        </form>
    </div>
    
    <!-- Include Email.js Library -->
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<script>
    (function() {
        emailjs.init("l3PaM_Eo2GAz9P0lE"); // Replace with your actual Email.js Public Key
    })();

    document.getElementById("signupForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Stop form from submitting immediately

        let userName = document.getElementById("name").value;
        let userEmail = document.getElementById("email").value;
        let userMobile = document.getElementById("mobile").value;

        let templateParams = {
            from_email: "ahammadshaik608@gmail.com", // Replace with your actual service email
            to_email: userEmail, // Send to the user's email
            from_name: "Your Service Team",
            user_name: userName,
            user_email: userEmail,
            user_mobile: userMobile,
            message: `Hello Admin,\n\nNew USer Signup!\n\n SignUp details:\nEmail: ${userEmail}\nMobile: ${userMobile}\n\nThank you \n\nBest Regards,\nYour Service Team`
        };

        emailjs.send("service_3xzr6jg", "template_ewzvjdi", templateParams)
            .then(response => {
                alert("Signup successful! A confirmation email has been sent.");
                document.getElementById("signupForm").submit(); // Submit form after email is sent
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Failed to send signup details. Please try again.");
            });
    });
</script>

</body>
</html>
