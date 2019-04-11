class Footer extends HTMLElement {
  constructor() {
    super();

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          text-align: center;
          background: #e1e4e8;
          height: 30px;
          line-height: 30px;
          font-size: 12px;
          display: block;
        }
        
        @media (max-width: 1100px) {
          :host {
            font-size: 10px;
          }
        }
      </style>
      
      <footer>Copyright © 2018 Holy Place Photo Inc. All Rights Reserved.</footer>
    `;
  }
}
customElements.define('hpp-footer', Footer);
