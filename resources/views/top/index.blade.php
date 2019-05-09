@extends('common.base')

@section('head')
  <style>
    .main {
      background-color: #f8f9fa;
      padding-top: 15px;
    }
    hpp-photo-list + hpp-anime-list {
      margin-top: 20px;
    }
  </style>
  <script type="module" src="{{asset('web-components/hero.js')}}"></script>
@endsection

@section('main')
  <hpp-hero>聖地を共有しよう</hpp-hero>

  <div class="main">
    <hpp-photo-list>
      <h2>New</h2>
    </hpp-photo-list>
    <hpp-anime-list>
      <h2>投稿されているアニメ</h2>
    </hpp-anime-list>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/index.js') }}" async></script>
@endsection