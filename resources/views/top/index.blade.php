@extends('common.base')

@section('head')
  <link href="{{ mix('/dist/css/top/index.css') }}" rel="stylesheet">
  <script type="module" src="{{asset('web-components/hero.js')}}"></script>
@endsection

@section('main')
  <hpp-hero></hpp-hero>

  <div class="u-bc-f8f9fa">
    <h2 class="p-top-photos__title">New</h2>
    <ul class="p-photo-list">
      <li class="p-photo-list__item" v-for="photo in photos">
        <a :href="photo.url" class="p-photo-cassette">
          <img :src="photo.photoUrl" :alt="photo.title">
          <div class="p-photo-list__item__info">
            <h3 class="p-photo-list__item__info__title">「@{{photo.title}}」</h3>
            <p class="p-photo-list__item__info__anime">Anime is @{{photo.animeName}}</p>
          </div>
        </a>
      </li>
    </ul>
    <a href="javascript:void(0);" @click="readMorePhoto" class="p-top-photos__more-link">More</a>

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
@endsection