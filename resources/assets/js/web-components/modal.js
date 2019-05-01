class Modal extends HTMLElement {
  constructor() {
    super();

    const shadowRoot = this.attachShadow({mode: 'open'});

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
        
        .contents {
          top: 50%;
          left: 50%;
          max-height: 80%;
          width: 70%;
          padding: 20px;
          text-align: center;
          display: block;
          position: fixed;
          z-index: 140;
          transform: translate(-50%, -50%);
          -webkit-transform: translate(-50%, -50%);
          background-color: #fff;
          border-radius: 3px;
          overflow-y: scroll;
        }
      </style>
      
      <a href="javascript:void(0);" class="overlay"></a>
      <div class="contents">
        <slot></slot>
      </div>
    `;

    shadowRoot.querySelector('.overlay').addEventListener('click', () => {
      this.setAttribute('hidden', true);
    });
  }
}
customElements.define('hpp-modal', Modal);
