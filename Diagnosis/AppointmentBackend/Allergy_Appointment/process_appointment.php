<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST["patientName"];
    $patientAge = $_POST["patientAge"];
    $patientPhone = $_POST["patientPhone"];
    $patientEmail = $_POST["patientEmail"];
    $testType = $_POST["testType"];
    $testCenter = $_POST["testCenter"];
    $testDate = $_POST["testDate"];
    $testTime = $_POST["testTime"];
    $paymentMethod = $_POST["paymentMethod"];
    $amount = $_POST["amount"]; // Retrieve price from form submission

    // Check for duplicate entry with same test date and time
    $stmtCheck = $conn->prepare("SELECT * FROM appointments WHERE testDate = ? AND testTime = ?");
    $stmtCheck->bind_param("ss", $testDate, $testTime);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        // Duplicate entry exists
        echo "<p style='color: red;'>Error: An appointment is already booked for this date and time.</p>";
    } else {
        // Insert new appointment if no duplicate found
        $stmt = $conn->prepare("INSERT INTO appointments (patientName, patientAge, patientPhone, patientEmail, testType, testCenter, testDate, testTime, paymentMethod, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssssssi", $patientName, $patientAge, $patientPhone, $patientEmail, $testType, $testCenter, $testDate, $testTime, $paymentMethod, $amount);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Appointment booked successfully! Your test will cost ₹$amount.</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $stmtCheck->close();
    $conn->close();
}
?>
