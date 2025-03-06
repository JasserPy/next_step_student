
    // Scroll animation for loading sections
    window.addEventListener('scroll', function () {
        const elements = document.querySelectorAll('.faculty-card, .resource-card');
        const windowHeight = window.innerHeight;

        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            if (elementTop < windowHeight) {
                element.classList.add('show'); // Add the 'show' class
            }
        });
    });

    // Smooth scroll to section
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Fade-in effect on header when scrolling
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header-section');
        if (header && window.scrollY > 50) {
            header.classList.add('scrolled');
        } else if (header) {
            header.classList.remove('scrolled');
        }
    });

