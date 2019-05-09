class PhotoMap extends HTMLElement {
  constructor() {
    super();

    // TODO 初期値
    const lat = this.getAttribute('lat') ? parseFloat(this.getAttribute('lat')) : 35.6698324;
    const lng = this.getAttribute('lng') ? parseFloat(this.getAttribute('lng')) : 139.48197549999998;
    const map = new google.maps.Map(document.getElementById(this.getAttribute('map-id')), {
      center: {
        lat: lat,
        lng: lng
      },
      zoom: 16
    });
    new google.maps.Marker({
      position: {
        lat: lat,
        lng: lng
      },
      map: map
    });

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        ::slotted(.${this.getAttribute('map-class')}) {
          width: 600px;
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
customElements.define('hpp-photo-map', PhotoMap);
