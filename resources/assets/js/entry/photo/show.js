import '../../common/base';
import modal from '../../components/modal';
import axios from 'axios';
import Swiper from 'swiper';

Vue.directive('like-done', {
  bind: function (el, binding, vnode) {
    vnode.context.likeDone = !!binding.value;
  }
});

Vue.directive('like-count', {
  bind: function (el, binding, vnode) {
    vnode.context.likeCount = binding.value;
  }
});

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
    this.map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: this.photo.lat,
        lng: this.photo.lng
      },
      zoom: 16
    });
    this.marker = new google.maps.Marker({
      position: {
        lat: this.photo.lat,
        lng: this.photo.lng
      },
      map: this.map
    });
    document.querySelector('.js-tw-share').href = 'http://twitter.com/share?url=' + location.href;
  },
  data() {
    return {
      likeDone: false,
      likeCount: 0,
      likeDoneApiFlg: false,
      editModalFlg: false,
      deleteModalFlg: false,
      map: {},
      marker: null,
      photo: {}
    }
  },
  computed: {
    likeText() {
      return this.likeDone ? '尊いね！をキャンセルする' : '尊いね！';
    }
  },
  methods: {
    like(id) {
      if (this.likeDoneApiFlg) {
        return;
      }
      this.likeDoneApiFlg = true;
      if (this.likeDone) {
        this.likeCount--;
      } else {
        this.likeCount++;
      }
      this.likeDone = !this.likeDone;
      axios.post(`/api/photos/${id}/like`)
          .then((data) => {
            this.likeDone = data.data === 'ok';
          }).catch()
          .then(() => {
            this.likeDoneApiFlg = false;
          });
    },
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