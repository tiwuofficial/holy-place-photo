@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/top/index.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>トップ</h1>

  <ul class="p-photo-list">
  @foreach($photos as $photo)
    <li class="p-photo-list__item">
      <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
        <img src="{{$photo->urls->first()->full_url}}">
      </a>
    </li>
  @endforeach
  </ul>
@endsection
