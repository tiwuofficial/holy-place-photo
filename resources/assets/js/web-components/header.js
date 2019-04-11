class Header extends HTMLElement {
  constructor() {
    super();

    const shadowRoot = this.attachShadow({mode: 'open'});

    let action = '';
    if (this.getAttribute('login')) {
      action = `
        <div class="item">
          <a href="${this.getAttribute('logout-href')}" class="link">ログアウト</a>
        </div>
      `;
    } else {
      action = `
        <div class="item">
          <a href="${this.getAttribute('login-href')}" class="link">ログイン</a>
        </div>
      `;
    }

    shadowRoot.innerHTML = `
      <style>
       :host {
          height: 50px;
          display: flex;
          padding: 0 20px;
        }
    
        .item {
          display: flex;
          align-items: center;
        }
    
        .item:first-of-type {
          flex-grow: 1;
        }
    
        .item + .item {
          margin-left: 20px;
        }
    
        .link {
          color: #000;
          text-decoration: none;
        }
    
        .icon {
          height: 30px;
        }
    
        @media (max-width: 1100px) {
          .item {
            display: none;
          }
    
          .item--logo,
          .item--icon {
            display: flex;
          }
        }
      </style>
      
      <div class="item item--logo">
        <a href="${this.getAttribute('top-href')}" class="link js-sw-fetch">Holy Place Photo</a>
      </div>
      <div class="item">
        <a href="${this.getAttribute('photo-create-href')}" class="link">投稿する</a>
      </div>
      <div class="item">
        <a href="${this.getAttribute('anime-href')}" class="link">アニメ一覧</a>
      </div>
      ${action}
      <div class="item item--icon">
        <a href="javascript:void(0);" class="open">
          <img src="/img/icon/menu.svg" alt="menu icon" class="icon">
        </a>
      </div>
    `;

    shadowRoot.querySelector('.open').addEventListener('click', () => {
      document.querySelector('hpp-side-menu').removeAttribute('hidden');
    });
  }
}
customElements.define('hpp-header', Header);
