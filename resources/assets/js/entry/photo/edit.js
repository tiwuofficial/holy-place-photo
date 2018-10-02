import '../../common/base';
import modal from '../../components/modal';

Vue.directive('photo', {
  bind: function (el, binding, vnode) {
    vnode.context.photo = binding.value;
  }
});

Vue.directive('animes', {
  bind: function (el, binding, vnode) {
    vnode.context.animes = binding.value;
  }
});

new Vue({
  el: '#wrapper',
  components: {modal: modal},
  mounted() {
    // todo magic number
    for (let i = 0; i < 5; i++) {
      if (this.photo.urls[i]) {
        this.file[i].previewImageSrc = this.photo.urls[i].full_url;
        this.photoUrls[i] = this.photo.urls[i].url;
      } else {
        this.photoUrls[i] = false;
      }
    }
    this.animeTitle = this.animes.filter(anime => {
      return anime.id === this.photo.anime_id;
    })[0].name;

    // TODO 初期値
    const lat = this.photo.lat ? this.photo.lat : 35.6698324;
    const lng = this.photo.lng ? this.photo.lng : 139.48197549999998;
    this.map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: lat,
        lng: lng
      },
      zoom: 16
    });
    this.marker = new google.maps.Marker({
      position: {
        lat: lat,
        lng: lng
      },
      map: this.map
    });
    this.map.addListener('click', e => {
      this.photo.lat = e.latLng.lat();
      this.photo.lng = e.latLng.lng();
      if (this.marker) {
        this.marker.setMap(null);
      }
      this.marker = new google.maps.Marker({
        position: e.latLng,
        map: this.map
      });
      this.map.panTo(e.latLng);
    });
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
      photoUrls: [],
      deletePhotoUrls: [],
      photo: {
        name: '',
        title: '',
        comment: '',
        anime_id: ''
      },
      animeTitle: '',
      animes: [],
      editModalFlg: false,
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
        anime_id: !!this.photo.anime_id
      }
    },
    isDisabled() {
      let allValidation = Vue.util.extend({}, this.validation);

      const existPhotoUrls = this.photoUrls.filter(v => {
        return v;
      });
      const existFiles = this.file.filter(v => {
        return v.type !== '';
      });
      allValidation['file'] = existPhotoUrls.length !== 0 || existFiles.length !== 0;
      return !Object.keys(allValidation).every(key => {
        return allValidation[key];
      });
    }
  },
  methods: {
    editModalOpen() {
      this.editModalFlg = true;
    },
    editModalClose() {
      this.editModalFlg = false;
    },
    file_change(id, event) {
      const file = event.target.files[0];
      if (typeof file !== 'undefined') {
        this.file[id].type = file.type;
        if (this.file[id].type === 'image/gif' || this.file[id].type === 'image/jpeg' || this.file[id].type === 'image/png') {
          this.file[id].previewImageSrc = window.URL.createObjectURL(file);
          if (this.photoUrls[id]) {
            this.deletePhotoUrls.push(this.photoUrls[id]);
            this.photoUrls[id] = '';
          }
        } else {
          this.file[id].previewImageSrc = '';
        }
      }
    },
    clearImg(id) {
      this.file[id].type = '';
      this.file[id].previewImageSrc = '';
      document.getElementById(`photo_${id}`).value = '';
      if (this.photoUrls[id]) {
        this.deletePhotoUrls.push(this.photoUrls[id]);
        Vue.set(this.photoUrls, id, '');
      }
    }
  },
});