const mainSwiper = new Swiper(".banner-slider", {
  // Optional parameters
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  loop: false,
  mousewheel: false,
  keyboard: {
    enabled: true,
  },

  // Enabled autoplay mode
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },

  // If we need pagination
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: false,
    clickable: true,
  },
});

const reviewSwiper = new Swiper(".review-questions-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  loop: true,
  mousewheel: false,
  keyboard: {
    enabled: true,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 24,
    },
    1024: {
      slidesPerView: 6,
      spaceBetween: 24,
    },
  },
});

const productImgSwiper = new Swiper(".product-img-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const productImgSliderInFullscreen = new Swiper(".product-img-slider-in-fullscreen", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,

  navigation: {
    nextEl: ".swiper-button-next-full",
    prevEl: ".swiper-button-prev-full",
  },
});

const addProductImgSwiper = new Swiper(".add-product-img-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const searchControlsSwiper = new Swiper(".search-controls-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  mousewheel: false,
  touchRatio: 0.2,
  keyboard: {
    enabled: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 0,
    },
    420: {
      slidesPerView: 2,
      spaceBetween: 0,
    },
    580: {
      slidesPerView: 3,
      spaceBetween: 0,
    },
    680: {
      slidesPerView: 4,
      spaceBetween: 0,
    },
    860: {
      slidesPerView: 5,
      spaceBetween: 0,
    },
    1060: {
      slidesPerView: 7,
      spaceBetween: 0,
    },
    1260: {
      slidesPerView: 8,
      spaceBetween: 0,
    }
  },
});

const lastViewedSwiper = new Swiper(".last-viewed-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  mousewheel: false,
  touchRatio: 0.2,
  slideToClickedSlide: true,
  keyboard: {
    enabled: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 24,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
    1340: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
  },
});

const reviewControlsSwiper = new Swiper(".reviwe-controls-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  mousewheel: false,
  touchRatio: 0.2,
  slideToClickedSlide: true,
  keyboard: {
    enabled: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    390: {
      slidesPerView: 2,
      spaceBetween: 0,
    },
    620: {
      slidesPerView: 3,
      spaceBetween: 0,
    },
    1920: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  },
});

const reviewResponseSwiper = new Swiper(".review-response-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  loop: true,
  mousewheel: false,
  touchRatio: 0.2,
  keyboard: {
    enabled: true,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 24,
    },
    1024: {
      slidesPerView: 6,
      spaceBetween: 24,
    },
  },
});

function updateSlider(){
    reviewResponseSwiper.update();
}

const reviewResponseFullscreenSwiper = new Swiper(".review-question-fullscreen-slider", {
  centeredSlides: false,
  slidesPerView: 1,
  grabCursor: true,
  freeMode: false,
  mousewheel: false,
  touchRatio: 0.2,
  slideToClickedSlide: true,
  keyboard: {
    enabled: true,
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    }
  }
});

document.querySelectorAll('.slider-width-fullscren').forEach(element => {
  element.addEventListener('click', () => {
    const fullScreenDiv = document.querySelector('.question-fullscreen')
    // const fullScreen = document.querySelector('.review-response-fullscreen-slider').querySelector('.swiper-wrapper')
    fullScreenDiv.style.display = 'block';
    // const clone = element.parentElement.parentElement.cloneNode(true)
    // fullScreen.appendChild(clone)
    // console.log(clone);
  })
});

const closeFull = document.querySelector('.close-full')

if (closeFull) {
  closeFull.addEventListener('click', () => {
    document.querySelector('.question-fullscreen').style.display = 'none';
  })
}


