import '../../common/base';
import axios from 'axios';

new Vue({
  el: '#wrapper',
  mounted() {
    axios.get('/api/anime/get/noHavePhoto')
        .then((data) => {
          for (let anime in data.data) {
            this.noHavePhotoAnimes.push({
              id: anime,
              name: data.data[anime],
            });
          }
        })
  },data() {
    return {
      noHavePhotoAnimes: []
    }
  }
});