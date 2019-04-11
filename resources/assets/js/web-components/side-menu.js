class SideMenu extends HTMLElement {
  constructor() {
    super();

    const shadowRoot = this.attachShadow({mode: 'open'});

    let action = '';
    if (this.getAttribute('login')) {
      action = `
        <li class="item">
          <a href="${this.getAttribute('logout-href')}" class="link">ログアウト</a>
        </li>
      `;
    } else {
      action = `
        <li class="item">
          <a href="${this.getAttribute('login-href')}" class="link">ログイン</a>
        </li>
      `;
    }

    shadowRoot.innerHTML = `
      <style>
       :host {
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          position: absolute;
          display: block;
          z-index: 120;
        }
        
        :host([hidden]) {
          display: none;
        }
    
        .overlay {
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          display: block;
          position: fixed;
          background: #000;
          opacity: 0.6;
          z-index: 130;
        }
        
        .list {
          top: 0;
          right: 0;
          height: 100%;
          text-align: center;
          display: block;
          position: fixed;
          z-index: 140;
          background-color: #fff;
          overflow-y: scroll;
          margin: 0;
          padding: 0;
          list-style-type: none;
        }
        
        .item + .item {
          border-top: 1px solid #d4d4d6;
        }
        
        .item:last-child {
          border-bottom: 1px solid #d4d4d6;
        }
        
        .item--main {
          display: none;
        }
        
        .link {
          padding: 20px 30px;
          display: block;
          color: #000;
          text-decoration: none;
        }
        
        @media (max-width: 1100px) {
          .item--main {
            display: list-item;
          }
        }
      </style>
      
      <a href="javascript:void(0);" class="overlay"></a>
      <ul class="list">
        <li class="item item--main">
          <a href="${this.getAttribute('photo-create-href')}" class="link js-sw-fetch">投稿する</a>
        </li>
        <li class="item item--main">
          <a href="${this.getAttribute('anime-href')}" class="link js-sw-fetch">アニメ一覧</a>
        </li>
        ${action}
        <li class="item">
          <a href="${this.getAttribute('about-href')}" class="link js-sw-fetch">このサイトについて</a>
        </li>
        <li class="item">
          <a href="${this.getAttribute('inquiry-href')}" class="link js-sw-fetch">お問い合わせ</a>
        </li>
        <li class="item">
          <a href="${this.getAttribute('kiyaku-href')}" class="link js-sw-fetch">利用規約</a>
        </li>
        <li class="item">
          <a href="${this.getAttribute('privacy-href')}" class="link js-sw-fetch">プライバシーポリシー</a>
        </li>
      </ul>
    `;

    shadowRoot.querySelector('.overlay').addEventListener('click', () => {
      this.setAttribute('hidden', true);
    });
  }
}
customElements.define('hpp-side-menu', SideMenu);
