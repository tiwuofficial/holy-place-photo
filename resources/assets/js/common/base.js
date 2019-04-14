import Vue from 'vue';
import {cache, cacheExpire} from '../module/cache';

Vue.config.ignoredElements = [
  'hpp-header',
  'hpp-footer',
  'hpp-side-menu',
  'hpp-hero',
  'hpp-photo-list',
  'hpp-photo-card'
];

window.Vue = Vue;

window.addEventListener("load", () => {
  document.querySelectorAll('img').forEach((e) => {
    const imageSrc = e.getAttribute('data-src');
    if (imageSrc) {
      e.setAttribute('src', imageSrc);
    }
  });
}, false);

window.holyPlacePhoto = {};

if ('serviceWorker' in navigator) {
  window.holyPlacePhoto.CACHE_NAME = '5';

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
};


