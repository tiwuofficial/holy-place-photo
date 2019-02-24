@extends('common.base')

@section('head')
  <style>
    .p-hello-header {
      background: url("https://res.cloudinary.com/hkgg1yxai/image/fetch/h_1000,f_auto/https://s3-ap-northeast-1.amazonaws.com/holy-place-photo/resources/top.jpg") no-repeat;
      height: 100vh;
      width: 100vw;
      background-position: 50%;
      background-size: cover;
    }

    .p-hello-header__wrap {
      height: 100vh;
      background-color: rgba(74, 74, 74, 0.7);
      position: relative;
    }

    .p-hello-header__wrap__title {
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translateY(-50%) translateX(-50%);
      transform: translateY(-50%) translateX(-50%);
      color: #fff;
      font-size: 40px;
      width: 100%;
    }
  </style>

  <link href="{{ mix('/dist/css/top/index.css') }}" rel="stylesheet">
@endsection

@section('main')
  <div class="p-hello-header">
    <div class="p-hello-header__wrap">
      <h1 class="p-hello-header__wrap__title">聖地を共有しよう</h1>
    </div>
  </div>

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