class Hero extends HTMLElement {
  constructor() {
    super();

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          background: url("https://res.cloudinary.com/hkgg1yxai/image/fetch/h_1000,f_auto/https://s3-ap-northeast-1.amazonaws.com/holy-place-photo/resources/top.jpg") no-repeat;
          height: 100vh;
          width: 100vw;
          background-position: 50%;
          background-size: cover;
          display: block;
        }
        
        .wrap {
          height: 100vh;
          background-color: rgba(74, 74, 74, 0.7);
          position: relative;
        }
      
        .text {
          position: absolute;
          top: 50%;
          left: 50%;
          -webkit-transform: translateY(-50%) translateX(-50%);
          transform: translateY(-50%) translateX(-50%);
          color: #fff;
          font-size: 40px;
          width: 100%;
          text-align: center;
        }
      </style>
      
      <div class="wrap">
        <h1 class="text">聖地を共有しよう</h1>
      </div>
    `;
  }
}
customElements.define('hpp-hero', Hero);
