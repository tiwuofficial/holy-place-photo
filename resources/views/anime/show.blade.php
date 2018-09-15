@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/anime/show.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>{{$anime->name}}</h1>

  <ul class="p-photo-list">
  @foreach($anime->photos as $photo)
    <li class="p-photo-list__item">
      <a href="{{action('PhotoController@show', $photo->id)}}" class="p-photo-cassette">
        <img src="{{$s3Url . $photo->urls->first()->url}}">
      </a>
    </li>
  @endforeach
  </ul>
@endsection
