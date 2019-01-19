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
  const CACHE_NAME = '2';

  const controllerChange = new Promise((resolve) => {
    navigator.serviceWorker.addEventListener('controllerchange', resolve);
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
      caches.open(CACHE_NAME).then((cache) => {
        cache.match(url).then((response) => {
          if (!response) {
            // キャッシュにない時
            cache.add(url);
            localStorage.setItem(url, Date.now());
          } else {
            // キャッシュにある時
            const time = localStorage.getItem(url);
            if (!time || Date.now() - time > 86400 * 1000) {
              // データの更新
              cache.delete(url).then(() => {
                cache.add(url);
                localStorage.setItem(url, Date.now());
              });
            }
          }
        });
      });
    });

    JSON.parse(document.getElementById('wrapper').dataset.swCacheList).forEach((file) => {
      caches.open(CACHE_NAME).then((cache) => {
        cache.match(file).then((response) => {
          if (!response) {
            cache.delete(file.split('?')[0], { ignoreSearch:true }).then(() => {
              cache.add(file);
            });
          }
        });
      });
    });
  });
}


