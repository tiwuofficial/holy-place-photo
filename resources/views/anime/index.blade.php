@extends('common.base')

@section('main')
  <h1>アニメ一覧</h1>

  @foreach($animes as $anime)
    <p>{{$anime->name}}</p>
    <p>{{$anime->name_kana}}</p>
  @endforeach
@endsection
