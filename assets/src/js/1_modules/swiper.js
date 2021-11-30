window.salemoche.initializeSwiper = () => {
    const swiper = new Swiper('.swiper', {
        loop: true,
        speed: 500,
        spaceBetween: 12,
    
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
          delay: 5000,
        },
    });
    
    console.log('swiper initialized');
}

window.salemoche.initializeSwiper();