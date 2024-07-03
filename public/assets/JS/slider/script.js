var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
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
    speed: 1000,
    mousewheel: {
      invert: true,
    },
    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
  });
