import '../../common/base';
import modal from '../../components/modal';
import Swiper from 'swiper';

Vue.directive('photo', {
  bind: function (el, binding, vnode) {
    vnode.context.photo = binding.value;
  }
});

new Vue({
  el: '#wrapper',
  components: {modal: modal},
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
      editModalFlg: false,
      deleteModalFlg: false,
      photo: {}
    }
  },
  methods: {
    editModalOpen() {
      this.editModalFlg = true;
    },
    editModalClose() {
      this.editModalFlg = false;
    },
    deleteModalOpen() {
      this.deleteModalFlg = true;
    },
    deleteModalClose() {
      this.deleteModalFlg = false;
    }
  }
});