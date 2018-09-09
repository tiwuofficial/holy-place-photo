import '../common/base';
import axios from 'axios';

Vue.directive('like-done', {
  bind: function (el, binding, vnode) {
    vnode.context.likeDone = !!binding.value;
  }
});

Vue.directive('like-count', {
  bind: function (el, binding, vnode) {
    vnode.context.likeCount = binding.value;
  }
});

new Vue({
  el: '#wrapper',
  data(){
    return {
      likeDone: false,
      likeCount: 0,
      likeDoneApiFlg: false,
    }
  },
  methods: {
    like(id) {
      if (this.likeDoneApiFlg) {
        return;
      }
      this.likeDoneApiFlg = true;
      if (this.likeDone) {
        this.likeCount--;
      } else {
        this.likeCount++;
      }
      this.likeDone = !this.likeDone;
      axios.post(`/api/photos/${id}/like`)
          .then((data) => {
            this.likeDone = data.data === 'ok';
          }).catch()
          .then(() => {
            this.likeDoneApiFlg = false;
          });
    }
  },
  computed: {
    likeText() {
      return this.likeDone ? '尊いね！をキャンセルする' : '尊いね！';
    }
  }
});