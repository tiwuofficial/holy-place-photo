class PhotoDetail extends HTMLElement {
  constructor() {
    super();

    this.attachShadow({mode: 'open'}).innerHTML = `
        <style>
          :host {
            margin: 0 auto;
            max-width: 1100px;
            display: block;
          }
          .main {
            display: flex;
            justify-content: space-between;
          }
          hpp-photo-detail-info + hpp-photo-map {
            margin-left: 15px;
          }
          .footer {
            display: flex;
            justify-content: space-between;
          }
          .main + .footer {
            margin-top: 20px;
          }
          hpp-like-button,
          hpp-twitter-share-button{
            width: 45%;
          }
          
          @media (max-width: 1100px) {
            .main {
              flex-direction: column;
            }
            hpp-photo-detail-info + hpp-photo-map {
              margin-top: 15px;
              margin-left: 0;
            }
            .footer {
              padding: 0 15px;
            }
          }
        </style>
        
        <div class="main">
          <hpp-photo-detail-info
            title="${this.getAttribute('title')}"
            anime-link="${this.getAttribute('anime-link')}"
            anime-name="${this.getAttribute('anime-name')}"
            shooting-date="${this.getAttribute('shooting-date')}"
            user-link="${this.getAttribute('user-link')}"
            user-name="${this.getAttribute('user-name')}"
            comment="${this.getAttribute('comment')}"
            created-at="${this.getAttribute('created-at')}"
            edit-link="${this.getAttribute('edit-link')}"
            csrf-token="${this.getAttribute('csrf-token')}"
          >
          </hpp-photo-detail-info>
          <hpp-photo-map
            map-id="js-map"
            map-class="map"
            lat="${this.getAttribute('lat')}"
            lng="${this.getAttribute('lng')}"
          >
            <slot name="map"></slot>
          </hpp-photo-map>
        </div>
        <div class="footer">
          <hpp-like-button
            photo-id="${this.getAttribute('photo-id')}"
            like-count="${this.getAttribute('like-count')}"
            like-done="${this.getAttribute('like-done')}"
          ></hpp-like-button>
          <hpp-twitter-share-button></hpp-twitter-share-button>
        </div>
    `;
  }
}

customElements.define('hpp-photo-detail', PhotoDetail);
