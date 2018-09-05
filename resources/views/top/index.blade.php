@extends('common.base')

@section('main')
  <h1>トップ</h1>

  @foreach($photos as $photo)
    <p>{{$photo->anime->name}}</p>
    <p>{{$photo->name}}</p>
    <p>{{$photo->title}}</p>
    <p>{{$photo->comment}}</p>
    @foreach($photo->urls as $url)
      <img src="{{$s3Url . $url->url}}">
    @endforeach
  @endforeach
@endsection
