import Vue from 'vue';
import sideMenu from '../components/sideMenu';

Vue.mixin({
  components: {"side-menu": sideMenu},
  data: function() {
    return {
      sideMenuFlg: false
    }
  },
  methods: {
    sideMenuOpen() {
      this.sideMenuFlg = true;
    },
    sideMenuClose(){
      this.sideMenuFlg = false;
    },
  }
});

window.Vue = Vue;