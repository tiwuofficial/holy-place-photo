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
  document.querySelectorAll('img').forEach((e) => {
    const imageSrc = e.getAttribute('data-src');
    if (imageSrc) {
      e.setAttribute('src', imageSrc);
    }
  });
}, false);

if ('serviceWorker' in navigator) {
  const controllerChange = new Promise((resolve) => {
    navigator.serviceWorker.addEventListener('controllerchange', () => {
      resolve(navigator.serviceWorker.controller);
    });
  });

  navigator.serviceWorker.register('/sw.js').then(() => {
    return navigator.serviceWorker.ready;
  }).then(() => {
    if (navigator.serviceWorker.controller) {
      return navigator.serviceWorker.controller;
    }
    return controllerChange;
  }).then(() => {
    document.querySelectorAll('.js-sw-fetch').forEach((e) => {
      const url = e.getAttribute('href');
      fetch(url);
    });

    JSON.parse(document.getElementById('wrapper').dataset.swCacheList).forEach((file) => {
      fetch(file);
    });
  });
}


