@extends('common.base')

@section('main')
  <h1>アニメ一覧</h1>

  <h2>投稿されているアニメ</h2>
  @foreach($animesHavePhoto as $anime)
    <a href="{{action('AnimeController@show', $anime->id)}}">
      <p>{{$anime->name}}</p>
      <p>{{$anime->photoCount}}</p>
    </a>
  @endforeach

  <h2>未投稿のアニメ</h2>
  @foreach($animesNotHavePhoto as $anime)
    <a href="{{action('AnimeController@show', $anime->id)}}">
      <p>{{$anime->name}}</p>
    </a>
  @endforeach

@endsection
