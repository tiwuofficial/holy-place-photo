class AnimeMap extends HTMLElement {
  constructor() {
    super();

    const positions = JSON.parse(this.getAttribute('positions'));
    const map = new google.maps.Map(document.getElementById(this.getAttribute('map-id')));
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
        map: map
      });
      bounds.extend(marker.position);
    });
    map.fitBounds(bounds);

    this.attachShadow({mode: 'open'}).innerHTML = `
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
