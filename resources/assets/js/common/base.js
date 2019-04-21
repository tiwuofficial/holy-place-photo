import Vue from 'vue';
import '../module/service-worker';

window.Vue = Vue;

window.addEventListener("load", () => {
  document.querySelectorAll('img').forEach((e) => {
    const imageSrc = e.getAttribute('data-src');
    if (imageSrc) {
      e.setAttribute('src', imageSrc);
    }
  });
}, false);
