import {cache, cacheExpire} from "./cache";

window.holyPlacePhoto = {};

if ('serviceWorker' in navigator) {
  window.holyPlacePhoto.CACHE_NAME = '8';

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
      cacheExpire(e.getAttribute('href'), window.holyPlacePhoto.CACHE_NAME);
    });

    JSON.parse(document.getElementById('wrapper').dataset.swCacheList).forEach((url) => {
      cache(url, window.holyPlacePhoto.CACHE_NAME);
    });
  });
}
