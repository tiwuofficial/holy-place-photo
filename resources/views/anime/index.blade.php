@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/anime/index.css') }}" rel="stylesheet">
  <script type="module" src="{{asset('web-components/anime-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/anime-card.js')}}"></script>
@endsection

@section('main')
  <h1>アニメ一覧</h1>

  <hpp-anime-list
    type="have"
  >
    投稿されているアニメ
  </hpp-anime-list>

  <hpp-anime-list
    type="noHave"
  >
    未投稿のアニメ
  </hpp-anime-list>

@endsection

@section('script')
  <script src="{{ mix('dist/js/anime/index.js') }}"></script>
@endsection