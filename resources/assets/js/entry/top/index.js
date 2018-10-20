import '../../common/base';
import axios from 'axios';

Vue.directive('photos', {
  bind: function (el, binding, vnode) {
    vnode.context.photos = binding.value;
  }
});

new Vue({
  el: '#wrapper',
  data() {
    return {
      photos: [],
      page: 2,
    }
  },
  methods: {
    readMore() {
      axios.get('/api/photos', {
        params: {
          page: this.page++
        }
      }).then(res => {
        this.photos = this.photos.concat(res.data.data);
      });
    }
  },
});
console.log('hog');