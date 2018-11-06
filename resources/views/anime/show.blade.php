@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/anime/show.css') }}" rel="stylesheet">
@endsection

@section('main')
  <h1 v-photos="{{$anime->photos}}">{{$anime->name}}</h1>

  <div id="map" class="p-anime-detail--map"></div>

  <ul class="p-photo-list">
    @foreach($anime->photos as $photo)
      @component('components.photo.cassette',['photo' => $photo])
      @endcomponent
    @endforeach
  </ul>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/anime/show.js') }}"></script>
@endsection