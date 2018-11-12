@extends('common.base')

@section('head')
  <link href="{{ asset('/dist/css/user/show.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1>{{$user->name}}さんの写真</h1>

  <div class="p-photo-detail--other">
    <ul class="p-photo-list">
      @foreach($userPhotos as $photo)
        @component('components.photo.cassette',['photo' => $photo])
        @endcomponent
      @endforeach
    </ul>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/user/show.js') }}"></script>
@endsection