<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f4; 
            background-image: url('https://wallpaperset.com/w/full/f/7/c/455898.jpg');
            margin: 0;
            padding: 0;
        }
        .container { 
            display: flex;
            justify-content: center; /* Center the container */
            width: 100%; 
            padding: 20px;
            margin-top: 100px; /* Add some space from the top */
        }
        .slogan {
            
            top: 20px;
            right: 20px;
            font-size: 18px;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            writing-mode: horizontal-tb;
            /*transform: rotate(180deg);*/
        }
        .nav {
            background: #35424a;
            padding: 15px;
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            height: fit-content;
        }
        .nav a {
            background: #35424a;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .nav a:hover {
            background-color: #e8491d;
            border-radius: 5px;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 800px; /* Set a max width for the content */
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }
        h2 {
            font-size: 30px;
            font-weight: bold;
            color: #35424a;
        }
        /* Logout button styling */
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #e8491d;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #35424a;
        }
    </style>
</head>
<body>

    <!-- Slogans on the right side -->
    

    <!-- Logout button at the top right -->
    <button class="logout-btn" onclick="window.location.href='first.html'">Logout</button>

    <!-- Main container for nav and content -->
    <div class="container">
        <!-- Navigation -->
        <div class="nav">
            <a href="doctors.php">Doctors</a>
            <a href="Diagnosis_Appointments.html">Appointments</a>
            <a href="usersignupdetails.php">New Users</a>
        </div>

        <!-- Main content -->
        <div class="content">
            <h2>Welcome Admin </h2>
            
    </div>

</body>
</html>
