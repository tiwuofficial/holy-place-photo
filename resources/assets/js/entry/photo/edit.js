import '../../common/base';

Vue.directive('photo', {
  bind: function (el, binding, vnode) {
    console.log(binding.value);
    vnode.context.photo.name = binding.value.name;
    vnode.context.photo.title = binding.value.title;
    vnode.context.photo.comment = binding.value.comment;
  }
});

new Vue({
  el: '#wrapper',
  created() {
    for (let i = 1; i <= 5; i++) {
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
        comment: ''
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
        } else {
          this.file[id].previewImageSrc = '';
        }
      }
    },
    clearImg(id) {
      this.file[id].type = '';
      this.file[id].previewImageSrc = '';
      document.getElementById(`photo_${id}`).value = '';
    }
  },
});