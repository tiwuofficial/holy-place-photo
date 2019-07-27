@extends('amp.base')

@section('head')
  <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
  <style amp-custom>
    body {
      background-color: white;
      line-height: 1;
    }
    {{-- header --}}
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
        <amp-img src="/img/icon/menu.svg" alt="menu icon" width="30" height="30" class="icon"></amp-img>
      </div>
    </div>
  </header>


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
