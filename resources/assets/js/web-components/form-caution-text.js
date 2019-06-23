class FormCautionText extends HTMLElement {
  constructor() {
    super();

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          display: block;
          color: #818182;
          font-size: 13px;
          line-height: 20px;
          text-align: left;
        }
      </style>
      ${this.getAttribute('text')}
    `;
  }
}
customElements.define('hpp-form-caution-text', FormCautionText);
