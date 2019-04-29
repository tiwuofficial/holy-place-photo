class LikeButton extends HTMLElement {
  constructor() {
    super();

    this.likeCount = this.getAttribute('like-count');
    this.likeDone = !!this.getAttribute('like-done');
    this.likeDoneApiFlg = false;

    this.shadow = this.attachShadow({mode: 'open'});

    this.shadow.innerHTML = `
      <style>
        :host {
          width: 100%;
          border-radius: 3px;
          font-size: 16px;
          color: #fff;
          background-color: rgb(115, 205, 135);
          cursor: pointer;
          display: block;
          padding: 10px 0;
          text-align: center;
          -webkit-appearance: none;
        }
      </style>
      
      尊いね! <span id="js-count">${this.likeCount}</span>件
    `;

    this.addEventListener('click', () => {
      this.like();
    });
  }

  like() {
    if (this.likeDoneApiFlg) {
      return;
    }
    this.likeDoneApiFlg = true;
    if (this.likeDone) {
      this.likeCount--;
    } else {
      this.likeCount++;
    }
    this.likeDone = !this.likeDone;
    this.shadow.getElementById('js-count').textContent = this.likeCount;
    fetch(`/api/photos/${this.getAttribute('photo-id')}/like`, {
      method: "POST"
    }).then(res => res.text()).then(() => {
    }).finally(() => {
      this.likeDoneApiFlg = false;
    });
  }
}
customElements.define('hpp-like-button', LikeButton);
