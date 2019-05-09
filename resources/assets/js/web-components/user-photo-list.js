class UserPhotoList extends HTMLElement {

  fetchPhoto() {
    fetch(`/api/photos/get/user/${this.getAttribute('user-id')}`).then(res => res.json()).then(res => {
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
    this.shadow = this.attachShadow({mode: 'open'});

    this.fetchPhoto();

    this.shadow.innerHTML = `
      <style>
        :host {
          display: block;
        }
        .list {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          padding-top: 20px;
        }
        ::slotted(h1) {
          font-size: 25px;
          text-align: center;
          margin: 0;
        }
        ::slotted(h2) {
          text-align: center;
          margin: 0;
        }
      </style>
      
      <slot></slot>
      <div id="js-list" class="list"></div>
    `;
  }
}

customElements.define('hpp-user-photo-list', UserPhotoList);
