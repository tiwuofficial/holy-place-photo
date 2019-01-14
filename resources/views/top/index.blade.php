@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/top/index.css') }}" rel="stylesheet">
@endsection

@section('main')
  <div class="p-hello-header">
    <div class="p-hello-header__wrap">
      <h1 class="p-hello-header__wrap__title">聖地を共有しよう</h1>
    </div>
  </div>

  <div class="u-bc-f8f9fa">
    <h2 class="p-top-photos__title">New</h2>
    <ul class="p-photo-list">
      @foreach($photos as $photo)
        @component('components.photo.cassette',['photo' => $photo])
        @endcomponent
      @endforeach
      <li class="p-photo-list__item" v-for="photo in photos">
        <a v-bind:href="'/photos/' + photo.id" class="p-photo-cassette">
          <img v-bind:src="photo.urls[0].full_url">
        </a>
        <div class="p-photo-list__item__info">
          <h3 class="p-photo-list__item__info__title">「@{{photo.title}}」</h3>
          <p class="p-photo-list__item__info__anime">Anime is @{{photo.anime.name}}</p>
        </div>
      </li>
    </ul>
    <a href="javascript:void(0);" @click="readMore" class="p-top-photos__more-link">More</a>

    <h2 class="p-anime-list-header">投稿されているアニメ</h2>
    <ul class="p-anime-list">
      @foreach($animesHavePhoto as $anime)
        <li class="p-anime-list__item">
          <a href="{{action('AnimeController@show', $anime->id)}}" class="p-anime-list__item js-sw-fetch">
            <p>{{$anime->name}}</p>
            <p>投稿数：{{$anime->photoCount}}</p>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/index.js') }}"></script>
@endsection