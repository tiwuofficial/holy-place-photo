@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/top/index.css') }}" rel="stylesheet">
@endsection

@section('main')
  <div class="p-hello-header">
    <div class="p-hello-header__wrap">
      <h1 class="p-hello-header__wrap__title">聖地を共有しよう</h1>
    </div>
  </div>
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
