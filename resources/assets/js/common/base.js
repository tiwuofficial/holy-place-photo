import Vue from 'vue';
import sideMenu from '../components/sideMenu';

Vue.mixin({
  components: {"side-menu": sideMenu},
  data: function() {
    return {
      sideMenuFlg: false
    }
  },
  methods: {
    sideMenuOpen() {
      this.sideMenuFlg = true;
    },
    sideMenuClose(){
      this.sideMenuFlg = false;
    },
  }
});

window.Vue = Vue;

window.addEventListener("load", () => {
  const imageElements = document.querySelectorAll('img');
  for (let i = 0, len = imageElements.length; i < len; i++) {
    const imageSrc = imageElements[i].getAttribute('data-src');
    if (imageSrc) {
      imageElements[i].setAttribute('src', imageSrc);
    }
  }
}, false);