class AnimeList extends HTMLElement {
  constructor() {
    super();

    this.shadow = this.attachShadow({mode: 'open'});

    let url = '/api/anime/get/';

    switch (this.getAttribute('type')) {
      case 'noHave':
        url += 'noHavePhoto';
      break;
      case 'have':
      default:
        url += 'havePhoto';
      break;
    }

    fetch(url).then(res => res.json()).then(res => {
      res.forEach(anime => {
        const animeCard = document.createElement('hpp-anime-card');
        animeCard.setAttribute('anime-url', anime.url);
        animeCard.setAttribute('anime-name', anime.name);
        animeCard.setAttribute('anime-photo-count', anime.photoCount);
        this.shadow.getElementById('js-list').appendChild(animeCard);
      });
    });

    this.shadow.innerHTML = `
      <style>
        h2 {
          text-align: center;
          font-size: 20px;
        }
        .list {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
        }
      </style>
      
      <h2><slot></slot></h2>
      <div id="js-list" class="list"></div>
    `;
  }
}

customElements.define('hpp-anime-list', AnimeList);
