class Heading extends HTMLElement {
  constructor() {
    super();

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        ::slotted(h1),
        ::slotted(h2) {
          margin: 0;
          text-align: center;
        }
        ::slotted(h1) {
          font-size: 24px;
        }
        ::slotted(h2) {
          font-style: 20;
        }
      </style>
      <slot></slot>
    `;
  }
}
customElements.define('hpp-heading', Heading);
