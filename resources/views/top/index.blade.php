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
  <hpp-hero>聖地を共有しよう</hpp-hero>

  <div class="u-bc-f8f9fa">
    <hpp-photo-list></hpp-photo-list>
    <hpp-anime-list>
      投稿されているアニメ
    </hpp-anime-list>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/index.js') }}" async></script>
@endsection