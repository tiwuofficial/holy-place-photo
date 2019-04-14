@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/top/index.css') }}" rel="stylesheet">
  <script type="module" src="{{asset('web-components/hero.js')}}"></script>
@endsection

@section('main')
  <hpp-hero></hpp-hero>

  <div class="u-bc-f8f9fa">
    <hpp-photo-list></hpp-photo-list>

    <h2 class="p-anime-list-header">投稿されているアニメ</h2>
    <ul class="p-anime-list">
        <li class="p-anime-list__item" v-for="anime in animes">
          <a :href="anime.url" class="p-anime-list__item">
            <p>@{{anime.name}}</p>
            <p>投稿数：@{{anime.photoCount}}</p>
          </a>
        </li>
    </ul>
  </div>
@endsection

@section('script')
  <script src="{{ mix('dist/js/top/index.js') }}"></script>
  <script type="module" src="{{asset('web-components/photo-list.js')}}"></script>
  <script type="module" src="{{asset('web-components/photo-card.js')}}"></script>
@endsection