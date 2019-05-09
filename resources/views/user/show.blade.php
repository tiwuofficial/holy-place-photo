@extends('common.base')

@section('head')
  <script type="module" src="{{asset('web-components/user-photo-list.js')}}"></script>
@endsection

@section('main')
  <hpp-user-photo-list
    user-id="{{$user->id}}"
  >
    <h1>{{$user->name}}さんの写真</h1>
  </hpp-user-photo-list>
@endsection

@section('script')
  <script src="{{ mix('dist/js/user/show.js') }}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
@endsection