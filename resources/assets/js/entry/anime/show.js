import '../../common/base';

Vue.directive('photos', {
  bind: function (el, binding, vnode) {
    vnode.context.photos = binding.value;
  }
});

new Vue({
  el: '#wrapper',
  mounted() {
    // TODO 初期値
    this.map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: 45.6698324,
        lng: 139.48197549999998
      },
      zoom: 16
    });
    console.log(this.photos);
    let bounds = new google.maps.LatLngBounds();
    for (let i = 0; i < this.photos.length; i++) {
      if (!this.photos[i]['lat']) {
        continue;
      }
      const marker = new google.maps.Marker({
        position: {
          lat: this.photos[i]['lat'],
          lng: this.photos[i]['lng']
        },
        map: this.map
      });
      bounds.extend(marker.position);
    }
    this.map.fitBounds(bounds);
  },
  data() {
    return {
      map: {},
      marker: null,
      photos: []
    }
  }
});