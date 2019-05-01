import Vue from 'vue';
import '../module/service-worker';

window.Vue = Vue;

Vue.config.ignoredElements = [
  'hpp-header',
  'hpp-side-menu',
  'hpp-footer',
  'hpp-anime-photo-list',
  'hpp-user-photo-list',
  'hpp-anime-map',
  'hpp-photo-map',
  'hpp-like-button',
  'hpp-modal',
  'hpp-photo-edit-link',
  'hpp-photo-destroy-link',
  'hpp-photo-swiper'
];

window.addEventListener("load", () => {
  document.querySelectorAll('img').forEach((e) => {
    const imageSrc = e.getAttribute('data-src');
    if (imageSrc) {
      e.setAttribute('src', imageSrc);
    }
  });
}, false);
