@extends('common.base')

@section('main')
  <h1>写真投稿</h1>

  <form action="{{action('PhotoController@store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div>
      <input type="text" name="name">
    </div>

    <div>
      <input type="text" name="title">
    </div>

    <div>
      <input type="password" name="password">
    </div>

    <div>
      <input type="password" name="password-confirm">
    </div>

    <div>
      @foreach($animes as $anime)
        <p>{{$anime->name}}</p>
        <input type="radio" name="anime_id" value="{{$anime->id}}">
      @endforeach
    </div>

    <div>
      <textarea name="comment"></textarea>
    </div>

    <div>
    <input type="file" name="photos[]">
    </div>

    <div>
      <input type="file" name="photos[]">
    </div>

    <button type="submit">保存</button>
  </form>
@endsection
