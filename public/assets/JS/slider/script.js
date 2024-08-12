var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 70,
    loop: true,
    centeredSlides: 'true',
    fade: 'true',
    grabCursor: 'true',
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },

    navigation: {
      nextEl: ".swip-button-next",
      prevEl: ".swip-button-prev",
    },
    speed: 500,
    mousewheel: {
      invert: true,
    },
    breakpoints:{
        0: {
            slidesPerView: 1,
            spaceBetween: 20,

        },
        // Paramètres pour les écrans moyens
        768: {
            slidesPerView: 3,
            spaceBetween: 40,

        },
        // Paramètres pour les grands écrans

    },
  });




    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section');

        const options = {
            root: null, // Use the viewport as the container
            rootMargin: '0px',
            threshold: 0.1// Trigger when 10% of the section is visible
        };

        const callback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        };

        const observer = new IntersectionObserver(callback, options);

        sections.forEach(section => {
            observer.observe(section);
        });
        
        const hash = window.location.hash;
        if (hash) {
            const targetElement = document.querySelector(hash);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

    });
