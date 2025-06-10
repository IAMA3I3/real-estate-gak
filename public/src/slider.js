// showcase slide
var swiper = new Swiper(".showcaseSwiper", {
    centeredSlides: true,
    loop: true,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".showcase-next",
        prevEl: ".showcase-prev",
    },
});

// primary slide
var swiper1 = new Swiper(".primary-swiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    breakpoints: {
        300: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 50,
        },
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    }
});