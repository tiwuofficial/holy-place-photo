<h2 class="p-anime-list-header">アニメ一覧</h2>
<ul class="p-anime-list">
  @foreach($animes as $anime)
    <li class="p-anime-list__item">
      <input id="anime_id_{{$anime->id}}" type="radio" name="anime_id" value="{{$anime->id}}" v-model="photo.anime_id">
      <label for="anime_id_{{$anime->id}}">{{$anime->name}}</label>
    </li>
  @endforeach
</ul>