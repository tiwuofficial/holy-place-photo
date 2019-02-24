import '../../common/base';
import axios from 'axios';
import {cacheExpire} from '../../module/cache';

new Vue({
  el: '#wrapper',
  data() {
    return {
      photos: [],
      animes: [],
      page: 1,
      perPage: 12
    }
  },
  created() {
    const ua = navigator.userAgent;
    if (ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
      this.perPage = 3;
    }
    this.readMorePhoto();
    this.getAnimes();
  },
  methods: {
    readMorePhoto() {
      axios.get('/api/photos', {
        params: {
          page: this.page++,
          perPage: this.perPage
        }
      }).then(res => {
        this.photos = this.photos.concat(res.data);
        this.photos.forEach((photo) => {
          cacheExpire(photo.url, window.holyPlacePhoto.CACHE_NAME);
        });
      });
    },
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