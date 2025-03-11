<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userMessage = strtolower(trim($_POST["message"]));
    $response = "I'm not sure about that. Please consult a healthcare professional.";

    $responses = [
        "fever" => "Fever is usually caused by infections. Stay hydrated and get rest.",
        "headache" => "Headaches can be caused by stress or dehydration. Try drinking water and resting.",
        "cold" => "Common cold is viral. Drink warm fluids and rest.",
        "diabetes" => "Diabetes requires proper diet and medication. Consult a doctor for management.",
        "cough" => "Coughs can be due to infections or allergies. Drink warm fluids and avoid irritants.",
        "chest pain" => "Chest pain could be serious. Seek medical attention if it persists.",
        "nausea" => "Nausea can be caused by food poisoning or infections. Stay hydrated.",
        "vomiting" => "If vomiting persists, consult a doctor. Stay hydrated with electrolyte drinks.",
        "fatigue" => "Fatigue can be caused by stress or anemia. Ensure proper nutrition and rest.",
        "diarrhea" => "Diarrhea can lead to dehydration. Drink plenty of fluids.",
        "constipation" => "Eat fiber-rich foods and drink water to prevent constipation.",
        "allergy" => "Avoid allergens and take antihistamines if needed.",
        "rash" => "Rashes can be allergic reactions or infections. Use soothing creams.",
        "anxiety" => "Deep breathing and relaxation techniques can help with anxiety.",
        "depression" => "Seek support from friends, family, or a mental health professional.",
        "insomnia" => "Avoid caffeine before bed and create a relaxing bedtime routine.",
        "asthma" => "Use prescribed inhalers and avoid triggers like smoke or dust.",
        "stroke" => "Seek emergency medical help if you suspect a stroke.",
        "heart attack" => "Call emergency services immediately if experiencing chest pain or shortness of breath.",
        "high blood pressure" => "Reduce salt intake and maintain a healthy lifestyle.",
        "cancer" => "Cancer treatment depends on type and stage. Consult an oncologist.",
        "arthritis" => "Exercise and anti-inflammatory medications can help with arthritis.",
        "osteoporosis" => "Calcium and vitamin D help strengthen bones.",
        "pneumonia" => "Pneumonia is a lung infection. Seek medical care for proper treatment.",
        "migraine" => "Migraines can be triggered by stress or certain foods. Manage triggers and rest.",
        "hiv" => "HIV affects the immune system. Get tested and seek medical guidance.",
        "hepatitis" => "Hepatitis affects the liver. Vaccination and proper hygiene can prevent some types.",
        "toothache" => "Toothaches may indicate cavities or infections. Visit a dentist.",
        "ear infection" => "Ear infections can cause pain. Warm compresses and medication may help.",
        "indigestion" => "Avoid spicy foods and eat smaller meals to prevent indigestion.",
        "severe pain" => "Severe pain needs immediate medical attention.",
        "hi" => "Hi! How can I assist you today?",
        "hello" => "Hello! How can I help?",
        "hey" => "Hey there! What medical question do you have?"
    ];

    foreach ($responses as $key => $value) {
        if (strpos($userMessage, $key) !== false) {
            $response = $value;
            break;
        }
    }

    echo $response;
}
?>
