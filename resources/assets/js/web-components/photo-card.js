class PhotoCard extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
         padding: 10px;
          margin-bottom: 3vw;
          background: #fff;
          position: relative;
          display: block;
        }
        
        .info {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.8);
          opacity: 0;
          transition: all 0.2s linear;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          color: #fff;
          padding: 0 15px;
          line-height: 1.5;
          text-align: center;
          box-sizing: border-box;
        }
        
        :host(:hover) .info {
          opacity: 1;
        }
        
        .link {
          display: block;
          width: 350px;
          height: 350px;
        }
        
        .img {
          width: 100%;
          height: 100%;
          object-fit: contain;
        }
        
        .photo-title {
          font-size: 16px;
        }
        
        @media (max-width: 1100px) {
          .link {
            width: 100%;
          }
        }
      </style>
      
      <a href="${this.getAttribute('photo-url')}" class="link">
        <img src="${this.getAttribute('photo-src')}" alt="${this.getAttribute('photo-title')}" class="img">
        <div class="info">
          <h3 class="photo-title">「${this.getAttribute('photo-title')}」</h3>
          <p class="anime-title">Anime is ${this.getAttribute('anime-title')}</p>
        </div>
      </a>
    `;
  }
}
customElements.define('hpp-photo-card', PhotoCard);
