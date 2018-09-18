import '../../common/base';

Vue.directive('photo', {
  bind: function (el, binding, vnode) {
    vnode.context.photo = binding.value;
  }
});

new Vue({
  el: '#wrapper',
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
      }
    }
  },
  methods: {
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
        this.photoUrls[id] = '';
      }
    }
  },
});