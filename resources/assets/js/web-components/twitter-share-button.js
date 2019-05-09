class TwitterShareButton extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          width: 100%;
          display: block;
        }
        a {
          width: 100%;
          border-radius: 3px;
          font-size: 16px;
          color: #fff;
          background-color: #0092ca;
          cursor: pointer;
          display: block;
          padding: 10px 0;
          text-align: center;
          -webkit-appearance: none;
          text-decoration: none;
        }
      </style>
      
      <a target="_blank" href="" rel="nofollow">
        Twitterでシェア
      </a>
    `;
    this.shadowRoot.querySelector('a').href = 'http://twitter.com/share?url=' + location.href;
  }
}

customElements.define('hpp-twitter-share-button', TwitterShareButton);
