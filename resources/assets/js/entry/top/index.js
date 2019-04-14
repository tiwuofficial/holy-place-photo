import '../../common/base';
import axios from 'axios';
import {cacheExpire} from '../../module/cache';

new Vue({
  el: '#wrapper',
  data() {
    return {
      animes: [],
    }
  },
  created() {
    this.getAnimes();
  },
  methods: {
    getAnimes() {
      axios.get('/api/anime/get/havePhoto')
      .then(res => {
        this.animes = res.data;
        this.animes.forEach((anime) => {
          cacheExpire(anime.url, window.holyPlacePhoto.CACHE_NAME);
        });
      });
    }
  },
});