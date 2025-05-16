const testimonials = [
    {
        image: "https://www.kauveryhospital.com/wp-content/uploads/2023/06/19-1.jpg",
        title: "From Ventilator to Treadmill in 9 Weeks",
        text: "“My heartfelt gratitude for the wonderful medical care Dr. Aravindan and his team of doctors rendered me at Kauvery hospital...”",
        name: "Sita Krishnamoorthy"
    },
    {
        image: "https://i.ytimg.com/vi/IfbQem9fhus/maxresdefault.jpg",
        title: "A New Lease on Life After Surgery",
        text: "“I was scared before my surgery, but the doctors at Kauvery Hospital took such good care of me. I am forever grateful!”",
        name: "Ramesh Kumar"
    },
    {
        image: "https://www.kauveryhospital.com/wp-content/uploads/2022/09/doctor-patient.png",
        title: "Recovered Fully from Heart Surgery",
        text: "“The best decision I made was choosing Kauvery Hospital for my treatment. They saved my life!”",
        name: "Priya Menon"
    },
    {
        image: "https://www.kauveryhospital.com/images/journals/v3-i11-1/The-Emergency-Room-2.jpg",
        title: "From Pain to Relief in Just a Few Weeks",
        text: "“The treatment and care I received were beyond excellent. Thank you for giving me a second chance at life.”",
        name: "Reka"
    }
];

let currentIndex = 0;

document.getElementById("next-btn").addEventListener("click", function () {
    currentIndex = (currentIndex + 1) % testimonials.length;
    updateTestimonial();
});

document.getElementById("prev-btn").addEventListener("click", function () {
    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
    updateTestimonial();
});

function updateTestimonial() {
    document.getElementById("testimonial-image").src = testimonials[currentIndex].image;
    document.getElementById("testimonial-title").textContent = testimonials[currentIndex].title;
    document.getElementById("testimonial-text").textContent = testimonials[currentIndex].text;
    document.getElementById("testimonial-name").textContent = testimonials[currentIndex].name;
}
