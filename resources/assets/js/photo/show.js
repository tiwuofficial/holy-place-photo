import '../common/base';
import modal from '../components/modal';
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
  components: {modal: modal},
  data() {
    return {
      likeDone: false,
      likeCount: 0,
      likeDoneApiFlg: false,
      deleteModalFlg: false,
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
    },
    deleteModalOpen() {
      this.deleteModalFlg = true;
    },
    deleteModalClose() {
      this.deleteModalFlg = true;
    }
  },
  computed: {
    likeText() {
      return this.likeDone ? '尊いね！をキャンセルする' : '尊いね！';
    }
  }
});