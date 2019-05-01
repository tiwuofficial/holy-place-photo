import '../../common/base';
import Swiper from 'swiper';

Vue.directive('photo', {
  bind: function (el, binding, vnode) {
    vnode.context.photo = binding.value;
  }
});

new Vue({
  el: '#wrapper',
  mounted() {
    new Swiper('.js-slider', {
      speed:800,
      slidesPerView: 2,
      centeredSlides : true,
      effect: 'coverflow',
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : false,
      },
      grabCursor: true,
      parallax: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        1023: {
          slidesPerView: 1,
          spaceBetween: 0
        }
      },
    });

    document.querySelector('.js-tw-share').href = 'http://twitter.com/share?url=' + location.href;
  },
  data() {
    return {
      photo: {}
    }
  },
  methods: {
    editModalOpen() {
      document.getElementById('js-edit-modal').removeAttribute('hidden');
    },
    destroyModalOpen() {
      document.getElementById('js-destroy-modal').removeAttribute('hidden');
    },
  }
});