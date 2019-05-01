class PhotoSwiper extends HTMLElement {
  constructor() {
    super();

    window.addEventListener('load', () => {
      new Swiper(`#${this.getAttribute('swiper-id')}`, {
        speed:800,
        slidesPerView: 2,
        centeredSlides : true,
        effect: 'coverflow',
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows : false,
        },
        grabCursor: true,
        parallax: true,
        pagination: {
          el: `.${this.getAttribute('swiper-pagination-class')}`,
          clickable: true,
        },
        navigation: {
          nextEl: `.${this.getAttribute('swiper-next-class')}`,
          prevEl: `.${this.getAttribute('swiper-prev-class')}`,
        },
        breakpoints: {
          1023: {
            slidesPerView: 1,
            spaceBetween: 0
          }
        },
      });
    });

    this.attachShadow({mode: 'open'}).innerHTML = `
      <style>
        :host {
          width: 100%;
          height: 500px;
          padding-top: 50px;
          padding-bottom: 50px;
          display: block;
        }
      </style>
      
      <slot></slot>
    `;
  }
}
customElements.define('hpp-photo-swiper', PhotoSwiper);
