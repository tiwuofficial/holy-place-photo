import '../../common/base';

new Vue({
  el: '#wrapper',
  mounted() {
    document.querySelector('.js-tw-share').href = 'http://twitter.com/share?url=' + location.href;
  },
});