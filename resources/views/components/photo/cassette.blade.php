<li class="p-photo-list__item">
  <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
    <img data-src="{{$photo->urls[0]->full_url}}" alt="{{$photo->title}}">
    <div class="p-photo-list__item__info">
      <h3 class="p-photo-list__item__info__title">「{{$photo->title}}」</h3>
      <p class="p-photo-list__item__info__anime">Anime is {{$photo->anime_name}}</p>
    </div>
  </a>
</li>