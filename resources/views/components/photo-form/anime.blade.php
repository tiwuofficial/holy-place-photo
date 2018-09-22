<h2 class="p-anime-list-header">アニメ一覧</h2>
<div class="p-anime-list-search">
  <span>タイトル検索</span>
  <input type="text" v-model="animeTitle" class="c-input-text">
</div>
<ul class="p-anime-list" v-animes="{{$animes}}">
  <li class="p-anime-list__item" v-for="anime in filteredAnimes">
    <input v-bind:id="'anime_id_' + anime.id" type="radio" name="anime_id" v-bind:value="anime.id" v-model="photo.anime_id">
    <label v-bind:for="'anime_id_' + anime.id">@{{anime.name}}</label>
  </li>
</ul>