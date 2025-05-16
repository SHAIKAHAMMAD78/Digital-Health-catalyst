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
    $doctor_name = $_POST["testCenter"]; // Storing only doctor name
    $appointment_date = $_POST["testDate"];
    $appointment_time = $_POST["testTime"];
    $payment_method = $_POST["paymentMethod"];
    $amount = $_POST["amount"];

    // Check if appointment time has already passed
    $currentDateTime = new DateTime();
    $selectedDateTime = new DateTime("$appointment_date $appointment_time");

    if ($selectedDateTime < $currentDateTime) {
        echo "<script>alert('You cannot book an appointment for a past time!'); window.history.back();</script>";
        exit();
    }

    // Check for duplicate appointment
    $stmt = $conn->prepare("SELECT * FROM manipalhospital WHERE doctor_name = ? AND appointment_date = ? AND appointment_time = ?");
    $stmt->bind_param("sss", $doctor_name, $appointment_date, $appointment_time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('This time slot is already booked for the selected doctor. Please choose another time.'); window.history.back();</script>";
        exit();
    }
    $stmt->close();

    // Insert the new appointment
    $stmt = $conn->prepare("INSERT INTO manipalhospital (patient_name, patient_age, patient_phone, patient_email, test_type, doctor_name, appointment_date, appointment_time, payment_method, amount) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssi", $patient_name, $patient_age, $patient_phone, $patient_email, $test_type, $doctor_name, $appointment_date, $appointment_time, $payment_method, $amount);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href='http://localhost/final%20year%20project-2025/Hospitals/manipal%20hospital/';</script>";
    } else {
        echo "Error: " . $stmt->error;
        echo "<script>alert('Error occurred while booking the appointment!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
