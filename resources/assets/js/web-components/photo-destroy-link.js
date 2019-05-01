class PhotoDestroyLink extends HTMLElement {
  constructor() {
    super();

    const shadowRoot = this.attachShadow({mode: 'open'});

    shadowRoot.innerHTML = `
      <style>
        :host {
          
        }
      </style>
      
      <a href="javascript:void(0);" class="open">削除</a>
      
      <hpp-modal hidden>
        <p>削除しますか？</p>
        <form action="${this.getAttribute('link')}" method="post">
          <input type="hidden" value="${this.getAttribute('csrf-token')}">
          <input name="_method" type="hidden" value="delete">
          <div>
            パスワード
            <input type="password" name="password">
          </div>
          <button type="submit" class="c-button">削除</button>
        </form>
      </hpp-modal>
    `;

    shadowRoot.querySelector('.open').addEventListener('click', () => {
      shadowRoot.querySelector('hpp-modal').removeAttribute('hidden');
    });
  }
}
customElements.define('hpp-photo-destroy-link', PhotoDestroyLink);
