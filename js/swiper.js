// swiper.js

var swiper = new Swiper('.screen-slider', {
    // slidesPerView: 5,
    centeredSlides: true,
    spaceBetween: 24,
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 2,
      },
      576: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 3.5,
      },
      // 991: {
      //   slidesPerView: 3,
      // },
      1024: {
        slidesPerView: 4.2,
      },
    }
  });