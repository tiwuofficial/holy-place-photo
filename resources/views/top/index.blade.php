@extends('common.base')

@section('head')
  <style>
    .u-bc-f8f9fa {
      background-color: #f8f9fa;
    }
  </style>
  <script type="module" src="{{asset('web-components/hero.js')}}"></script>
@endsection

@section('main')
  <hpp-hero></hpp-hero>

  <div class="u-bc-f8f9fa">
    <hpp-photo-list></hpp-photo-list>
    <hpp-anime-list></hpp-anime-list>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/index.js') }}"></script>
  <script type="module" src="{{asset('web-components/photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
  <script type="module" src="{{asset('web-components/anime-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/anime-card.js')}}"></script>
@endsection