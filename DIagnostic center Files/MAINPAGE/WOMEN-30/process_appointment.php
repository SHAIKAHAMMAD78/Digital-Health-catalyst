<?php
require 'db_connect.php';
// Set timezone correctly (VERY IMPORTANT)
date_default_timezone_set('Asia/Kolkata'); // Set to your country timezone

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST["patientName"];
    $patient_age = $_POST["patientAge"];
    $patient_phone = $_POST["patientPhone"];
    $patient_email = $_POST["patientEmail"];
    $test_type = $_POST["testType"];
    $center_name = $_POST["testCenter"]; 
    $appointment_date = $_POST["testDate"];
    $appointment_time = $_POST["testTime"];
    $payment_method = $_POST["paymentMethod"];
    $amount = $_POST["amount"];

    // Validate email
if (!filter_var($patient_email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email address!'); window.history.back();</script>";
    exit();
}

// Validate phone number (only digits and 10 length)
if (!preg_match('/^[0-9]{10}$/', $patient_phone)) {
    echo "<script>alert('Invalid phone number! It should be exactly 10 digits.'); window.history.back();</script>";
    exit();
}

// Check if appointment time has already passed
$currentDateTime = new DateTime(); // Current time
$selectedDateTime = new DateTime("$appointment_date $appointment_time");

if ($selectedDateTime <= $currentDateTime) {
    echo "<script>alert('You cannot book an appointment for a past time or current time! Please select a future time.'); window.history.back();</script>";
    exit();
}

// Check for duplicate appointment
$stmt = $conn->prepare("SELECT * FROM women30_tests WHERE test_center = ? AND test_date = ? AND test_time = ?");
$stmt->bind_param("sss", $center_name, $appointment_date, $appointment_time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('This time slot is already booked for the selected center. Please choose another time.'); window.history.back();</script>";
    exit();
}
$stmt->close();

// Insert the new appointment
$stmt = $conn->prepare("INSERT INTO women30_tests (patient_name, patient_age, patient_phone, patient_email, test_type, test_center, test_date, test_time, payment_method, amount) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssssssi", $patient_name, $patient_age, $patient_phone, $patient_email, $test_type, $center_name, $appointment_date, $appointment_time, $payment_method, $amount);

if ($stmt->execute()) {
    echo "<script>alert('Appointment booked successfully!'); window.location.href='http://localhost/final%20year%20project-2025/DIagnostic%20center%20Files/MAINPAGE/WOMEN-30/Women--30.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
}
?>

