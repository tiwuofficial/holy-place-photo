@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/anime/index.css') }}" rel="stylesheet">
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
    @foreach($animesNotHavePhoto as $anime)
      <li class="p-anime-list__item">
        <a href="{{action('AnimeController@show', $anime->id)}}">
          <p>{{$anime->name}}</p>
        </a>
      </li>
    @endforeach
  </ul>

@endsection
