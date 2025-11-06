// Menu mobile
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    
    if (hamburger) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }
    
    // Fermer le menu en cliquant sur un lien
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        });
    });
    
    // Validation du formulaire de rendez-vous
    const appointmentForm = document.querySelector('.appointment-form');
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', function(e) {
            const phoneInput = document.getElementById('patient_phone');
            const phoneRegex = /^[0-9+\-\s()]{10,}$/;
            
            if (!phoneRegex.test(phoneInput.value)) {
                e.preventDefault();
                alert('Veuillez entrer un numéro de téléphone valide.');
                phoneInput.focus();
                return false;
            }
            
            const dateInput = document.getElementById('appointment_date');
            const selectedDate = new Date(dateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                e.preventDefault();
                alert('Veuillez sélectionner une date future.');
                dateInput.focus();
                return false;
            }
        });
    }
    
    // Animation au défilement
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.feature-card, .service-card');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (elementPosition < screenPosition) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Initialiser les animations
    const animatedElements = document.querySelectorAll('.feature-card, .service-card');
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });
    
    window.addEventListener('scroll', animateOnScroll);
    // Déclencher une première fois au chargement
    animateOnScroll();
});