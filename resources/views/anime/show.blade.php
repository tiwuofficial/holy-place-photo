@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/anime/show.css') }}" rel="stylesheet">
  <script type="module" src="{{asset('web-components/anime-map.js')}}"></script>
@endsection

@section('main')
  <h1>{{$anime->name}}</h1>

  <hpp-anime-map
    map-id="js-map"
    map-class="map"
    positions="{{$anime->photos}}"
  >
    <div id="js-map" class="map"></div>
  </hpp-anime-map>

  <hpp-anime-photo-list
    anime-id="{{$anime->id}}"
  >
  </hpp-anime-photo-list>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/anime/show.js') }}"></script>
  <script type="module" src="{{asset('web-components/anime-photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
@endsection