class PhotoList extends HTMLElement {

  fetchPhoto() {
    const params = new URLSearchParams();
    params.set('page', this.page++);
    params.set('perPage', this.perPage);

    fetch(`/api/photos?${params.toString()}`).then(res => res.json()).then(res => {
      res.forEach(photo => {
        const photoCard = document.createElement('hpp-photo-card');
        photoCard.setAttribute('photo-url', photo.url);
        photoCard.setAttribute('photo-src', photo.photoUrl);
        photoCard.setAttribute('photo-title', photo.title);
        photoCard.setAttribute('anime-title', photo.animeName);
        this.shadow.getElementById('js-list').appendChild(photoCard);
      });
    });
  }

  constructor() {
    super();
    this.page = 1;
    const ua = navigator.userAgent;
    if (ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
      this.perPage = 3;
    } else {
      this.perPage = 12;
    }
    this.shadow = this.attachShadow({mode: 'open'});

    this.fetchPhoto();

    this.shadow.innerHTML = `
      <style>
        :host {
          display: block;
        }
        ::slotted(h2) {
          text-align: center;
          font-size: 20px;
          margin: 0 0 15px 0;
        }
        .list {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          padding: 0 8px;
        }
        .link {
          text-align: center;
          display: block;
          margin-top: 20px;
        }
      </style>
      
      <slot></slot>
      <div id="js-list" class="list"></div>
      <a href="javascript:void(0);" id="js-link" class="link">More</a>
    `;
    this.shadow.getElementById('js-link').addEventListener('click', e => {
      this.fetchPhoto();
    })
  }
}

customElements.define('hpp-photo-list', PhotoList);
