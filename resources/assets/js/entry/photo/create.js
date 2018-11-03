import '../../common/base';

Vue.directive('animes', {
  bind: function (el, binding, vnode) {
    const animes = binding.value;
    for (let anime in animes) {
      vnode.context.animes.push({
        id: anime,
        name: animes[anime]
      });
    }
  }
});

Vue.directive('user', {
  bind: function (el, binding, vnode) {
    vnode.context.photo.name = binding.value.name ? binding.value.name : '';
  }
});

new Vue({
  el: '#wrapper',
  mounted() {
    // TODO 初期値
    this.map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 35.6698324, lng: 139.48197549999998},
      zoom: 16
    });
    this.map.addListener('click', e => {
      this.photo.lat = e.latLng.lat();
      this.photo.lng = e.latLng.lng();
      if (this.marker) {
        this.marker.setMap(null);
      }
      this.marker = new google.maps.Marker({
        map: this.map,
        position: e.latLng
      });
      this.map.panTo(e.latLng);
    });
    this.geocoder = new google.maps.Geocoder();
  },
  created() {
    for (let i = 0; i < 5; i++) {
      this.$set(this.file, i, {});
      this.$set(this.file[i], 'previewImageSrc', '');
      this.$set(this.file[i], 'type', '');
    }
  },
  data() {
    return {
      file: [],
      photo: {
        name: '',
        title: '',
        comment: '',
        password: '',
        passwordConfirm: '',
        anime_id: '',
        lat: '',
        lng: ''
      },
      map: {},
      marker: null,
      geocoder: {},
      animeTitle: '',
      animes: [],
      address: ''
    }
  },
  computed: {
    filteredAnimes() {
      if (!this.animeTitle) return [];
      return this.animes.filter(anime => {
        return anime.name.indexOf(this.animeTitle) > -1
      })
    },
    validation() {
      return {
        name: !!this.photo.name.trim(),
        title: !!this.photo.title.trim(),
        password: !!this.photo.password.trim() && this.photo.password.length >= 4,
        passwordConfirm: !!this.photo.passwordConfirm.trim() && this.photo.passwordConfirm.length >= 4,
        passwordSame: this.photo.password === this.photo.passwordConfirm,
        anime_id: !!this.photo.anime_id
      }
    },
    isDisabled() {
      const existFiles = this.file.filter(v => {
        return v.type !== '';
      });
      if (existFiles.length === 0) {
        return true;
      }
      let allValidation = Vue.util.extend({}, this.validation);
      return !Object.keys(allValidation).every(key => {
        return allValidation[key];
      });
    }
  },
  methods: {
    file_change(id, event) {
      const file = event.target.files[0];
      if (typeof file !== 'undefined') {
        this.file[id].type = file.type;
        if (this.file[id].type === 'image/gif' || this.file[id].type === 'image/jpeg' || this.file[id].type === 'image/png') {
          this.file[id].previewImageSrc = window.URL.createObjectURL(file);
        } else {
          this.file[id].type = '';
          this.file[id].previewImageSrc = '';
        }
      }
    },
    clearImg(id) {
      this.file[id].type = '';
      this.file[id].previewImageSrc = '';
      document.getElementById(`photo_${id}`).value = '';
    },
    mapSearch() {
      this.geocoder.geocode({
        'address': this.address
      }, (results, status) => {
        if (status === google.maps.GeocoderStatus.OK) {
          this.map.setCenter(results[0].geometry.location);
          this.photo.lat = results[0].geometry.location.lat();
          this.photo.lng = results[0].geometry.location.lng();
          this.marker = new google.maps.Marker({
            map: this.map,
            position: results[0].geometry.location
          });
        }
      });
    }
  },
});