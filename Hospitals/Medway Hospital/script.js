document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".number");

    counters.forEach(counter => {
        counter.innerText = '0';
        const target = +counter.getAttribute("data-target");
        const increment = target / 100;

        const updateCounter = () => {
            const value = +counter.innerText;
            if (value < target) {
                counter.innerText = Math.ceil(value + increment);
                setTimeout(updateCounter, 20);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };

        updateCounter();
    });
});


function redirectToPage(page) {
    window.location.href = page;
}

// Scroll effect for the hospital carousel
document.addEventListener('DOMContentLoaded', () => {
    const hospitalList = document.querySelector('.hospital-list');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    prevButton.addEventListener('click', () => {
        hospitalList.scrollBy({ left: -300, behavior: 'smooth' });
    });

    nextButton.addEventListener('click', () => {
        hospitalList.scrollBy({ left: 300, behavior: 'smooth' });
    });
});





const testimonials = [
    {
        text: "I got admitted for transplant, and Dr. CMT took excellent care of me. The entire team of doctors provided exceptional care, and the amenities were excellent. The staff were cooperative. I would definitely recommend and revisit Medway Hospitals.",
        author: "Artheeswari",
        location: "Visited for Organ Transplant, Kodambakkam"
    },
    {
        text: "The doctors and staff at Medway Hospitals were incredibly supportive during my treatment. They provided top-notch medical care and made my stay comfortable. I am grateful for their efforts and highly recommend their services.",
        author: "Ramesh Kumar",
        location: "Visited for Heart Surgery, Chennai"
    },
    {
        text: "I had a great experience at Medway Hospitals. The facilities were outstanding, and the doctors were very professional and kind. I felt at ease throughout my treatment, and I appreciate their dedication to patient care.",
        author: "Priya Sharma",
        location: "Visited for Knee Replacement, Coimbatore"
    }
];

let currentIndex = 0;

function updateTestimonial() {
    document.getElementById("testimonial").textContent = testimonials[currentIndex].text;
    document.getElementById("author").textContent = testimonials[currentIndex].author;
    document.getElementById("location").textContent = testimonials[currentIndex].location;
}

function prevTestimonial() {
    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
    updateTestimonial();
}

function nextTestimonial() {
    currentIndex = (currentIndex + 1) % testimonials.length;
    updateTestimonial();
}

// Initialize with the first testimonial
updateTestimonial();






document.addEventListener("DOMContentLoaded", function () {
    const faqs = document.querySelectorAll(".faq");

    faqs.forEach((faq) => {
        const question = faq.querySelector(".faq-question");
        const answer = faq.querySelector(".faq-answer");
        const toggleBtn = faq.querySelector(".toggle-btn");

        question.addEventListener("click", () => {
            const isVisible = answer.style.display === "block";

            // Close all other answers
            document.querySelectorAll(".faq-answer").forEach((el) => {
                el.style.display = "none";
            });

            // Reset all toggle buttons to "+"
            document.querySelectorAll(".toggle-btn").forEach((btn) => {
                btn.textContent = "+";
                btn.style.backgroundColor = "green";
            });

            // Toggle the clicked answer
            if (!isVisible) {
                answer.style.display = "block";
                toggleBtn.textContent = "−";
                toggleBtn.style.backgroundColor = "red";
            } else {
                answer.style.display = "none";
                toggleBtn.textContent = "+";
                toggleBtn.style.backgroundColor = "green";
            }
        });
    });
});
