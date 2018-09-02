@extends('common.base')

@section('main')
  <h1>写真投稿</h1>

  <form action="{{action('PhotoController@store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="photo">
    <button type="submit">保存</button>
  </form>
@endsection
