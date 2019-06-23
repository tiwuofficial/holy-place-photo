class Fieldset extends HTMLElement {

  get required() {
    return this.hasAttribute('required');
  }

  constructor() {
    super();

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          justify-content: space-around;
          display: flex;
        }
        label {
          width: 300px;
          display: flex;
          justify-content: center;
          align-items: flex-end;
          flex-direction: column;
        }
        :host([required]) > label {
          position: relative;
        }
        :host([required]) > label::after {
          content: "必須";
          position: absolute;
          right: -40px;
          background: #d6d5d5;
          padding: 3px;
          font-size: 13px;
        }
        @media (max-width: 1100px) {
          :host {
            display: block;
            padding: 0 15px;
          }
          label {
            align-items: flex-start;
            flex-direction: row;
            justify-content: flex-start;
          }
          :host([required]) > label {
            padding-left: 40px;
          }
          :host([required]) > label::after {
            left: 0;
            right: unset;
          }
          ::slotted(hpp-input),
          ::slotted(hpp-textarea),
          ::slotted(div) {
            margin-top: 15px;
          }
        }
      </style>
      <label for="${this.getAttribute('label-for')}">${this.getAttribute('label-text')}</label>
      <slot></slot>
    `;
  }
}
customElements.define('hpp-fieldset', Fieldset);
