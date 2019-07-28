@extends('amp.base')

@section('head')
  <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
  <style amp-custom>
    body {
      background-color: white;
      line-height: 1;
    }
    /* header */
    header {
      height: 50px;
      display: flex;
      padding: 0 20px;
    }
    .item {
      display: flex;
      align-items: center;
    }
    .item:first-of-type {
      flex-grow: 1;
    }
    .item + .item {
      margin-left: 20px;
    }
    .link {
      color: #000;
      text-decoration: none;
    }
    @media (max-width: 1100px) {
      .item {
        display: none;
      }

      .item--logo,
      .item--icon {
        display: flex;
      }
    }

    /* sidemenu */
    .side-menu__list {
      height: 100%;
      text-align: center;
      background-color: #fff;
      margin: 0;
      padding: 0;
      list-style-type: none;
    }

    .side-menu__item + .side-menu__item {
      border-top: 1px solid #d4d4d6;
    }

    .side-menu__item:last-child {
      border-bottom: 1px solid #d4d4d6;
    }

    .side-menu__item--main {
      display: none;
    }

    .side-menu__link {
      padding: 20px 30px;
      display: block;
      color: #000;
      text-decoration: none;
    }

    @media (max-width: 1100px) {
      .side-menu__item--main {
        display: list-item;
      }
    }

    h1 {
      margin: 0;
    }
    section {
      padding: 0 15px;
    }
    .text {
      margin: 0;
      font-size: 16px;
    }
    h1 + .text,
    .text + .text {
      margin-top: 10px;
    }
    .footer {
      display: flex;
      font-size: 14px;
    }
    .text + .footer {
      margin-top: 30px;
    }
  </style>
@endsection

@section('main')
  <header>
    <div class="item item--logo">
      <a href="{{action('TopController@index')}}" class="link js-sw-fetch">Holy Place Photo</a>
    </div>
    <div class="item">
      <a href="{{action('PhotoController@create')}}" class="link">投稿する</a>
    </div>
    <div class="item">
      <a href="{{action('AnimeController@index')}}" class="link">アニメ一覧</a>
    </div>
    <div class="item item--icon">
      <div class="open">
        <amp-img src="/img/icon/menu.svg" role='button' tabindex="1" alt="menu icon" width="30" height="30" class="icon" on='tap:sidebar.open'></amp-img>
      </div>
    </div>
  </header>

  <amp-sidebar id="sidebar" layout="nodisplay" side="right">
    <ul class="side-menu__list">
      <li class="side-menu__item side-menu__item--main">
        <a href="{{action('PhotoController@create')}}" class="side-menu__link js-sw-fetch">投稿する</a>
      </li>
      <li class="side-menu__item side-menu__item--main">
        <a href="{{action('AnimeController@index')}}" class="side-menu__link js-sw-fetch">アニメ一覧</a>
      </li>
      <li class="side-menu__item">
        <a href="{{action('TopController@about')}}" class="side-menu__link js-sw-fetch">このサイトについて</a>
      </li>
      <li class="side-menu__item">
        <a href="{{action('TopController@inquiry')}}" class="side-menu__link js-sw-fetch">お問い合わせ</a>
      </li>
      <li class="side-menu__item">
        <a href="{{action('TopController@kiyaku')}}" class="side-menu__link js-sw-fetch">利用規約</a>
      </li>
      <li class="side-menu__item">
        <a href="{{action('TopController@privacy')}}" class="side-menu__link js-sw-fetch">プライバシーポリシー</a>
      </li>
    </ul>
  </amp-sidebar>

  <amp-carousel layout="responsive" width="400" height="300" type="slides" autoplay delay="2000" loop>
    @foreach($photo->urls as $url)
      <amp-img src="{{$url->full_url}}" layout="responsive" width="400" height="300" alt="a sample image"></amp-img>
    @endforeach
  </amp-carousel>

  <section>
    <h1>{{$photo->title}}</h1>
    <p class="text">Anime is {{$photo->anime_name}}</p>
    <p class="text">Photo by {{$photo->name}}</p>
    @if($photo->comment)
      <p class="text">{!! nl2br($photo->comment) !!}</p>
    @endif
    <p class="footer">
      <span class="created_text">{{$photo->created_at}}</span>
    </p>
  </section>
@endsection
