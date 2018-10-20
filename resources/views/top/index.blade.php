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

  <h2 class="p-top-photos__title">New</h2>
  <ul class="p-photo-list" v-photos="{{$photos}}">
    <li class="p-photo-list__item" v-for="photo in photos">
      <a v-bind:href="'/photos/' + photo.id" class="p-photo-cassette">
        <img v-bind:src="photo.urls[0].full_url">
      </a>
    </li>
  </ul>
  <a href="javascript:void(0);" @click="readMore" class="p-top-photos__more-link">More</a>

  <h2 class="p-anime-list-header">投稿されているアニメ</h2>
  <ul class="p-anime-list">
    @foreach($animesHavePhoto as $anime)
      <li class="p-anime-list__item">
        <a href="{{action('AnimeController@show', $anime->id)}}" class="p-anime-list__item">
          <p>{{$anime->name}}</p>
          <p>投稿数：{{$anime->photoCount}}</p>
        </a>
      </li>
    @endforeach
  </ul>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/index.js') }}"></script>
@endsection