@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/anime/index.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>アニメ一覧</h1>

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

  <h2 class="p-anime-list-header">未投稿のアニメ</h2>
  <ul class="p-anime-list">
    <li class="p-anime-list__item" v-for="anime in noHavePhotoAnimes">
      <a v-bind:href="'/anime/' + anime.id">
        <p>@{{anime.name}}</p>
      </a>
    </li>
  </ul>

@endsection

@section('script')
  <script src="{{ mix('dist/js/anime/index.js') }}"></script>
@endsection