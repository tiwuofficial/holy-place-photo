import '../../common/base';
import axios from 'axios';

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