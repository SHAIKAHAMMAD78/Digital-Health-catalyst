
        (function() {
            emailjs.init("l3PaM_Eo2GAz9P0lE"); // Replace with your actual Email.js Public Key
        })();
    
        document.getElementById("appointmentForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Stop form from submitting immediately
            let formData = new FormData(this);
        fetch("AppointmentBackend/process_appointment.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sendEmail();
                } 
            })
            
    
            let userName = document.getElementById("patientName").value;
            let userEmail = document.getElementById("patientEmail").value;
            let userMobile = document.getElementById("patientPhone").value;
            let usercenterdeatils = document.getElementById("centerDetails").textContent;
            let userTestType = document.getElementById("testType").value;
            let userTestDate = document.getElementById("testDate").value;
            let userTestTime = document.getElementById("testTime").value;
    
            let templateParams = {
                from_email: "ahammadshaik608@gmail.com", // Replace with your actual service email
                from_name: "Your Service Team",
                user_name: userName,
                user_email: userEmail,
                user_mobile: userMobile,
                message: `Hello Admin,\n\nNew Hospital Appointment Booked!\n
                \n Patient Details :\n 
                Name : ${userName}\n
                Email: ${userEmail}\n
                Mobile: ${userMobile}\n
                Test Name :${userTestType}\n
                Center Details :${usercenterdeatils}\n
                Date : ${userTestDate}\n
                Time : ${userTestTime}\n
                \n\n
                Thank you \n\nBest Regards,\nYour Service Team`
            };
    
            emailjs.send("service_3xzr6jg", "template_ewzvjdi", templateParams)
                .then(response => {
                    alert("Appointment successful! A confirmation email has been sent to Admin.");
                    document.getElementById("appointmentForm").submit(); // Submit form after email is sent
                    window.location.href='http://localhost/final%20year%20project-2025/Hospitals/Raksha%20Hospital/';
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Failed to send signup details. Please try again.");
                });
        });
