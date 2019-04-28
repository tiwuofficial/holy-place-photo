import Vue from 'vue';
import '../module/service-worker';

window.Vue = Vue;

Vue.config.ignoredElements = [
  'hpp-header',
  'hpp-side-menu',
  'hpp-footer'
];


window.addEventListener("load", () => {
  document.querySelectorAll('img').forEach((e) => {
    const imageSrc = e.getAttribute('data-src');
    if (imageSrc) {
      e.setAttribute('src', imageSrc);
    }
  });
}, false);
