class AnimeCard extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          display: block;
          padding: 10px;
        }
        
      </style>
      <a href="${this.getAttribute('anime-url')}">
        <p>${this.getAttribute('anime-name')}</p>
        <p>投稿数：${this.getAttribute('anime-photo-count')}</p>
      </a>
    `;
  }
}
customElements.define('hpp-anime-card', AnimeCard);
