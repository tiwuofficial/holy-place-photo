class AnimeMap extends HTMLElement {
  constructor() {
    super();

    const shadow = this.attachShadow({mode: 'open'});

    const positions = JSON.parse(this.getAttribute('positions'));
    this.map = new google.maps.Map(document.getElementById('js-map'));
    const bounds = new google.maps.LatLngBounds();
    positions.forEach(position => {
      if (!position['lat'] || !position['lng']) {
        return;
      }
      const marker = new google.maps.Marker({
        position: {
          lat: position['lat'],
          lng: position['lng']
        },
        map: this.map
      });
      bounds.extend(marker.position);
    });
    this.map.fitBounds(bounds);

    shadow.innerHTML = `
      <style>
        ::slotted(.${this.getAttribute('map-class')}) {
          width: 1000px;
          height: 500px;
          margin: 20px auto;
          display: block;
        }
        
        @media (max-width: 1100px) {
          ::slotted(.${this.getAttribute('map-class')}) {
            width: 100%;
          }
        }
      </style>
      
      <slot></slot>
    `;
  }
}
customElements.define('hpp-anime-map', AnimeMap);
