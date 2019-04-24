@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/anime/show.css') }}" rel="stylesheet">
  <script type="module" src="{{asset('web-components/anime-photo-list.js')}}"></script>
@endsection

@section('main')
  <h1 v-photos="{{$anime->photos}}">{{$anime->name}}</h1>

  <div id="map" class="p-anime-detail--map"></div>

  <hpp-anime-photo-list
    anime-id="{{$anime->id}}"
  >
  </hpp-anime-photo-list>
@endsection

@section('script')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdlSVTp1S7ryq4cQVBonRdAXPwPH1mhQ8"></script>
  <script src="{{ mix('dist/js/anime/show.js') }}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
@endsection