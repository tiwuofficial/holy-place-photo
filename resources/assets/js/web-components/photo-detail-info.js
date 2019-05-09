class PhotoDetailInfo extends HTMLElement {
  constructor() {
    super();

    let shootingDate = '';
    if (this.getAttribute('shooting-date')) {
      shootingDate = `
        <p class="text">撮影日時 ${this.getAttribute('shooting-date')}</p>
      `;
    }

    this.attachShadow({mode: 'open'}).innerHTML = `
        <style>
          :host {
            display: block;
            width: 100%;
            box-sizing: border-box;
          }
          h1 {
            margin: 0;
            text-align: left;
          }
          p {
            margin: 0;
            text-align: left;
          }
          .text {
            font-size: 16px;
          }
          h1 + .text,
          .text + .text {
            margin-top: 10px;
          }
          .footer {
            display: flex;
            font-size: 14px;
          }
          .text + .footer {
            margin-top: 30px;
          }
          .created_text {
            flex-grow: 1;
          }
          hpp-photo-edit-link + hpp-photo-destroy-link {
            margin-left: 15px;
          }
          @media (max-width: 1100px) {
            :host {
              padding: 0 15px;
            }
          }
        </style>
        
        <h1>${this.getAttribute('title')}</h1>
        <p class="text">Anime is <a href="${this.getAttribute('anime-link')}">${this.getAttribute('anime-name')}</a></p>
        ${shootingDate}
        <p class="text">Photo by <a href="${this.getAttribute('user-link')}">${this.getAttribute('user-name')}</a></p>
        <p class="text">${this.getAttribute('comment')}</p>
        <p class="footer">
          <span class="created_text">${this.getAttribute('created-at')}</span>
          <hpp-photo-edit-link
            link="${this.getAttribute('edit-link')}"
            csrf-token="${this.getAttribute('csrf-token')}"
          >
          </hpp-photo-edit-link>
          <hpp-photo-destroy-link
            link="${this.getAttribute('edit-link')}"
            csrf-token="${this.getAttribute('csrf-token')}"
          >
          </hpp-photo-destroy-link>
        </p>
    `;
  }
}

customElements.define('hpp-photo-detail-info', PhotoDetailInfo);
