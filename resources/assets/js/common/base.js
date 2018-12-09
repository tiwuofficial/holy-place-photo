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

if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/sw.js').then( (registration) => {
    // 登録成功
    console.log('ServiceWorker registration successful with scope: ', registration.scope);
  }).catch((err) => {
    // 登録失敗 :(
    console.log('ServiceWorker registration failed: ', err);
  });
}
console.log('hfffff');