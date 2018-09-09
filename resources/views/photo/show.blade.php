@extends('common.base')

@section('main')
  <h1>写真詳細</h1>

  <p>{{$photo->name}}</p>
  <p>{{$photo->title}}</p>
  <p>{{$photo->comment}}</p>
  <p v-like-count="{{$photo->likeCount}}">@{{ likeCount }}</p>
  <div>
    <a href="javascript:void(0);" @click="like('{{$photo->id}}')" v-like-done="{{$photo->likeDone($user)}}">@{{ likeText }}</a>
  </div>
  @foreach($photo->urls as $url)
    <img src="{{$s3Url . $url->url}}">
  @endforeach

  <h2>このユーザーの他の写真</h2>

  @foreach($userPhotos as $photo)
    <p>{{$photo->name}}</p>
    <p>{{$photo->title}}</p>
    <p>{{$photo->comment}}</p>
    @foreach($photo->urls as $url)
      <img src="{{$s3Url . $url->url}}">
    @endforeach
  @endforeach

  <h2>同じアニメの写真</h2>

  @foreach($animePhotos as $photo)
    <p>{{$photo->name}}</p>
    <p>{{$photo->title}}</p>
    <p>{{$photo->comment}}</p>
    @foreach($photo->urls as $url)
      <img src="{{$s3Url . $url->url}}">
    @endforeach
  @endforeach
@endsection

@section('script')
  <script src="{{ asset('dist/js/photo/show.js') }}"></script>
@endsection