@extends('common.base')

@section('main')
  <h1>アニメ詳細</h1>

  <p>{{$anime->name}}</p>

  @foreach($anime->photos as $photo)
    <p>{{$photo->name}}</p>
    <p>{{$photo->title}}</p>
    <p>{{$photo->comment}}</p>
    @foreach($photo->urls as $url)
      <img src="{{$s3Url . $url->url}}">
    @endforeach
  @endforeach
@endsection
