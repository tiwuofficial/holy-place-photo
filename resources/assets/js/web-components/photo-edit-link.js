class PhotoEditLink extends HTMLElement {
  constructor() {
    super();

    const shadowRoot = this.attachShadow({mode: 'open'});

    shadowRoot.innerHTML = `
      <style>
        :host {
          
        }
      </style>
      
      <a href="javascript:void(0);" class="open">編集</a>
      
      <hpp-modal hidden>
        <p>編集しますか？</p>
        <form action="${this.getAttribute('link')}" method="post">
          <input type="hidden" value="${this.getAttribute('csrf-token')}">
          <div>
            パスワード
            <input type="password" name="password">
          </div>
          <button type="submit" class="c-button">編集画面へ</button>
        </form>
      </hpp-modal>
    `;

    shadowRoot.querySelector('.open').addEventListener('click', () => {
      shadowRoot.querySelector('hpp-modal').removeAttribute('hidden');
    });
  }
}
customElements.define('hpp-photo-edit-link', PhotoEditLink);
